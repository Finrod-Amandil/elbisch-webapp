<?php
/*
 * file: views/common/navbar.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-03: Nadine Seiler: added file
 * - 2018-10-27: Severin Zahler: added dialogs for Login and Registration
 * - 2018-10-29: Nadine Seiler: updated comments
 * - 2018-10-29: Severin Zahler: Added front-end validation for Login.
 * - 2018-10-30: Severin Zahler: Added front-end validation for Registration.
 * - 2018-10-30: Severin Zahler: Added styling for dialogs
 *
 * summary:
 * The navigation bar partial view shared across all views. Also contains
 * the dialogs for login and registration. Menu items change depending on
 * whether user is logged in or not.
 */
?>

<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
	session_regenerate_id();
}
?>
<nav class="container-fluid navbar navbar-toggleable-md navbar-light bg-faded">
	<!-- Button to toggle navbar for small screens -->
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<!-- Branding in top left corner with language switches -->
	<div class="navbar-brand-div">
		<div class="row">
			<img class="avatar" src="static/img/avatar.png" alt="">
			<a class="navbar-brand" href="./">elbisch.ch</a>
		</div>
		<div class="row lang-switches-div">
			<p class="lang-switches"><mark class="lang-switch lang-de">DE</mark> | <mark class="lang-switch lang-en">EN</mark></p>
		</div>
	</div>

	<!-- Navigation items -->
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="./">
					<div class="lg-only"><br></div>
					Startseite
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./course">
					Elbisch -
					<div class="lg-only"></div>
					Crashkurs
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="./order" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Auftrag
					<div class="lg-only"></div>
					aufgeben
					<div class="lg-only"></div>
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
					<li><a class="dropdown-item" href="./order"><i class="fa fa-angle-right" aria-hidden="true"></i> Allgemeine Infos & Warteliste</a></li>
					<li><a class="dropdown-item" href="./terms"><i class="fa fa-angle-right" aria-hidden="true"></i> Geschäftsbedingungen</a></li>
					<li><a class="dropdown-item" href="./pricing"><i class="fa fa-angle-right" aria-hidden="true"></i> Preise</a></li>
					<li><a class="dropdown-item" href="./orderform"><i class="fa fa-angle-right" aria-hidden="true"></i> Anfrageformular</a></li>
				</ul>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./links">
					<div class="lg-only"><br></div>
					Links
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./about">
					<div class="lg-only"><br></div>
					Über mich
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="./contact">
					<div class="lg-only"><br></div>
					Kontakt
				</a>
			</li>
			<?php if (!isset($_SESSION["logged_in"])) {
			//Login menu item only shown if user is logged out.
			echo('<li class="nav-item">');
				echo('<a class="nav-link" data-toggle="modal" data-target="#login">');
					echo('<div class="lg-only"><br></div>');
					echo('Login');
				echo('</a>');
			echo('</li>');
			
			} else {
			
			//If user is logged in, Logout and MyOrders links are shown.
			echo('<li class="nav-item">');
				echo('<a class="nav-link" href="./myorders">');
					echo('Meine');
					echo('<div class="lg-only"></div>');
					echo('Aufträge');
					echo('<div class="lg-only"></div>');
				echo('</a>');
			echo('</li>');			
			echo('<li class="nav-item">');
				echo('<a class="nav-link" href="./logout">');
					echo('<div class="lg-only"><br></div>');
					echo('Logout');
				echo('</a>');
			echo('</li>');
			}
			?>
		</ul>
	</div>
</nav>

<!-- Front-end validation for login -->
<script type="text/javascript">
	function validateLoginForm() {
		var emailValue = document.getElementById("input_login_email").value;
		var emailErrorSpan = document.getElementById("validation_error_login_email");
		
		var passwordValue = document.getElementById("input_login_password").value;
		var passwordErrorSpan = document.getElementById("validation_error_input_password");
		
		var isFormValid = true;
		
		emailErrorSpan.style.display = "none";
		passwordErrorSpan.style.display = "none";
		
		if (isEmpty(emailValue)) {
			isFormValid = false;
			emailErrorSpan.style.display = "block";
			emailErrorSpan.innerHTML = "Bitte füllen Sie das Feld \"E-Mail\" aus.";
		}
		
		if (isEmpty(passwordValue)) {
			isFormValid = false;
			passwordErrorSpan.style.display = "block";
			passwordErrorSpan.innerHTML = "Bitte füllen Sie das Feld \"Passwort\" aus.";
		}
		
		if (isFormValid) {
			var form = document.getElementById("form_login");
			form.submit();
		}
	}
	
	
	function isEmpty(str) 
	{
		return (!str || 0 === str.length);
	}
	
	function isValidEmail(email) 
	{
		var regex = /\S+@\S+\.\S+/;
		return regex.test(email);
	}
