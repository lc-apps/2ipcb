<?php

namespace app\traits;

use app\models\querybuilder\Insert;
use app\models\querybuilder\Update;

trait PersistDb {

	public function insert($attributes) {

		$attributes = (array) $attributes;

		$attributes = $this->filterFillable($attributes);

		$sql = Insert::sql($this->table, $attributes);

		$insert = $this->connection->prepare($sql);

		return $insert->execute($attributes);

	}

	public function update($attributes, $where) {

		$attributes = (array) $attributes;

		$attributes = $this->filterFillable($attributes);

		$sql = (new Update)->where($where)->sql($this->table, $attributes);

		$update = $this->connection->prepare($sql);

		$update->execute($attributes);

		return $update->rowCount();

	}

	private function filterFillable($attributes) {

		if (isset($this->fillable)) {
			foreach ($attributes as $key => $value) {
				if (!in_array($key, $this->fillable)) {
					unset($attributes[$key]);
				}
			}
		}

		return $attributes;

	}

}