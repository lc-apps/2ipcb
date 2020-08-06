<?php

namespace app\classes;

use app\models\Model;
use app\models\Post;
use app\classes\Uri;
use core\Reflection;

class Pagination {

	private $model;

	private $uri;

	
    private $controller;
    private $start;
	private $regs;
	private $preview;
	private $page;
	private $next;
	private $pagestotal;
	private $pagemax;
	private $by;
	private $order;
	private $itensPerPage;
	private $query;
	private $listPages;
	private $parameters = [];
	private $list = [];



	public function pagination(Model $model, $itensPerPage)

	{

		$this->getController();

		$this->countRegisters($model);

		$this->itensPerPage = $itensPerPage;

		$this->getTotalPorPerPage();

		$this->getParameters($itensPerPage);

		$this->getStart();

		$this->getQuery();

		$this->buildPagination($model);

		$this->getList($model, $this->query);

		return $this->getPagination();

	}

	private function countRegisters($model)

	{
        $regs = $model->count();

        $regs = (array) $regs;

        $regs = (int)$regs["COUNT(*)"];

        $this->regs = $regs;
		
	}

	private function getTotalPorPerPage()

	{
        $this->pagestotal = ceil($this->regs / $this->itensPerPage);

    }

	private function getParameters($itensPerPage)

	{

	    // Obtém a página atual
	    $page = 1;
	    
	    // Atualiza a página atual se tiver o parâmetro pagina=n
	    if ( !empty( $_GET['page'] ) ) {
	        $page = (int) $_GET['page'];
	        $this->page =  $page;
	    }

	    $this->page =  $page;

	    $this->preview = $this->preview($this->page); 

	    $this->next = $this->next($this->page);		
		
	}

    private function getStart()

	{
        $this->start = ($this->page - 1) * $this->itensPerPage;

    }

    

	private function getQuery()

	{

		//select * from blog ORDER BY imagem DESC LIMIT 2 , 2;

		//$query = 'ORDER BY ' . $this->by .' '. $this->order . ' LIMIT ' . $this->start .' , '. $this->itensPerPage;

		$query = ' LIMIT ' . $this->start .' , '. $this->itensPerPage;

		$this->query = $query;

	}	


	private function buildPagination($model)

	{

		$listPages = '<ul class="pagination pagination-sm">';

		$listPages .= '<li><a href="/'.$this->controller.'?page='.$this->preview.'"><i class="fa fa-chevron-left"></i></a></li>';

		for ($i=1; $i <= $this->pagestotal ; $i++) { 
			
			if ($this->page == $i) {
				
				$listPages .= '<li class="active"><a href="/'.$this->controller.'?page='.$i.'">'.$this->page.'</a></li>';

			}else {

				$listPages .= '<li><a href="/'.$this->controller.'?page='.$i.'">'.$i.'</a></li>';
			}

		}

		$listPages .= '<li><a href="/'.$this->controller.'?page='.$this->next.'"><i class="fa fa-chevron-right"></i></a></li>';	

		$listPages .= '</ul>';	

		$this->listPages = $listPages;

	}

	private function getList($model,$query){

		$list = $model->allWithPagination($query);

		$this->list = $list;

	}

	private function preview($page){

		if ($page === 1) {
			return $page;
		} 
			return $page -1;	
	}

	private function next($page){

		if ($page === (int)$this->pagestotal) {
			return $page;
		} 
			return $page +1;	
	}

	private function getController() {

		$uri = new Uri;

	    $this->uri = $uri->uri();	   

		if (substr_count($this->uri, '/') > 1) {
			list($controller, $method) = array_values(array_filter(explode('/', $this->uri)));
			$this->controller = $controller;
		}

		$this->controller = ltrim($this->uri, '/');

	}

	private function getPagination(){

		return [
			"start" => $this->start,
			"regs" => $this->regs,
			"page" => $this->page,
			"pagestotal" => $this->pagestotal,
			"pagemax" => $this->pagemax,
			"by" => $this->by,
			"order" => $this->order,
			"itensperpage" => $this->itensPerPage,
			"query" => $this->query,
			"listpages" => $this->listPages,
			"list" => $this->list,
		];


	}

	private function setSession(){

		$_SESSION[$this->model]['state'] = true;
		$_SESSION[$this->model]['regs'] = $this->regs;
		$_SESSION[$this->model]['page'] = $this->page;
		$_SESSION[$this->model]['pagestotal'] = $this->pagestotal;
		$_SESSION[$this->model]['by'] = $this->by;
		$_SESSION[$this->model]['order'] = $this->order;
		$_SESSION[$this->model]['itensPerPage'] = $this->itensPerPage;
		$_SESSION[$this->model]['query'] = $this->query;
		$_SESSION[$this->model]['pagination'] = $this->pagination;

		session_regenerate_id();

		return true;
	}

	public function getSession($model){
		
		return $_SESSION[$model];

	}

	

}