</script>

<!-- Modal dialog for login -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login_dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content content-container">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="login_dialog">Login</h4>
			</div>
			<form id="form_login" method="post" action="./login">
				<div class="modal-body">
					<div class="row"><p>Bitte geben Sie ihre Login-Daten ein.</p></div>
					<div class="row">
						<div class="dialog-label">
							<p>E-Mail</p>
						</div>
						<div class="dialog-input">
							<input id="input_login_email" type="text" name="email" class="form-control"/>
							<span id="validation_error_login_email" class="validation-error"></span>
						</div>
					</div>
					<div class="row">
						<div class="dialog-label">
							<p>Passwort</p>
						</div>
						<div class="dialog-input">
							<input id="input_login_password" type="password" name="password" class="form-control"/>
							<span id="validation_error_input_password" class="validation-error"></span>
						</div>
					</div>
					<div class="row">
						<!-- Register link closes this modal and opens another one -->
						<p>Noch keinen Account? <a data-toggle="modal" data-target="#register" data-dismiss="modal" class="dialog-link">Registrieren</a></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" onclick="validateLoginForm();">Login</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Front-end validation for registration -->
<script type="text/javascript">
	function validateRegistrationForm() {
		var emailValue = document.getElementById("input_register_email").value;
		var emailErrorSpan = document.getElementById("validation_error_register_email");
		
		var passwordValue = document.getElementById("input_register_password").value;
		var passwordErrorSpan = document.getElementById("validation_error_register_password");
		
		var password2Value = document.getElementById("input_register_password2").value;
		var password2ErrorSpan = document.getElementById("validation_error_register_password2");
		
		var isFormValid = true;
		
		emailErrorSpan.style.display = "none";
		passwordErrorSpan.style.display = "none";
		password2ErrorSpan.style.display = "none";
		
		if (isEmpty(emailValue)) {
			isFormValid = false;
			emailErrorSpan.style.display = "block";
			emailErrorSpan.innerHTML = "Bitte füllen Sie das Feld \"E-Mail\" aus.";
		}
		else if (!isValidEmail(emailValue)) {
			isFormValid = false;
			emailErrorSpan.style.display = "block";
			emailErrorSpan.innerHTML = "Die E-Mail-Adresse ist ungültig.";
		}
		
		if (isEmpty(passwordValue)) {
			isFormValid = false;
			passwordErrorSpan.style.display = "block";
			passwordErrorSpan.innerHTML = "Bitte füllen Sie das Feld \"Passwort\" aus.";
		}
		
		if (isEmpty(password2Value)) {
			isFormValid = false;
			password2ErrorSpan.style.display = "block";
			password2ErrorSpan.innerHTML = "Bitte füllen Sie das Feld \"Passwort wiederholen\" aus.";
		}
		else if (passwordValue !== password2Value) {
			isFormValid = false;
			passwordErrorSpan.style.display = "block";
			passwordErrorSpan.innerHTML = "Die beiden Passwörter stimmen nicht überein.";
			password2ErrorSpan.style.display = "block";
			password2ErrorSpan.innerHTML = "Die beiden Passwörter stimmen nicht überein.";
		}
		
		if (isFormValid) {
			var form = document.getElementById("form_register");
			form.submit();
		}
	}
</script>

<!-- Modal dialog for registration -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="register_dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content content-container">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="login_dialog">Registrieren</h4>
			</div>
			<form id="form_register" method="post" action="./register">
				<div class="modal-body">
					<div class="row"><p>Bitte geben Sie ihre Login-Daten ein.</p></div>
					<div class="row">
						<div class="dialog-label">
							<p>E-Mail</p>
						</div>
						<div class="dialog-input">
							<input id="input_register_email" type="text" name="email" class="form-control"/>
							<span id="validation_error_register_email" class="validation-error"></span>
						</div>
					</div>
					<div class="row">
						<div class="dialog-label">
							<p>Passwort</p>
						</div>
						<div class="dialog-input">
							<input id="input_register_password" type="password" name="password" class="form-control"/>
							<span id="validation_error_register_password" class="validation-error"></span>
						</div>
					</div>
					<div class="row">
						<div id="label_password2" class="dialog-label">
							<p>Passwort wiederholen</p>
						</div>
						<div class="dialog-input">
							<input id="input_register_password2" type="password" name="password_2" class="form-control"/>
							<span id="validation_error_register_password2" class="validation-error"></span>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button"  class="btn" onclick="validateRegistrationForm();">Registrieren</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	//Dropdown menu opens when hovered over.
	$('ul.navbar-nav li.dropdown').hover(
	function() { //when mouse is over element
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, 
	function() { //when mouse is no longer over element
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});
</script>