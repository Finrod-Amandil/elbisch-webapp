<?php

/**
 * file: persistence/UsersDbContext.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-27: Severin Zahler: added class
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary: Abstraction of Users-Database access.
 */

require_once('./models/User.php');
require_once('./persistence/DbContext.php');

class UsersDbContext extends DbContext {

	/**
	 * Initializes a new DbContext with the connection data of the
	 * users DB and connects to it.
	 */
	public function __construct() {
		parent::__construct('localhost', 'webuser', 'superSecurePassword', 'elbisch-webapp_users');
		
		try {
			$this->connect();
		}
		catch (Exception $e) {}
	}
	
	/**
	 * Loads and returns the User with the given username.
	 */
	public function getUserByUserName($userLoginName) {
		$userLoginName = $this->dbConnection->real_escape_string($userLoginName);
		$rs = $this->query("SELECT * FROM users WHERE email LIKE '" .  $userLoginName . "';");
		
		//If not exactly one user was found, return nothing.
		if ($rs->num_rows != 1) {
			return null;
		}
		else 
		{
			$result = $rs->fetch_array();
			return $this->mapUser($result);
		}
	}
	
	/**
	 * Looks up whether a User with the given login name exists in the DB.
	 */
	public function isUserRegistered($userLoginName) {
		$user = $this->getUserByUserName($userLoginName);
		
		return isset($user);
	}
	
	/**
	 * Saves a new user to the database, if no user with the same E-mail 
	 * has already been registered
	 */
	public function registerNewUser($email, $password) {
		if (!isset($email) or
		    !isset($password)) {
			return;
		}
		
		//Check whether user already exists
		if ($this->isUserRegistered($email)) {
			return;
		}
		
		$email = $this->dbConnection->real_escape_string($email);
		
		//Encrypt password
		$passwordHash = password_hash($password, PASSWORD_BCRYPT);
		
		$query = "INSERT INTO users (email, password_hash) " .
				 " VALUES ('" . $email . "', '" . $passwordHash . "');";
				 
		$this->query($query);
	}
	
	/**
	 * Looks up the user credentials and checks whether the passwords match.
	 */
	public function tryLogin($email, $password) {
		if (!isset($email) or
		    !isset($password)) {
			return false;
		}
		
		$userFromDb = $this->getUserByUserName($email);
		
		//If user does not exist, return false.
		if (!isset($userFromDb)) {
			return false;
		}
		
		return password_verify($password, $userFromDb->passwordHash);
	}

	/**
	 * Builds a User instance from an entry of the DB resultset.
	 */
	private function mapUser($dbEntryRow) {
		$user = new User();
		$user->id = $dbEntryRow['id_user'];
		$user->email = $dbEntryRow['email'];
		$user->passwordHash = $dbEntryRow['password_hash'];
		
		return $user;
	}
	
}
?>