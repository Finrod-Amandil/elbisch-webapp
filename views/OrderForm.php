<!DOCTYPE html>
<?php

/*
file: Index.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-03: Severin Zahler: added file
- 2018-10-03: Nadine Seiler: added basic template

summary:
The Index view (home page)
*/

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<?php $page = "orderform"; ?>
		<?php include 'views/common/resources-common.php'; ?>
		<link rel="stylesheet" type="text/css" href="static/css/styles-orderform.css">
		
		<script type="text/javascript">
			$(function () {
			  $('[data-toggle="popover"]').popover()
			})
			
			function selectScript(id){
				if (document.getElementById('checkbox-' + id).checked) {
					document.getElementById('row-' + id).style.background = "rgba(255,255,255,0.5)";
				}
				else {
					document.getElementById('row-' + id).style.background = "rgba(255,255,255,0)";
				}
			}
			
			function setCap(id){
				var list = document.getElementById('mark-' + id).children
				
				if (document.getElementById('checkbox-' + id + "-cap").checked) {
					document.getElementById('checkbox-' + id).checked = true;
					selectScript(id);

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
						
						<form class="orderform">
							<div class="elements-container">
								<div class="row">
									<div class="col-xl-2 col-lg-3 label">
										<p>Name</p>
									</div>
									<div class="col-xl-4 col-lg-5">
										<input class="form-control" type="text" id="input-name">
									</div>
									<div class="col-xl-6 col-lg-4 hint">
										<p>Optional, nur für die Anrede</p>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-2 col-lg-3 label">
										<p>E-mail<span class="required">*</span></p>
									</div>
									<div class="col-xl-4 col-lg-5">
										<input class="form-control" type="text" id="input-name">
									</div>
									<div class="col-xl-6 col-lg-4 hint">
										<p>Wird für die weitere Kommunikation verwendet</p>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-2 col-lg-3 label">
										<p>Auftragstyp<span class="required">*</span></p>
									</div>
									<div class="col-xl-5 col-lg-5 select-div">
										<select class="form-control" id="conlang">
										    <option value="0" class="none-selected">- Bitte auswählen -</option>
										    <option value="1">Übersetzung + Transkription</option>
										    <option value="2">Transkription</option>
										    <option value="3">Übersetzung</option>
										    <option value="4">Andere Frage</option>
										</select>
									</div>
								</div>
								<div class="row" id="row-lang">
									<div class="col-xl-2 col-lg-3 label">
										<p>Sprache<span class="required">*</span></p>
									</div>
									<div class="form-group col-xl-2 col-lg-3 form-group-lang">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input" id="checkbox-quenya" value="q">
												<p>Quenya</p>
											</label>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input" id=" checkbox-sindarin" value="s">
												<p>Sindarin</p>
											</label>
										</div>
									</div>
									<div class="col-xl-8 col-lg-6 hint">
										<p>Ich empfehle dir, dich für eine Sprache zu entscheiden und nicht beide anzuwählen, ausser du brauchst wirklich die Übersetzung in beide Sprachen.</p>
									</div>
								</div>
								<div class="row" id="row-lang">
									<div class="col-lg-2 label scripts-label">
										<p>Schriftarten<span class="required">*</span></p>
									</div>
									
									<div class="col-lg-10">
										<table class="script-table">
											<tr>
												<th></th>
												<th class="header"><p>Groß</p></th>
												<th></th>
												<th></th>
											</tr>
											<tr id="row-tengwar-annatar" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-annatar');" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-annatar-bold');" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-bold" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-annatar-italic');" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-italic" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-annatar-bold-italic');" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-bold-italic" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-noldor');" class="form-check-input checkbox-script" id="checkbox-tengwar-noldor" value="">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-noldor');" class="form-check-input checkbox-cap" id="checkbox-tengwar-noldor-cap" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-quenya');" class="form-check-input checkbox-script" id="checkbox-tengwar-quenya" value="">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-quenya');" class="form-check-input checkbox-cap" id="checkbox-tengwar-quenya-cap" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-sindarin');" class="form-check-input checkbox-script" id="checkbox-tengwar-sindarin" value="">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-sindarin');" class="form-check-input checkbox-cap" id="checkbox-tengwar-sindarin-cap" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-beleriand');" class="form-check-input checkbox-script" id="checkbox-tengwar-beleriand" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-elfica');" class="form-check-input checkbox-script" id="checkbox-tengwar-elfica" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-formal');" class="form-check-input checkbox-script" id="checkbox-tengwar-formal" value="">
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
											<!--<tr id="row-tengwar-cursive" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-cursive');" class="form-check-input checkbox-script" id="checkbox-tengwar-cursive" value="">
												</td>
												<td class="col2">
												</td>
												<td class="col3">
													<p class="script-prev">
														<mark id="mark-tengwar-cursive" class="tengwar-cursive">5%v$j^1F+ y~N7F`C</mark>
													</p>
												</td>
												<td class="col4">
													<p class="hint">Tengwar Cursive</p>
												</td>
											</tr>-->
											<tr id="row-tengwar-parmaite" class="script-row">
												<td class="col1">
													<input type="checkbox" onclick="selectScript('tengwar-parmaite');" class="form-check-input checkbox-script" id="checkbox-tengwar-parmaite" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-eldamar');" class="form-check-input checkbox-script" id="checkbox-tengwar-eldamar" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-galvorn');" class="form-check-input checkbox-script" id="checkbox-tengwar-galvorn" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-mornedhel');" class="form-check-input checkbox-script" id="checkbox-tengwar-mornedhel" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-telerin');" class="form-check-input checkbox-script" id="checkbox-tengwar-telerin" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-hereno');" class="form-check-input checkbox-script" id="checkbox-tengwar-hereno" value="">
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
													<input type="checkbox" onclick="selectScript('elfic-caslon');" class="form-check-input checkbox-script" id="checkbox-elfic-caslon" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-gothika');" class="form-check-input checkbox-script" id="checkbox-tengwar-gothika" value="">
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
													<input type="checkbox" onclick="selectScript('greifswalder-tengwar');" class="form-check-input checkbox-script" id="checkbox-greifswalder-tengwar" value="">
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
													<input type="checkbox" onclick="selectScript('tengwar-optime');" class="form-check-input checkbox-script" id="checkbox-tengwar-optime" value="">
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
													<input type="checkbox" onclick="selectScript('cirth-erebor');" class="form-check-input checkbox-script" id="checkbox-cirth-erebor" value="">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('cirth-erebor');" class="form-check-input checkbox-cap" id="checkbox-cirth-erebor-cap" value="">
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
													<input type="checkbox" onclick="selectScript('cirth-erebor-1');" class="form-check-input checkbox-script" id="checkbox-cirth-erebor-1" value="">
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
													<input type="checkbox" onclick="selectScript('cirth-erebor-2');" class="form-check-input checkbox-script" id="checkbox-cirth-erebor-2" value="">
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
								<div class="row">
									<div class="col-xl-2 col-lg-3 label">
										<p>Auftrag / Text<span class="required">*</span></p>
									</div>
									<div class="col-xl-8 col-lg-8">
										<textarea class="form-control" id="input-text"></textarea>
									</div>
								</div>
							</div>

							<div class="btn-submit">
								<button class="btn btn-secondary btn-lg btn-block" id="submit" type="button">Auftrag aufgeben</button>
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