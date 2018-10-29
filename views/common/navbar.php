<?php
/*
 * file: views/common/navbar.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-03: Nadine Seiler: added file
 * - 2018-10-27: Severin Zahler: added dialogs for Login and Registration
 * - 2018-10-29: Nadine Seiler: updated comments
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

<!-- Modal dialog for login -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login_dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content content-container">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="login_dialog">Login</h4>
			</div>
			<form method="post" action="./login">
				<div class="modal-body">
					Bitte geben Sie ihre Login-Daten ein.
					<div class="row">
						<div class="col-xs-4">
							<p>E-mail</p>
						</div>
						<div class="col-xs-8">
							<input type="text" name="email" />
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>Passwort</p>
						</div>
						<div class="col-xs-8">
							<input type="password" name="password" />
						</div>
					</div>
					<div class="row">
						<!-- Register link closes this modal and opens another one -->
						<p>Noch keinen Account? <a data-toggle="modal" data-target="#register" data-dismiss="modal">Registrieren</a></p>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" value="Login"  class="btn" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal dialog for registration -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="register_dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content content-container">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="login_dialog">Registrieren</h4>
			</div>
			<form method="post" action="./register">
				<div class="modal-body">
					Bitte geben Sie ihre Login-Daten ein.
					<div class="row">
						<div class="col-xs-4">
							<p>E-mail</p>
						</div>
						<div class="col-xs-8">
							<input type="text" name="email" />
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>Passwort</p>
						</div>
						<div class="col-xs-8">
							<input type="password" name="password" />
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<p>Passwort wiederholen</p>
						</div>
						<div class="col-xs-8">
							<input type="password" name="password_2" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" value="Registrieren"  class="btn" />
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