<?php

require_once('./models/User.php');
require_once('./persistence/DbContext.php');

class UsersDbContext extends DbContext {

	public function __construct() {
		parent::__construct('localhost', 'webuser', 'superSecurePassword', 'elbisch-webapp_users');
		
		try {
			$this->connect();
		}
		catch (Exception $e) {
			//echo 'Error occurred while connecting to database ' . $this->dbName . ': ' . $e->getMessage() . '\n';
		}
	}
	
	public function getUserByUserName($userLoginName) {
		$userLoginName = $this->dbConnection->real_escape_string($userLoginName);
		$rs = $this->query("SELECT * FROM users WHERE email LIKE '" .  $userLoginName . "';");
		
		if ($rs->num_rows != 1) {
			//echo("No single entry found for login name " . $userLoginName . ".");
			return null;
		}
		else 
		{
			$result = $rs->fetch_array();
			return $this->mapUser($result);
		}
	}
	
	public function isUserRegistered($userLoginName) {
		$user = $this->getUserByUserName($userLoginName);
		
		return isset($user);
	}
	
	public function registerNewUser($email, $password) {
		if (!isset($email) or
		    !isset($password)) {
			//echo("Incomplete user data. Did not create new user.");
			return;
		}
		
		if ($this->isUserRegistered($email)) {
			//echo("A user with the login name " . $email . " already exists.");
			return;
		}
		
		$email = $this->dbConnection->real_escape_string($email);
		$password = $this->dbConnection->real_escape_string($password);
		$passwordHash = password_hash($password, PASSWORD_BCRYPT);
		
		$query = "INSERT INTO users (email, password_hash) " .
				 " VALUES ('" . $email . "', '" . $passwordHash . "');";
				 
		$this->query($query);
	}
	
	public function tryLogin($email, $password) {
		if (!isset($email) or
		    !isset($password)) {
			//echo("Incomplete user data. Could not look up user.");
			return false;
		}
		
		$userFromDb = $this->getUserByUserName($email);
		
		if (!isset($userFromDb)) {
			return;
		}
		
		return password_verify($password, $userFromDb->passwordHash);
	}

	private function mapUser($dbEntryRow) {
		$user = new User();
		$user->id = $dbEntryRow['id_user'];
		$user->email = $dbEntryRow['email'];
		$user->passwordHash = $dbEntryRow['password_hash'];
		
		return $user;
	}
	
}
?>