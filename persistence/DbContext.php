<?php

abstract class DbContext {
	protected $host;
	protected $dbUser;
	protected $password;
	protected $dbName;
	
	protected $dbConnection;
	
	protected function __construct($host, $dbUser, $password, $dbName) {
		$this->host = $host;
		$this->dbUser = $dbUser;
		$this->password = $password;
		$this->dbName = $dbName;
	}
	
	protected function connect() {
		
		if (!isset($this->host) or
			!isset($this->dbUser) or
			!isset($this->password) or
			!isset($this->dbName)) {
			throw new Exception('Database connection failed: Invalid database connection configuration.');
		}
		
		$this->dbConnection = new mysqli($this->host, $this->dbUser, $this->password, $this->dbName);
		
		if($this->dbConnection->connect_error) {
		    throw new Exception('Database connection failed...' . 'Error: ' . $this->dbConnection->connect_errno 
			   . ' ' . $this->dbConnection->connect_error);
		} else {
		    $this->dbConnection->set_charset('utf8mb4');
		}
	}
	
	protected function query($queryString) {
		if (!isset($this->dbConnection)) {
			try {
				$this->connect();
			}
			catch (Exception $e) {
				echo 'Error occurred while connecting to database ' . $this->dbName . ': ' . $e->getMessage() . '\n';
				return null;
			}
		}
		
		$rs = $this->dbConnection->query($queryString)
		or die('Error while querying the database: ' . $this->dbConnection->error);

		return $rs;
	}
}


?>