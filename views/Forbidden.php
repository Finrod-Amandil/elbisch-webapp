<!DOCTYPE html>
<?php
/*
 * file: views/Register.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-30: Severin Zahler: added file
 *
 * summary:
 * The Register view which displays feedback from the Register process.
 */
?>
<html>
	<head>
		<meta charset="utf-8" />
		
		<?php include 'views/common/resources-common.php'; ?>
		
		<title>elbisch.ch - Zugriff verweigert</title>
		
	</head>

	<body>
		<div id="viewport" class="container-fluid">
		
			<!-- Navigation -->
			<?php include 'views/common/navbar.php'; ?>
		
			<!-- Background -->
			<div id="bg-left" class="bg-left"></div>
			<div id="bg-right" class="bg-right"></div>
			
			<div class="row justify-content-center">
				<div id="container-outer" class="container-outer col-sm-12 col-md-12 col-lg-8">
					<div class="container-inner">
						<h1>Zugriff Verweigert (403)</h1>
						<p>Leider haben Sie keinen Zugriff auf die angeforderte Ressource.</p>
					</div>
				</div>
			</div>
			
			<!-- Footer -->
			<?php include 'views/common/footer.php'; ?>
		</div>

		
	</body>

</html>