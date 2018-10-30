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
 * - 2018-10-20: Severin Zahler: Added front-end validation and error messages.
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
				var selectElement = document.getElementById('input_order_type');
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
			
			function validateForm() {
				var isFormValid = true;
				
				//Validate E-Mail
				var emailValue = document.getElementById("input_email").value;
				var emailErrorSpan = document.getElementById("validation_error_email");
				emailErrorSpan.style.display = "none";
				
				if (isEmpty(emailValue)) {
					isFormValid = false;
					emailErrorSpan.style.display = "block";
					emailErrorSpan.innerHTML = "Bitte füllen Sie das Feld \"E-Mail\" aus.";
				}
				else if(!isValidEmail(emailValue)) {
					isFormValid = false;
					emailErrorSpan.style.display = "block";
					emailErrorSpan.innerHTML = "Ungültige E-Mail-Adresse.";
				}
				
				//Validate order_type
				var orderTypeValue = document.getElementById("input_order_type").value;
				var orderTypeErrorSpan = document.getElementById("validation_error_order_type");
				orderTypeErrorSpan.style.display = "none";
				
				if (orderTypeValue == "0") {
					isFormValid = false;
					orderTypeErrorSpan.style.display = "block";
					orderTypeErrorSpan.innerHTML = "Bitte füllen Sie das Feld \"Auftragstyp\" aus.";
				}
				
				//Validate language (if visible)
				var languageErrorSpan = document.getElementById("validation_error_language");
				languageErrorSpan.style.display = "none";
				
				if (orderTypeValue.includes("translation")) {
					var languageCheckboxes = document.getElementsByClassName("checkbox-language");
					var isOneLanguageChecked = false;
					[...languageCheckboxes].forEach(function(checkbox) {
						if (checkbox.checked) {
							isOneLanguageChecked = true;
						}
					});
					
					if (!isOneLanguageChecked) {
						isFormValid = false;
						languageErrorSpan.style.display = "block";
						languageErrorSpan.innerHTML = "Bitte wählen Sie mindestens eine Sprache aus.";
					}
				}
				
				//Validate scripts (if visible)
				var scriptErrorSpan = document.getElementById("validation_error_script");
				scriptErrorSpan.style.display = "none";
				
				if (orderTypeValue.includes("transcription")) {
					var scriptCheckboxes = document.getElementsByClassName("checkbox-script");
					var scriptCapCheckboxes = document.getElementsByClassName("checkbox-cap");
					
					var isOneScriptChecked = false;
					[...scriptCheckboxes].forEach(function(checkbox) {
						if (checkbox.checked) {
							isOneScriptChecked = true;
						}
					});
					[...scriptCapCheckboxes].forEach(function(checkbox) {
						if (checkbox.checked) {
							isOneScriptChecked = true;
						}
					});
					
					if (!isOneScriptChecked) {
						isFormValid = false;
						scriptErrorSpan.style.display = "block";
						scriptErrorSpan.innerHTML = "Bitte wählen Sie mindestens eine Schriftart aus.";
					}
				}
				
				//Validate text
				var textValue = document.getElementById("input_text").value;
				var textErrorSpan = document.getElementById("validation_error_text");
				textErrorSpan.style.display = "none";
				
				if (isEmpty(textValue)) {
					isFormValid = false;
					textErrorSpan.style.display = "block";
					textErrorSpan.innerHTML = "Bitte füllen Sie das Feld \"Auftrag / Text\" aus.";
				}
				
				//Validate payment
				var paymentErrorSpan = document.getElementById("validation_error_payment");
				paymentErrorSpan.style.display = "none";
				
				var paymentCheckboxes = document.getElementsByClassName("checkbox-payment");
				var isOnePaymentChecked = false;
				[...paymentCheckboxes].forEach(function(checkbox) {
					if (checkbox.checked) {
						isOnePaymentChecked = true;
					}
				});
				
				if (!isOnePaymentChecked) {
					isFormValid = false;
					paymentErrorSpan.style.display = "block";
					paymentErrorSpan.innerHTML = "Bitte wählen Sie eine Bezahlungsart aus.";
				}
				
				//Validate currency
				var currencyErrorSpan = document.getElementById("validation_error_currency");
				currencyErrorSpan.style.display = "none";
				
				var currencyCheckboxes = document.getElementsByClassName("checkbox-currency");
				var isOneCurrencyChecked = false;
				[...currencyCheckboxes].forEach(function(checkbox) {
					if (checkbox.checked) {
						isOneCurrencyChecked = true;
					}
				});
				
				if (!isOneCurrencyChecked) {
					isFormValid = false;
					currencyErrorSpan.style.display = "block";
					currencyErrorSpan.innerHTML = "Bitte wählen Sie eine Rechnungswährung aus.";
				}
				
				//Validate terms
				var termsErrorSpan = document.getElementById("validation_error_terms");
				termsErrorSpan.style.display = "none";
				
				var termsCheckbox = document.getElementById("checkbox_terms");
				if (!termsCheckbox.checked) {
					isFormValid = false;
					termsErrorSpan.style.display = "block";
					termsErrorSpan.innerHTML = "Sie müssen die Geschäftsbedingungen akzeptieren.";
				}
				
				//Disable or enable submit button
				var submitButton = document.getElementById("btn_submit");
				var submitErrorSpan = document.getElementById("validation_error_submit");
				
				if (isFormValid) {
					submitButton.disabled = false;
					submitErrorSpan.style.display = "none";
				}
				else {
					submitButton.disabled = true;
					submitErrorSpan.style.display = "block";
					submitErrorSpan.style.display = "Bitte füllen Sie alle markierten Felder aus.";
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
			
			function submitForm() {
				document.getElementById("input_email").disabled = false;
				var form = document.getElementById("order_form").submit();
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
						<form class="orderform" method="post" action="./submit-order" id="order_form">
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
										<p>E-Mail <span class="required">*</span></p>
									</div>
									<div class="col-xl-5 col-lg-5">
										<?php
										//If user is logged in, fill out email adress automatically and lock field.
										if (isset($_SESSION["logged_in"])) {
											echo('<input disabled value="' . $_SESSION["username"] . '" class="form-control" type="text" name="email" id="input_email" oninput="validateForm();">');
											echo('<span id="validation_error_email" class="validation-error"></span>');
										}
										else {
											echo('<input id="input_email" class="form-control" type="text" name="email" oninput="validateForm();">');
											echo('<span id="validation_error_email" class="validation-error"></span>');
										}
										?>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-3 col-lg-4 label">
										<p>Auftragstyp <span class="required">*</span></p>
									</div>
									<div class="col-xl-5 col-lg-5 select-div">
										<select id="input_order_type" class="form-control" name="order_type" onchange="toggleFormElements(); validateForm();">
										    <option value="0" class="none-selected">- Bitte auswählen -</option>
										    <option value="translation-transcription">Übersetzung + Transkription</option>
										    <option value="transcription">Nur Transkription</option>
										    <option value="translation">Nur Übersetzung</option>
										    <option value="other">Andere Frage</option>
										</select>
										<span id="validation_error_order_type" class="validation-error"></span>
									</div>
								</div>
								
								<!-- BEYOND HERE: INVISIBLE BY DEFAULT! Toggled by script connected to select above. -->
								<div class="row show-translation" id="row-lang" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Sprache <span class="required">*</span></p>
									</div>
									<div class="form-group col-xl-5 col-lg-5 form-group-lang">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" onclick="validateForm();" class="form-check-input checkbox-language" id="checkbox-quenya" value="quenya" name="language_quenya">
												<p>Quenya</p>
											</label>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" onclick="validateForm();" class="form-check-input checkbox-language" id=" checkbox-sindarin" value="sindarin" name="language_sindarin">
												<p>Sindarin</p>
											</label>
										</div>
										<span id="validation_error_language" class="validation-error"></span>
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
													<input type="checkbox" onclick="selectScript('tengwar-annatar'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar" value="tengwar-annatar" name="script_tengwar-annatar">
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
													<input type="checkbox" onclick="selectScript('tengwar-annatar-bold'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-bold" value="tengwar-annatar-bold" name="script_tengwar-annatar-bold">
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
													<input type="checkbox" onclick="selectScript('tengwar-annatar-italic'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-italic" value="tengwar-annatar-italic" name="script_tengwar-annatar-italic">
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
													<input type="checkbox" onclick="selectScript('tengwar-annatar-bold-italic'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-annatar-bold-italic" value="tengwar-annatar-bold-italic" name="script_tengwar-annatar-bold-italic">
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
													<input type="checkbox" onclick="selectScript('tengwar-noldor'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-noldor" value="tengwar-noldor" name="script_tengwar-noldor">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-noldor'); validateForm();" class="form-check-input checkbox-cap" id="checkbox-tengwar-noldor-cap" value="tengwar-noldor-caps" name="script_tengwar-noldor-caps">
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
													<input type="checkbox" onclick="selectScript('tengwar-quenya'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-quenya" value="tengwar-quenya" name="script_tengwar-quenya">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-quenya'); validateForm();" class="form-check-input checkbox-cap" id="checkbox-tengwar-quenya-cap" value="tengwar-quenya-caps" name="script_tengwar-quenya-caps">
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
													<input type="checkbox" onclick="selectScript('tengwar-sindarin'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-sindarin" value="tengwar-sindarin" name="script_tengwar-sindarin">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('tengwar-sindarin'); validateForm();" class="form-check-input checkbox-cap" id="checkbox-tengwar-sindarin-cap" value="tengwar-sindarin-caps" name="script_tengwar-sindarin-caps">
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
													<input type="checkbox" onclick="selectScript('tengwar-beleriand'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-beleriand" value="tengwar-beleriand" name="script_tengwar-beleriand">
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
													<input type="checkbox" onclick="selectScript('tengwar-elfica'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-elfica" value="tengwar-elfica" name="script_tengwar-elfica">
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
													<input type="checkbox" onclick="selectScript('tengwar-formal'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-formal" value="tengwar-formal" name="script_tengwar-formal">
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
													<input type="checkbox" onclick="selectScript('tengwar-parmaite'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-parmaite" value="tengwar-parmaite" name="script_tengwar-parmaite">
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
													<input type="checkbox" onclick="selectScript('tengwar-eldamar'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-eldamar" value="tengwar-eldamar" name="script_tengwar-eldamar">
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
													<input type="checkbox" onclick="selectScript('tengwar-galvorn'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-galvorn" value="tengwar-galvorn" name="script_tengwar-galvorn">
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
													<input type="checkbox" onclick="selectScript('tengwar-mornedhel'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-mornedhel" value="tengwar-mornedhel" name="script_tengwar-mornedhel">
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
													<input type="checkbox" onclick="selectScript('tengwar-telerin'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-telerin" value="tengwar-telerin" name="script_tengwar-telerin">
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
													<input type="checkbox" onclick="selectScript('tengwar-hereno'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-hereno" value="tengwar-hereno" name="script_tengwar-hereno">
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
													<input type="checkbox" onclick="selectScript('elfic-caslon'); validateForm();" class="form-check-input checkbox-script" id="checkbox-elfic-caslon" value="elfic-caslon" name="script_elfic-caslon">
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
													<input type="checkbox" onclick="selectScript('tengwar-gothika'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-gothika" value="tengwar-gothika" name="script_tengwar-gothika">
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
													<input type="checkbox" onclick="selectScript('greifswalder-tengwar'); validateForm();" class="form-check-input checkbox-script" id="checkbox-greifswalder-tengwar" value="greifswalder-tengwar" name="script_greifswalder-tengwar">
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
													<input type="checkbox" onclick="selectScript('tengwar-optime'); validateForm();" class="form-check-input checkbox-script" id="checkbox-tengwar-optime" value="tengwar-optime" name="script_tengwar-optime">
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
													<input type="checkbox" onclick="selectScript('cirth-erebor'); validateForm();" class="form-check-input checkbox-script" id="checkbox-cirth-erebor" value="cirth-erebor" name="script_cirth-erebor">
												</td>
												<td class="col2">
													<input type="checkbox" onclick="setCap('cirth-erebor'); validateForm();" class="form-check-input checkbox-cap" id="checkbox-cirth-erebor-cap" value="cirth-erebor-caps" name="script_cirth-erebor-caps">
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
													<input type="checkbox" onclick="selectScript('cirth-erebor-1'); validateForm();" class="form-check-input checkbox-script" id="checkbox-cirth-erebor-1" value="cirth-erebor-1" name="script_cirth-erebor-1">
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
													<input type="checkbox" onclick="selectScript('cirth-erebor-2'); validateForm();" class="form-check-input checkbox-script" id="checkbox-cirth-erebor-2" value="cirth-erebor-2" name="script_cirth-erebor-2">
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
										<span id="validation_error_script" class="validation-error"></span>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Auftrag / Text <span class="required">*</span></p>
									</div>
									<div class="col-xl-7 col-lg-8">
										<textarea id="input_text" rows="5" class="form-control" name="order-description" oninput="validateForm();"></textarea>
										<span id="validation_error_text" class="validation-error"></span>
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
											<a class="btn btn-secondary btn-block button-info" data-toggle="modal" data-target="#dialog_derivation">?</a>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" class="form-check-input" id=" checkbox-offer" value="extra_offer" name="extra_offer">
												<p>Offerte</p>
											</label>
											<a class="btn btn-secondary btn-block button-info" data-toggle="modal" data-target="#dialog_offer">?</a>
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
												<input type="checkbox" class="form-check-input" id="checkbox-gallery" value="gallery" name="gallery">
											</label>
											<a class="btn btn-secondary btn-block button-info" data-toggle="modal" data-target="#dialog_gallery">?</a>
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
												<input type="radio" onclick="validateForm();" class="form-check-input checkbox-payment" id="checkbox-online" value="e-banking" name="payment">
												<p>Online-Überweisung (E-Banking)</p>
											</label>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="radio" onclick="validateForm();" class="form-check-input checkbox-payment" id=" checkbox-paypal" value="paypal" name="payment">
												<p>PayPal (Kreditkarte)</p>
											</label>
										</div>
										<span id="validation_error_payment" class="validation-error"></span>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-3 col-lg-4 label">
										<p>Rechnungswährung <span class="required">*</span></p>
									</div>
									<div class="col-xl-8 col-lg-7 pad-top-7">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="radio" onclick="validateForm();" class="form-check-input checkbox-currency" id="checkbox-chf" value="chf" name="currency">
												<p>CHF - Schweizer Franken</p>
											</label>
										</div>
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="radio" onclick="validateForm();" class="form-check-input checkbox-currency" id="checkbox-eur" value="eur" name="currency">
												<p>€ - Euro</p>
											</label>
										</div>
										<span id="validation_error_currency" class="validation-error"></span>
									</div>
								</div>
								<div class="row show-always" style="display:none">
									<div class="col-xl-9 col-lg-9">
										<div class="row checkbox-row">
											<label class="form-check-label">
												<input type="checkbox" onclick="validateForm();" class="form-check-input" id="checkbox_terms" value="accept_terms" name="accept_terms">
												<p>Ich habe die <a href="./terms" target="_blank">Geschäftsbedingungen</a> gelesen und akzeptiert. 
												Zudem habe ich den <a href="./course" target="_blank">Elbisch-Crashkurs</a> gelesen und verstanden. <span class="required">*</span></p>
											</label>
										</div>
										<span id="validation_error_terms" class="validation-error"></span>
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
										<button disabled class="btn btn-secondary btn-lg btn-block" id="btn_submit" type="button" onclick="submitForm();">Auftrag kostenpflichtig und verbindlich aufgeben</button>
										<span id="validation_error_submit" class="validation-error" style="display:block;">Bitte füllen Sie alle markierten Felder aus.</span>
									</div>
								</div>
							</div>	
						</form>
					</div>
				</div>
			</div>
			
			<!-- Modal dialog for derivation info -->
			<div class="modal fade" id="dialog_derivation" tabindex="-1" role="dialog" aria-labelledby="dialog_derivation">
				<div class="modal-dialog" role="document">
					<div class="modal-content content-container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="login_dialog">Herleitung</h4>
						</div>
						<div class="modal-body">
							Wenn du dieses Zusatzangebot auswählst erhältst du sehr detaillierte Ausführungen dazu, wie deine Übersetzung bzw. Transkription zustande gekommen ist.
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal dialog for offer info -->
			<div class="modal fade" id="dialog_offer" tabindex="-1" role="dialog" aria-labelledby="dialog_derivation">
				<div class="modal-dialog" role="document">
					<div class="modal-content content-container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="login_dialog">Herleitung</h4>
						</div>
						<div class="modal-body">
							Wenn du dieses Zusatzangebot auswählst wird vor der Bearbeitung eine Offerte erstellt, die du ablehnen oder annehmen kannst. Damit kannst du sicherstellen, dass dein Auftrag dein Budget nicht sprengen wird. Dies wird nur für grosse Aufträge (längere Texte) empfohlen.
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Modal dialog for gallery info -->
			<div class="modal fade" id="dialog_gallery" tabindex="-1" role="dialog" aria-labelledby="dialog_derivation">
				<div class="modal-dialog" role="document">
					<div class="modal-content content-container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="login_dialog">Herleitung</h4>
						</div>
						<div class="modal-body">
							Wenn du dies auswählst, wird die für dich angefertigte Übersetzung und Transkription in der <a href="./gallery" class="dialog-link" target="_blank">Galerie</a> ausgestellt. Dadurch sind keine Rückschlüsse auf deine Person möglich, alle anderen Daten von dir werden streng vertraulich behandelt.
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Schliessen</button>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Footer -->
			<?php include 'views/common/footer.php'; ?>
		</div>
	</body>
</html>