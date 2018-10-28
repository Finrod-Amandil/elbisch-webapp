<?php
/*
file: navbar.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-03: Nadine Seiler: added file

summary:
The navigation bar partial view shared across all views.
*/
?>
<nav class="container-fluid navbar navbar-toggleable-md navbar-light bg-faded">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="navbar-brand-div">
		<div class="row">
			<img class="avatar" src="static/img/avatar.png" alt="">
			<a class="navbar-brand" href="./">elbisch.ch</a>
		</div>
		<div class="row lang-switches-div">
			<p class="lang-switches"><mark class="lang-switch lang-de">DE</mark> | <mark class="lang-switch lang-en">EN</mark></p>
		</div>
	</div>

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
				<a class="nav-link" href="./faq">
					<div class="lg-only"><br></div>
					FAQ
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="./gallery" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="lg-only"><br></div>
					Galerie
					<div class="lg-only"></div>
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
					<li><a class="dropdown-item" href="./gallery"><i class="fa fa-angle-right" aria-hidden="true"></i> Zitate, Gedichte und mehr!</a></li>
					<li><a class="dropdown-item" href="./names"><i class="fa fa-angle-right" aria-hidden="true"></i> Elbische Namensliste</a></li>
					<li><a class="dropdown-item" href="./oonagh"><i class="fa fa-angle-right" aria-hidden="true"></i> Oonagh (deutsch-elbische Pop-Sängerin)</a></li>
				</ul>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="./conlangdb" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Conlang -
					<div class="lg-only"></div>
					Datenbank
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink3">
					<li><a class="dropdown-item" href="./conlangdb"><i class="fa fa-angle-right" aria-hidden="true"></i> Wörterbuch der Sprachen von Mittelerde</a></li>
					<li><a class="dropdown-item" href="./conlangdbnew"><i class="fa fa-angle-right" aria-hidden="true"></i> Neue Einträge erfassen</a></li>
					<li><a class="dropdown-item" href="./conlangdbtranslate"><i class="fa fa-angle-right" aria-hidden="true"></i> Datenbank übersetzen</a></li>
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
			<li class="nav-item">
				<a class="nav-link" data-toggle="modal" data-target="#login">
					<div class="lg-only"><br></div>
					Login
				</a>
			</li>
		</ul>
	</div>
</nav>

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
	$('ul.navbar-nav li.dropdown').hover(
	function() { //when mouse is over element
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, 
	function() { //when mouse is no longer over element
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});

	$('mark.lang-de').click(
	function() {
		var path = window.location.pathname;
		if (path.substring(path.length - 1) == "/") {
			path = path + "index";
		}
		if (path.indexOf(".php") == -1) {
			path = path + ".php";
		}
		path = path + "?lang=de";
		window.location.href = path;
	});
	
	$('mark.lang-en').click(
	function() {
		var path = window.location.pathname;
		if (path.substring(path.length - 1) == "/") {
			path = path + "index";
		}
		if (path.indexOf(".php") == -1) {
			path = path + ".php";
		}
		path = path + "?lang=en";
		window.location.href = path;
	});
</script>