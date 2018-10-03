<?php
/*
file: footer.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-03: Nadine Seiler: added class

summary:
Footer partial view shared across all views
*/
?>
<div class="footer container-fluid">
	<div class="footer-lower row">
		<div class="footer-col-l">
			<p>&copy; <?php echo date("Y"); ?> <a href="./">elbisch.ch</a></p>
		</div>
		<div class="footer-col-c">
			<p><a href="./imprint">Impressum</a> | 
			<a href="./imprint.php#privacy">Datenschutz</a><mark class="lg-only"> | </mark><br class="sm-only">
			<a href="./terms">Geschäftsbedingungen</a>
		</div>
		<div class="footer-col-r">
			<p>elbisch.ch<br />
			Severin Zahler<br />
			Kontaktformular</p>
		</div>
	</div>
</div>