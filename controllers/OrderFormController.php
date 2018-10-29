<?php
/*
 * file: controllers/OrderFormController.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-24: Severin Zahler: added class
 * - 2018-10-27: Nadine Seiler: renamed file and class from OrderForm to OrderFormController.
 * - 2018-10-28: Severin Zahler: Added validation and saving of OrderForm data.
 * - 2018-10-29: Nadine Seiler: updated comments
 * 
 * summary: Controller for OrderForm view. Handles the
 *          input from the order form.
 */

require_once("./helpers/OrderFormConstants.php");
require_once("./models/Order.php");
require_once("./persistence/HpDataDbContext.php");

class OrderFormController extends Controller {
	
	/*
	 * Handles the order form when it is being submitted.
	 * Validates all input and writes it to the database if
	 * valid.
	 */
	public static function Submit() {
		
		$name = isset($_POST["name"]) ? $_POST["name"] : '';
		
		if (!isset($_POST["email"]) or 
		    !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$orderSubmitMessage = "Anfrage konnte nicht gespeichert werden: Ungültige E-mail Adresse";
			require_once("./views/OrderSubmitted.php");
			return;
		}
		else {
			$email = $_POST["email"];
		}
		
		if (!isset($_POST["order_type"]) or $_POST["order_type"] == "0") {
			$orderSubmitMessage = "Anfrage konnte nicht gespeichert werden: Ungültiger Anfragetyp";
			require_once("./views/OrderSubmitted.php");
			return;
		}
		$orderType = $_POST["order_type"];
		
		$languages = '';
		foreach (OrderFormConstants::LANGUAGE_NAMES as $language) {
			if (isset($_POST["language_" . $language])) {
				$languages = $languages . $language . ",";
			}
		}
		
		$fonts = '';
		foreach (OrderFormConstants::FONT_NAMES as $font) {
			if (isset($_POST["script_" . $font])) {
				$fonts = $fonts . $font . ",";
			}
		}
		
		if (!isset($_POST["order-description"]) or $_POST["order-description"] == '') {
			$orderSubmitMessage = "Anfrage konnte nicht gespeichert werden: Auftragsbeschreibung fehlt.";
			require_once("./views/OrderSubmitted.php");
			return;
		}
		$orderDescription = $_POST["order-description"];
		
		$derivation = isset($_POST["extra_derivation"]);
		$offer = isset($_POST["extra_offer"]);
		$gallery = isset($_POST["gallery"]);
		
		if (!isset($_POST["payment"])) {
			$orderSubmitMessage = "Anfrage konnte nicht gespeichert werden: Bezahlungsart fehlt.";
			require_once("./views/OrderSubmitted.php");
			return;
		}
		$payment = $_POST["payment"];
		
		if (!isset($_POST["currency"])) {
			$orderSubmitMessage = "Anfrage konnte nicht gespeichert werden: Rechnungswährung fehlt.";
			require_once("./views/OrderSubmitted.php");
			return;
		}
		$currency = $_POST["currency"];
		
		$comments = isset($_POST["comments"]) ? $_POST["comments"] : '';
		
		//Build new order object
		$order = new Order();
		$order->name = $name;
		$order->email = $email;
		$order->orderType = $orderType;
		$order->languages = $languages;
		$order->fonts = $fonts;
		$order->orderDescription = $orderDescription;
		$order->derivation = $derivation;
		$order->offer = $offer;
		$order->gallery = $gallery;
		$order->payment = $payment;
		$order->currency = $currency;
		$order->comments = $comments;
		
		//save to database
		$dbContext = new HpDataDbContext();
		$dbContext->addOrder($order);
		
		$orderSubmitMessage = "Auftrag erfolgreich gespeichert!";
		require_once("./views/OrderSubmitted.php");
	}
}
?>