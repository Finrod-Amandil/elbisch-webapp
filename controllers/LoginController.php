<?php

require_once("./persistence/UsersDbContext.php");

class LoginController extends Controller {
	public static function Login() {
		if (!isset($_POST["email"]) or
			!isset($_POST["password"])) {
			return;
		}
		
		$email = $_POST["email"];
		$password = $_POST["password"];
		
		$dbContext = new UsersDbContext();
		
		$canAuthenticate = $dbContext->tryLogin($email, $password);
		
		if ($canAuthenticate) {
			$loginMessage = "Sie wurden erfolgreich eingeloggt!";
		}
		else {
			$loginMessage = "Login fehlgeschlagen! Bitte versuchen Sie es erneut.";
		}
		
		require_once("./views/Login.php");
	}
	
	public static function Register() {
		if (!isset($_POST["email"]) or
			!isset($_POST["password"]) or
			!isset($_POST["password_2"])) {
			return;
		}
		
		$email = $_POST["email"];
		$password = $_POST["password"];
		$password_2 = $_POST["password_2"];
		
		$dbContext = new UsersDbContext();
		$existingUser = $dbContext->getUserByUserName($email);
		
		if ($existingUser != null) {
			$registerMessage = "Registrierung fehlgeschlagen. Die E-mail Adresse wird bereits verwendet.";
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$registerMessage = "Registrierung fehlgeschlagen. Ungültige E-mail Adresse.";
		}
		else if (strcmp($password, $password_2) != 0) {
			$registerMessage = "Registrierung fehlgeschlagen. Die beiden Passwörter stimmten nicht überein.";
		}
		else {
			$dbContext->registerNewUser($email, $password);
			$registerMessage = "Registrierung erfolgreich!";
		}
		
		require_once("./views/Register.php");
	}
}

?>