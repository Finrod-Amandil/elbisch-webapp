<?php
/**
 * file: controllers/LoginController.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-27: Severin Zahler: added class with Login, Register and Logout functions
 * - 2018-10-28: Nadine Seiler: Added session handling and logout
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary: Controller for views and actions around user authentication
 *          and registration.
 */

require_once("./persistence/UsersDbContext.php");

class LoginController extends Controller {
	
	/**
	 * Endpoint for Login attempt. Validates user credentials
	 * and then looks up whether the password is correct.
	 * Redirects to Login view with message whether the
	 * login attempt was successful or not. If successful,
	 * starts a new session.
	 */
	public static function Login() {
		//Check whether required data was submitted
		if (!isset($_POST["email"]) or
			!isset($_POST["password"])) {
			return;
		}
		
		$email = $_POST["email"];
		$password = $_POST["password"];
		
		$dbContext = new UsersDbContext();
		
		//Authenticate user
		$canAuthenticate = $dbContext->tryLogin($email, $password);
		
		if ($canAuthenticate) {
			session_start();
			session_regenerate_id();
			$_SESSION["logged_in"] = true;
			$_SESSION["username"] = $email;
			$loginMessage = "Sie wurden erfolgreich eingeloggt!";
		}
		else {
			$loginMessage = "Login fehlgeschlagen! Bitte versuchen Sie es erneut.";
		}
		
		require_once("./views/Login.php");
	}
	
	/*
	 * Endpoint for user registration. Validates the user input
	 * and makes sure no user with the same E-mail address has
	 * been registered already. If all inputs are valid, creates
	 * and user, stores him to the database and starts a new session.
	 */
	public static function Register() {
		//Check whether required data was submitted
		if (!isset($_POST["email"]) or
			!isset($_POST["password"]) or
			!isset($_POST["password_2"])) {
			return;
		}
		
		$email = $_POST["email"];
		$password = $_POST["password"];
		$password_2 = $_POST["password_2"];
		
		$dbContext = new UsersDbContext();
		
		//Check if a user with that E-mail already exists
		$existingUser = $dbContext->getUserByUserName($email);
		
		if ($existingUser != null) {
			$registerMessage = "Registrierung fehlgeschlagen. Die E-mail Adresse wird bereits verwendet.";
		}
		//Validate E-mail for valid format
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$registerMessage = "Registrierung fehlgeschlagen. Ungültige E-mail Adresse.";
		}
		//Check if the inputs from the two password fields match
		else if (strcmp($password, $password_2) != 0) {
			$registerMessage = "Registrierung fehlgeschlagen. Die beiden Passwörter stimmten nicht überein.";
		}
		else {
			$dbContext->registerNewUser($email, $password);
			session_start();
			session_regenerate_id();
			$_SESSION["logged_in"] = true;
			$_SESSION["username"] = $email;
			$registerMessage = "Registrierung erfolgreich!";
		}
		
		require_once("./views/Register.php");
	}
	
	/*
	 * Endpoint for logging out a User. Terminates the current
	 * session.
	 */
	public static function Logout() {
		session_start();
		$_SESSION = array();
		session_destroy();
		
		$logoutMessage = "Sie wurden erfolgreich abgemeldet.";
		require_once("./views/Logout.php");
	}
}

?>