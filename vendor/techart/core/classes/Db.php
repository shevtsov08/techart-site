<?php

namespace techart;
use PDO;
use PDOException;
use PDOStatement;

class Db 
{
	protected PDOStatement $stmt;
	protected $connection;
	private static $instance = null;

	private function __construct()
	{
		
	}
	
	public static function getInstance()
	{
		if(self::$instance === null) { 
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function getConnection(array $db_config)
	{
		if($this->connection instanceof PDO) {
			return $this;
		}
		
		$dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
		try {
			$this->connection = new PDO($dsn,$db_config['username'],$db_config['password'],$db_config['option']);
			return $this;
		} catch (PDOException $e) {
			echo $e;
			abort(505);
		}

	}

	public function query($query, $params = [])
	{
			try {
					$this->stmt = $this->connection->prepare($query);
					$this->stmt->execute($params);
			} catch (PDOException $e) {
				 return false;
			}
			
			return $this;
	}

	public function findAll()
	{
		 return $this->stmt->fetchAll();
	}

	public function find()
	{
		return $this->stmt->fetch();
	}
	
	public function findOrFail()
    {
        $res = $this->find();

        if (!$res) { 
            abort();
        }
        return $res;
    }

		public function getColum()
		{
			return $this->stmt->fetchColumn();
		}
}