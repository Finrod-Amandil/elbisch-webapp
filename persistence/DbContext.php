<?php
/**
 * file: persistence/DbContext.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-24: Severin Zahler: added class
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary: Database-inspecific abstraction of database access.
 */

abstract class DbContext {
	//Connection data
	protected $host;
	protected $dbUser;
	protected $password;
	protected $dbName;
	
	//Database connection
	protected $dbConnection;
	
	/*
	 * Constructor of DbContext. Requires concrete database
	 * access data to initialize a context.
	 */
	protected function __construct($host, $dbUser, $password, $dbName) {
		$this->host = $host;
		$this->dbUser = $dbUser;
		$this->password = $password;
		$this->dbName = $dbName;
	}
	
	/*
	 * Tries to establish a connection to a database.
	 */
	protected function connect() {
		
		//Check whether all connection data was specified.
		if (!isset($this->host) or
			!isset($this->dbUser) or
			!isset($this->password) or
			!isset($this->dbName)) {
			throw new Exception('Database connection failed: Invalid database connection configuration.');
		}
		
		//Try to connect
		$this->dbConnection = new mysqli($this->host, $this->dbUser, $this->password, $this->dbName);
		
		//On error throw exception.
		if($this->dbConnection->connect_error) {
		    throw new Exception('Database connection failed...' . 'Error: ' . $this->dbConnection->connect_errno 
			   . ' ' . $this->dbConnection->connect_error);
		} else {
		    $this->dbConnection->set_charset('utf8mb4');
		}
	}
	
	/*
	 * Executes a query on the database this context connected to.
	 */
	protected function query($queryString) {
		
		//If no connection exists yet, try to establish one.
		if (!isset($this->dbConnection)) {
			try {
				$this->connect();
			}
			catch (Exception $e) {
				echo 'Error occurred while connecting to database ' . $this->dbName . ': ' . $e->getMessage() . '\n';
				return null;
			}
		}
		
		//Execute query
		$rs = $this->dbConnection->query($queryString)
		or die('Error while querying the database: ' . $this->dbConnection->error);

		return $rs;
	}
}


?>