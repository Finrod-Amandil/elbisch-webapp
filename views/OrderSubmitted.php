<!DOCTYPE html>
<?php
/*
 * file: views/OrderSubmitted.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-28: Severin Zahler: added file
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary:
 * The OrderSubmitted view which displays feedback after the order was submitted.
 */
?>
<html>
	<head>
		<meta charset="utf-8" />
		
		<?php include 'views/common/resources-common.php'; ?>
		<link rel="stylesheet" type="text/css" href="static/css/styles-index.css">
		
		<title>elbisch.ch - Auftrag aufgeben</title>
		
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
						<h1>Auftrag aufgegeben</h1>
						<p><?php if (isset($orderSubmitMessage)) { echo ($orderSubmitMessage); } ?></p>
					</div>
				</div>
			</div>
			
			<!-- Footer -->
			<?php include 'views/common/footer.php'; ?>
		</div>

		
	</body>

</html>