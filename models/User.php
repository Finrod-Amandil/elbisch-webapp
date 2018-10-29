<?php
/**
 * file: models/User.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-27: Nadine Seiler: added class
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary: Model class for user entity of database.
 */

class User {
	
	public $id = 0;
	public $email = '';
	public $password = '';
	public $passwordHash = '';
	
	public function __construct() {}
}

?>