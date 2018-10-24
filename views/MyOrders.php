<!DOCTYPE html>
<?php

/*
file: MyOrders.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-03: Severin Zahler: added file
- 2018-10-03: Nadine Seiler: added basic template
- 2018-10-24: Nadine Seiler: finished all fields according to mockup

summary:
The view of orders a customer has made
*/

?>
<html>
	<head>
		<meta charset="utf-8" />
		
		<?php $page = "about"; ?>
		<?php include 'views/common/resources-common.php'; ?>
		<link rel="stylesheet" type="text/css" href="static/css/styles-index.css">
		
		<title>elbisch.ch - Bestellübersicht</title>
		
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
						<div class="title title-margin">Meine Bestellungen</div>
						<div class="container-order row">
							<div class="col-xl-6 col-lg-6">
								<p><span class="text-bold">Bestellnummer:</span> 18023</p>
								<p><span class="text-bold">Aufgabedatum:</span> 19.09.2018</p>
								<p><span class="text-bold">Status:</span> <span class="text-progress">In Bearbeitung</span></p>
							</div>
							<div class="col-xl-6 col-lg-6">
								<p><span class="text-bold">Auftragsart:</span> Übersetzung</p>
								<p><span class="text-bold">Sprache:</span> Quenya</p>
								<p><span class="text-bold">Text:</span> Not all those who wander are lost</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Footer -->
			<?php include 'views/common/footer.php'; ?>
		</div>

		
	</body>

</html>