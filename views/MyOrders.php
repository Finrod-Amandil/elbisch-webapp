<!DOCTYPE html>
<?php
/*
 * file: views/MyOrders.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-24: Severin Zahler: added file
 * - 2018-10-24: Nadine Seiler: finished all fields according to mockup
 *
 * summary:
 * The view of orders a customer has made
 */
 
 require_once("./viewModels/OrderViewModel.php");
?>
<html>
	<head>
		<meta charset="utf-8" />
		
		<?php include 'views/common/resources-common.php'; ?>
		<link rel="stylesheet" type="text/css" href="static/css/styles-myorders.css">
		
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
						
						<?php
						if (!isset($orderViewModels) or sizeof($orderViewModels) == 0) {
							echo('<p>Es wurden keine Bestellungen gefunden!</p>');
						}
						else {
							foreach ($orderViewModels as $vm) {
								echo('<div class="container-order row">');
								
								echo('
								<div class="col-xl-6 col-lg-6">
									<p><span class="text-bold">Bestellnummer:</span> ' . $vm->id . '</p>
									<p><span class="text-bold">Aufgabedatum:</span> ' . $vm->date . '</p>
									<p><span class="text-bold">Status:</span> <span class="' . $vm->statusClass . '">' . $vm->status . '</span></p>
								</div>
								<div class="col-xl-6 col-lg-6">
									<p><span class="text-bold">Auftragsart:</span> ' . $vm->orderType . '</p>
									<p><span class="text-bold">Sprache:</span> ' . $vm->languages . '</p>
									<p><span class="text-bold">Text:</span> ' . $vm->text . '</p>
								</div>');
								
								if ($vm->isCompleted and $vm->hasTranslation) {
									echo('<div class="col-xl-12">');
									echo('<p><span class="text-bold">Übersetzung:</span> <span class="text-bold-italic">' . $vm->translation . '</span></p>');
									echo('</div>');
								}
								
								if ($vm->isCompleted and $vm->hasTranscription) {
									echo('<div class="col-xl-12 container-transcription">');
									echo('<p class="transcription">' . $vm->transcription . '</p>');
									echo('</div>');
								}
								
								echo('</div>');
							}
						}
						
						
						
						
						/*
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
						*/
						
						
						?>
					</div>
				</div>
			</div>
			
			<!-- Footer -->
			<?php include 'views/common/footer.php'; ?>
		</div>

		
	</body>

</html>