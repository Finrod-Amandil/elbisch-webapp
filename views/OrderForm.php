<!DOCTYPE html>
<?php
/*
 * file: views/OrderForm.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-24: Severin Zahler: added file
 * - 2018-10-24: Nadine Seiler: finished all fields and design
 * - 2018-10-27: Nadine Seiler: small fixes for data submission
 * - 2018-10-28: Severin Zahler: Added script for toggling fields with dependant visibility.
 * - 2018-10-29: Nadine Seiler: updated comments.
 *
 * summary:
 * The order form view.
 */

?>

<?php 
//Session is required as email is filled out automatically if user is logged in.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
	session_regenerate_id();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<?php include 'views/common/resources-common.php'; ?>
		<link rel="stylesheet" type="text/css" href="static/css/styles-orderform.css">
		
		<script type="text/javascript">
			//Shows and hides form sections depending on order type selection.
			function toggleFormElements() {
				//Get selected value from order type select
				var selectElement = document.getElementById('select_conlang');
				var value = selectElement[selectElement.selectedIndex].value;
				
				//Hide all toggleable elements
				[...document.getElementsByClassName("show-always")].forEach(function(element) {
					element.style.display = "none";
				});
				[...document.getElementsByClassName('show-translation')].forEach(function(element) {
					element.style.display = "none";
				});
				[...document.getElementsByClassName('show-transcription')].forEach(function(element) {
					element.style.display = "none";
				});
				
				//If any selection was made, show fields marked as "show-always"
				if (value !== "0") {
					[...document.getElementsByClassName('show-always')].forEach(function(element) {
						element.style.display = "flex";
					});
				}
				
				//Show translation and/or transcription related elements, according to selection.
				if (value.includes("translation")) {
					[...document.getElementsByClassName('show-translation')].forEach(function(element) {
						element.style.display = "flex";
					});
				}
				if (value.includes("transcription")) {
					[...document.getElementsByClassName('show-transcription')].forEach(function(element) {
						element.style.display = "flex";
					});
				}
			}
			
			//Toggles highlighting of selected scripts
			function selectScript(id){
				if (document.getElementById('checkbox-' + id).checked ||
				    (document.getElementById('checkbox-' + id + "-cap") != null && document.getElementById('checkbox-' + id + "-cap").checked)) {
					document.getElementById('row-' + id).style.background = "rgba(255,255,255,0.5)";
				}
				else {
					document.getElementById('row-' + id).style.background = "rgba(255,255,255,0)";
				}
			}
			
			//Toggles cap / no-cap font display on fonts with that option.
			function setCap(id){
				var list = document.getElementById('mark-' + id).children
				selectScript(id);
				
				if (document.getElementById('checkbox-' + id + "-cap").checked) {
					var i;
					for (i = 0; i < list.length; i++) {
						var el = list[i];
						
						if (el.className == "cap") {
							el.className = ("cap " + id + "-cap");
						}
						
						if (el.className == "cap-vowel") {
							el.style.fontSize = "36px";
						}
					}
				}
				else {
					var i;
					for (i = 0; i < list.length; i++) {
						var el = list[i];
						
						if (el.className == ("cap " + id + "-cap")) {
							el.className = "cap";
						}
						
						if (el.className == "cap-vowel") {
							el.style.fontSize = "30px";
						}
					}
				}
			}
		</script>
		
		<title>elbisch.ch - Anfrageformular</title>
		
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
						<div class="title title-margin">Anfrageformular</div>
						
						<!-- FORM BEGIN -->
						<form class="orderform" method="post" action="./submit-order">
							<div class="elements-container">
								<div class="row">
									<div class="col-xl-3 col-lg-4 label">
										<p>Name</p>
									</div>
									<div class="col-xl-4 col-lg-5">
										<input class="form-control" type="text" name="name" id="input-name">
									</div>
									<div class="col-xl-5 col-lg-3 hint">
										<p>Optional, nur für die Anrede</p>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-3 col-lg-4 label">
										<p>E-mail <span class="required">*</span></p>
									</div>
									<div class="col-xl-5 col-lg-5">
										<?php
										//If user is logged in, fill out email adress automatically and lock field.
										if (isset($_SESSION["logged_in"])) {
											echo('<input disabled value="' . $_SESSION["username"] . '" class="form-control" type="text" name="email" id="input-email">');
										}
										else {
											echo('<input class="form-control" type="text" name="email" id="input-email">');
										}
										?>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-3 col-lg-4 label">
										<p>Auftragstyp <span class="required">*</span></p>
									</div>
									<div class="col-xl-5 col-lg-5 select-div">
										<select class="form-control" id="select_conlang" name="order_type" onchange="toggleFormElements();">
										    <option value="0" class="none-selected">- Bitte auswählen -</option>
										    <option value="translation-transcription">Übersetzung + Transkription</option>
										    <option value="transcription">Nur Transkription</option>
										    <option value="translation">Nur Übersetzung</option>
										    <option value="other">Andere Frage</option>
										</select>
									</div>
								</div>
								
								<!-- BEYOND HERE: INVISIBLE BY DEFAULT! Toggled by script connected to select above. -->
								<div class="row show-translation" id="row-lang" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Sprache <span class="required">*</span></p>
									</div>
									<div class="form-group col-xl-2 col-lg-3 form-group-lang">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input" id="checkbox-quenya" value="quenya" name="language_quenya">
												<p>Quenya</p>
											</label>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input" id=" checkbox-sindarin" value="sindarin" name="language_sindarin">
												<p>Sindarin</p>
											</label>
										</div>
									</div>
								</div>
								<div class="row show-transcription" id="row-script" style="display:none">
									<div class="col-lg-3 label scripts-label">
										<p>Schriftarten <span class="required">*</span></p>
									</div>
									
									<div class="col-lg-9">
										<table class="script-table">
											<tr>
												<th></th>
												<th class="header"><p>Groß</p></th>
												<th></th>
												<th></th>
											</tr>
											
											<tr id="row-tengwar-annatar" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-annatar');" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar" value="tengwar-annatar" name="script_tengwar-annatar">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-annatar" class="tengwar-annatar">5v$<mark class="alt tengwar-annatar-alt">j</mark>^<mark class="alt tengwar-annatar-alt">1</mark>F¡ y<mark class="alt tengwar-annatar-alt">Y</mark>7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Annatar</p>
												</td>
											</tr>
											
											<tr id="row-tengwar-annatar-bold" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-annatar-bold');" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-bold" value="tengwar-annatar-bold" name="script_tengwar-annatar-bold">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-annatar-bold" class="tengwar-annatar-bold">5v$<mark class="alt tengwar-annatar-alt-bold">j</mark>^<mark class="alt tengwar-annatar-alt-bold">1</mark>F¡ y<mark class="alt tengwar-annatar-alt-bold">Y</mark>7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Annatar bold</p>
												</td>
											</tr>
											
											<tr id="row-tengwar-annatar-italic" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-annatar-italic');" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-italic" value="tengwar-annatar-italic" name="script_tengwar-annatar-italic">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-annatar-italic" class="tengwar-annatar-italic">5v$<mark class="alt tengwar-annatar-alt-italic">j</mark>^<mark class="alt tengwar-annatar-alt-italic">1</mark>F¡ y<mark class="alt tengwar-annatar-alt-italic">H</mark>7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Annatar italic</p>
												</td>
											</tr>
											
											<tr id="row-tengwar-annatar-bold-italic" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-annatar-bold-italic');" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-bold-italic" value="tengwar-annatar-bold-italic" name="script_tengwar-annatar-bold-italic">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-annatar-bold-italic" class="tengwar-annatar-bold-italic">5v$<mark class="alt tengwar-annatar-alt-bold-italic">j</mark>^<mark class="alt tengwar-annatar-alt-bold-italic">1</mark>F¡ y<mark class="alt tengwar-annatar-alt-bold-italic">H</mark>7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Annatar bold italic</p>
												</td>
											</tr>
											
											<tr id="row-tengwar-noldor" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-noldor');" class="form-check-input checkbox-script" id="checkbox-tengwar-noldor" value="tengwar-noldor" name="script_tengwar-noldor">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-noldor');" class="form-check-input checkbox-cap" id="checkbox-tengwar-noldor-cap" value="tengwar-noldor-caps" name="script_tengwar-noldor-caps">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-noldor" class="tengwar-noldor"><mark class="cap">5</mark><mark class="cap-vowel">%</mark>v$jY1FÅ <mark class="cap">y</mark>~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Noldor</p>
												</td>
											</tr>
											
											<tr id="row-tengwar-quenya" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-quenya');" class="form-check-input checkbox-script" id="checkbox-tengwar-quenya" value="tengwar-quenya" name="script_tengwar-quenya">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-quenya');" class="form-check-input checkbox-cap" id="checkbox-tengwar-quenya-cap" value="tengwar-quenya-caps" name="script_tengwar-quenya-caps">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-quenya" class="tengwar-quenya"><mark class="cap">5</mark><mark class="cap-vowel">%</mark>v$jY1FÅ <mark class="cap">y</mark>~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Quenya</p>
												</td>
											</tr>
											<tr id="row-tengwar-sindarin" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-sindarin');" class="form-check-input checkbox-script" id="checkbox-tengwar-sindarin" value="tengwar-sindarin" name="script_tengwar-sindarin">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-sindarin');" class="form-check-input checkbox-cap" id="checkbox-tengwar-sindarin-cap" value="tengwar-sindarin-caps" name="script_tengwar-sindarin-caps">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-sindarin" class="tengwar-sindarin"><mark class="cap">5</mark><mark class="cap-vowel">%</mark>v$jY1FÅ <mark class="cap">y</mark>~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Sindarin</p>
												</td>
											</tr>
											<tr id="row-tengwar-beleriand" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-beleriand');" class="form-check-input checkbox-script" id="checkbox-tengwar-beleriand" value="tengwar-beleriand" name="script_tengwar-beleriand">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-beleriand" class="tengwar-beleriand">5%v$j^1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Beleriand</p>
												</td>
											</tr>
											<tr id="row-tengwar-elfica" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-elfica');" class="form-check-input checkbox-script" id="checkbox-tengwar-elfica" value="tengwar-elfica" name="script_tengwar-elfica">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-elfica" class="tengwar-elfica">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Elfica</p>
												</td>
											</tr>
											<tr id="row-tengwar-formal" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-formal');" class="form-check-input checkbox-script" id="checkbox-tengwar-formal" value="tengwar-formal" name="script_tengwar-formal">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-formal" class="tengwar-formal">5%v$jY1F_ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Formal</p>
												</td>
											</tr>
											<tr id="row-tengwar-parmaite" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-parmaite');" class="form-check-input checkbox-script" id="checkbox-tengwar-parmaite" value="tengwar-parmaite" name="script_tengwar-parmaite">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-parmaite" class="tengwar-parmaite">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Parmaite</p>
												</td>
											</tr>
											<tr id="row-tengwar-eldamar" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-eldamar');" class="form-check-input checkbox-script" id="checkbox-tengwar-eldamar" value="tengwar-eldamar" name="script_tengwar-eldamar">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-eldamar" class="tengwar-eldamar">5%v$<mark class="alt tengwar-eldamar-alt">É</mark>^<mark class="alt tengwar-eldamar-alt">1</mark>F¡ y<mark class="alt tengwar-eldamar-alt">H</mark>7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Eldamar</p>
												</td>
											</tr>
											<tr id="row-tengwar-galvorn" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-galvorn');" class="form-check-input checkbox-script" id="checkbox-tengwar-galvorn" value="tengwar-galvorn" name="script_tengwar-galvorn">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-galvorn" class="tengwar-galvorn">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Galvorn</p>
												</td>
											</tr>
											<tr id="row-tengwar-mornedhel" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-mornedhel');" class="form-check-input checkbox-script" id="checkbox-tengwar-mornedhel" value="tengwar-mornedhel" name="script_tengwar-mornedhel">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-mornedhel" class="tengwar-mornedhel">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Mornedhel</p>
												</td>
											</tr>
											<tr id="row-tengwar-telerin" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-telerin');" class="form-check-input checkbox-script" id="checkbox-tengwar-telerin" value="tengwar-telerin" name="script_tengwar-telerin">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-telerin" class="tengwar-telerin">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Telerin</p>
												</td>
											</tr>
											<tr id="row-tengwar-hereno" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-hereno');" class="form-check-input checkbox-script" id="checkbox-tengwar-hereno" value="tengwar-hereno" name="script_tengwar-hereno">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-hereno" class="tengwar-hereno">5%v$jY1F} y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Hereno</p>
												</td>
											</tr>
											<tr id="row-elfic-caslon" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('elfic-caslon');" class="form-check-input checkbox-script" id="checkbox-elfic-caslon" value="elfic-caslon" name="script_elfic-caslon">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-elfic-caslon" class="elfic-caslon">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Elfic Caslon</p>
												</td>
											</tr>
											<tr id="row-tengwar-gothika" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-gothika');" class="form-check-input checkbox-script" id="checkbox-tengwar-gothika" value="tengwar-gothika" name="script_tengwar-gothika">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-gothika" class="tengwar-gothika">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Gothika</p>
												</td>
											</tr>
											<tr id="row-greifswalder-tengwar" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('greifswalder-tengwar');" class="form-check-input checkbox-script" id="checkbox-greifswalder-tengwar" value="greifswalder-tengwar" name="script_greifswalder-tengwar">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-greifswalder-tengwar" class="greifswalder-tengwar">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Greifswalder Tengwar</p>
												</td>
											</tr>
											<tr id="row-tengwar-optime" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-optime');" class="form-check-input checkbox-script" id="checkbox-tengwar-optime" value="tengwar-optime" name="script_tengwar-optime">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="script-prev">
															<mark id="mark-tengwar-optime" class="tengwar-optime">5%v$jY1FÅ y~N7F`C</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Optime</p>
												</td>
											</tr>
											<tr id="row-cirth-erebor" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('cirth-erebor');" class="form-check-input checkbox-script" id="checkbox-cirth-erebor" value="cirth-erebor" name="script_cirth-erebor">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('cirth-erebor');" class="form-check-input checkbox-cap" id="checkbox-cirth-erebor-cap" value="cirth-erebor-caps" name="script_cirth-erebor-caps">
												</td>
												<td class="col3">
													<div>
														<p class="cirth-prev">
															<mark id="mark-cirth-erebor" class="cirth-erebor"><mark class="cap">@</mark>l@izab8gzI<mark class="cap">4</mark>nRzc</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Cirth Erebor</p>
												</td>
											</tr>
											<tr id="row-cirth-erebor-1" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('cirth-erebor-1');" class="form-check-input checkbox-script" id="checkbox-cirth-erebor-1" value="cirth-erebor-1" name="script_cirth-erebor-1">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="cirth-prev">
															<mark id="mark-cirth-erebor-1" class="cirth-erebor-1">@l@izab8gzI4nRzc</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Cirth Erebor 1</p>
												</td>
											</tr>
											<tr id="row-cirth-erebor-2" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('cirth-erebor-2');" class="form-check-input checkbox-script" id="checkbox-cirth-erebor-2" value="cirth-erebor-2" name="script_cirth-erebor-2">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<div>
														<p class="cirth-prev">
															<mark id="mark-cirth-erebor-2" class="cirth-erebor-2">@l@izab8gzI4nRzc</mark>
														</p>
													</div>
												</td>
												<td class="col4">
													<p class="hint">Cirth Erebor 2</p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Auftrag / Text <span class="required">*</span></p>
									</div>
									<div class="col-xl-7 col-lg-8">
										<textarea rows="5" class="form-control" id="input-text" name="order-description"></textarea>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Zusatzangebote</p>
									</div>
									<div class="col-xl-8 col-lg-7">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input" id="checkbox-derivation" value="extra_derivation" name="extra_derivation">
												<p>Herleitung</p>
											</label>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input" id=" checkbox-offer" value="extra_offer" name="extra_offer">
												<p>Offerte</p>
											</label>
										</div>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-5 col-lg-6 label">
										<p>Mein Auftrag darf in der Galerie ausgestellt werden</p>
									</div>
									<div class="col-xl-5 col-lg-5">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" checked class="form-check-input" id="checkbox-gallery" value="gallery" name="gallery">
											</label>
										</div>
										</div>
									</div>
								</div>
								<div id="container_payment" class="row show-always" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Bezahlungsart <span class="required">*</span></p>
									</div>
									<div class="col-xl-8 col-lg-7 pad-top-7">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" id="checkbox-online" value="e-banking" name="payment">
												<p>Online-Überweisung (E-Banking)</p>
											</label>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" id=" checkbox-paypal" value="paypal" name="payment">
												<p>PayPal (Kreditkarte)</p>
											</label>
										</div>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Währung der Rechnung <span class="required">*</span></p>
									</div>
									<div class="col-xl-8 col-lg-7 pad-top-7">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" id="checkbox-chf" value="chf" name="currency">
												<p>CHF - Schweizer Franken</p>
											</label>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" id=" checkbox-eur" value="eur" name="currency">
												<p>€ - Euro</p>
											</label>
										</div>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-9 col-lg-9">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input" id="checkbox-disclaimer" value="accept_terms" name="accept_terms">
												<p>Ich habe die <a href="./terms" target="_blank">Geschäftsbedingungen</a> gelesen und akzeptiert. 
												Zudem habe ich den <a href="./course" target="_blank">Elbisch-Crashkurs</a> gelesen und verstanden. <span class="required">*</span></p>
											</label>
										</div>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Bemerkungen</p>
									</div>
									<div class="col-xl-7 col-lg-8">
										<textarea rows="4" class="form-control" id="input-comments" name="comments"></textarea>
									</div>
								</div>	
								
								<!-- Submit button -->
								<div class="btn-submit pad-top-20">
									<div class="col-xl-12 col-lg-12">	
										<button disabled class="btn btn-secondary btn-lg btn-block" id="submit" type="submit">Auftrag kostenpflichtig und verbindlich aufgeben</button>
									</div>
								</div>
							</div>	
						</form>
					</div>
				</div>
			</div>
			
			<!-- Footer -->
			<?php include 'views/common/footer.php'; ?>
		</div>
	</body>
</html>