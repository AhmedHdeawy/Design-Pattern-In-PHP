<?php

interface DBQueryBuilder
{
	public function select($table, $fileds);

	public function where($column, $operator, $value);

	public function limit($start, $offset);

	public function get();
}

class MySQLQueryBuilder implements DBQueryBuilder
{
	protected $query;

	public function reset()
	{
		$this->query = new \stdClass;
	}

	public function select($table, $fileds)
	{
		// Reset The query
		$this->reset();

		$this->query->type = 'select';
		$this->query->base = "SELECT " . implode(', ', $fileds) . ' FROM ' . $table . " ";

		return $this;
	}

	public function where($column, $operator, $value)
	{
		if (!in_array($this->query->type, ['select', 'UPDATE', 'DELETE'])) {
			throw new \Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
			
		}

		$this->query->where[] = "{$column} {$operator} '{$value}'";

		return $this;
	}

	public function limit($start, $offset)
	{
		if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }

		$this->query->limit = " LIMIT {$start}, {$offset}";

		return $this;
	}

	public function get()
	{
		$query = $this->query;
		$sql = $query->base;

		if (!empty($query->where)) {
			$sql .= 'WHERE ' . implode(' AND ', $query->where);
		}

		if (!empty($query->limit)) {
			$sql .= $query->limit;
		}

		$sql .= ";";

		return $sql;
	}

}

class PostgressQueryBuilder implements DBQueryBuilder
{
	protected $query;

	public function reset()
	{
		$this->query = new \stdClass;
	}

	public function select($table, $fileds) {
		// Reset The query
		$this->reset();

		$this->query->type = 'select';
		$this->query->base = "PG SELECT " . implode(', ', $fileds) . ' FROM ' . $table . " ";

		return $this;
	}

	public function where($column, $operator, $value)
	{
		if (!in_array($this->query->type, ['select', 'UPDATE', 'DELETE'])) {
			throw new \Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
			
		}

		$this->query->where[] = "{$column} {$operator} '{$value}'";

		return $this;
	}

	public function limit($start, $offset)
	{
		if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }

		$this->query->limit = " LIMIT {$start} OFFSET {$offset}";

		return $this;
	}

	public function get()
	{
		$query = $this->query;
		$sql = $query->base;

		if (!empty($query->where)) {
			$sql .= 'WHERE ' . implode(' AND ', $query->where);
		}

		if (!empty($query->limit)) {
			$sql .= $query->limit;
		}

		$sql .= ";";

		return $sql;
	}

}

function clientCode(DBQueryBuilder $dbQueryBuilder)
{
	$query = $dbQueryBuilder
			->select("users", ['name', 'phone', 'email'])
			->where('name', 'LIKE', "ahmed")
			->where('email', '=', 'ahmed@gmail.com')
			->limit(10, 1)
			->get();

	echo $query . "\n";
}

echo "\nQuery Builder with Mysql \n \n \n";

clientCode(new MySQLQueryBuilder());

echo "\nQuery Builder with Postgress \n \n";

clientCode(new PostgressQueryBuilder());