<?php

namespace app\models;

use app\classes\Bind;
use app\models\Connection;
use app\traits\PersistDb;

abstract class Model {
	use PersistDb;

	private $consulta;
	private $first;
	private $limit ;

	/**
	 * @var mixed
	 */
	protected $connection;

	public function __construct() {
		$this->connection = Bind::get('connection');
	}

	public function all() {
		$sql = "select * from {$this->table}";
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetchAll();
	}


	public function last() {
		$sql = "select * from {$this->table} ORDER BY id DESC LIMIT 1";
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetch();
	}

	public function proximoEvento() {
		$sql = "select * from {$this->table} where data >= now() ORDER BY data ASC LIMIT 1";
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetch();
	}

	public function allWhere($field, $value) {
		
		$sql = "select * from {$this->table} where {$field} = :{$field}";		
		$list = $this->connection->prepare($sql);
		$list->bindValue($field, $value);
		$list->execute();

		return $list->fetchAll();
	}

	public function onlyWhere($field, $value) {
		
		$sql = "select * from {$this->table} where {$field} = :{$field}";		
		$list = $this->connection->prepare($sql);
		$list->bindValue($field, $value);
		$list->execute();

		return $list->fetch();
	}

	public function principal($field, $value) {
		
		$sql = "select * from {$this->table} where {$field} = :{$field} AND  data >= now() and horario > CURRENT_TIME";		
		$list = $this->connection->prepare($sql);
		$list->bindValue($field, $value);
		$list->execute();

		return $list->fetch();
	}

	public function allWithPagination($query) {
		$sql = "select * from {$this->table} {$query}";
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetchAll();
	}

	public function allWithLimit($field,$limit,$order) {
		$sql = "select * from {$this->table}  ORDER BY {$field} {$order} LIMIT {$limit}";
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetchAll();
	}

	public function limitWithDateLimit($field,$limit,$order) {
		$sql = "select * from {$this->table}  where data >= now() ORDER BY {$field} {$order} LIMIT {$limit}";
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetchAll();
	}

	public function count() {
		$sql = "select COUNT(*) from {$this->table}";
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetch();
	}

	public function countCat($id_categoria) {
		$sql = "select COUNT(*) from {$this->table}  where id_categoria = {$id_categoria}";
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetch();
	}

	/**
	 * @param $field
	 * @param $value
	 */
	public function delete($field, $value) {

		$sql = "delete from {$this->table} where {$field} = :{$field}";
		$delete = $this->connection->prepare($sql);
		$delete->bindValue($field, $value);
		$delete->execute();

		return $delete->rowCount();
	}

	/**
	 * @param $field
	 * @param $value
	 */
	public function find($field, $value) {

		$sql = "select * from {$this->table} where {$field} = :{$field}";
		$list = $this->connection->prepare($sql);
		$list->bindValue($field, $value);
		$list->execute();

		return $list->fetch();

	}

	public function CatJoin($othertable) {

		$sql = "select Categoria.categoria, Categoria.id as idcat from {$this->table} INNER JOIN {$othertable} on Categoria.id = Eventos.id_categoria GROUP BY Categoria.id";
		$list = $this->connection->prepare($sql);
		$list = $this->connection->query($sql);
		$list->execute();

		return $list->fetchAll();

	}



	
	public function receiveString()
    {
    	$consulta = "select * from {$this->table}";
        $this->consulta = $consulta;
        return $this;
    }

    public function orderBy($field,$position)
    {
    	$first = " ORDER BY {$field} {$position} ";
    	$this->first = $first;
    	$sql = $this->consulta . $this->first ;
        $list = $this->connection->query($sql);
		$list->execute();

		return $list->fetchAll();
        
    }

    public function limit ($limit)
    {
    	$limit  = " LIMIT 0, {$limit}";
    	$this->limit  = $limit ;
        return $this;
    }

    public function __toString()
    {
        return $this->consulta . $this->first . $this->limit ;
    }


	//http://blog.justdigital.com.br/metodos-encadeados-no-php-o-this-da-questao/
	//https://gustavopaes.net/blog/2010/metodos-encadeados-em-php.html
	//https://pt.stackoverflow.com/questions/105259/o-que-%C3%A9-encadeamento-de-m%C3%A9todos


}
