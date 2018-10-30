<?php
/*
 * file: controllers/MyOrdersController.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-24: Severin Zahler: added class
 * - 2018-10-27: Severin Zahler: Renamed file from MyOrders to MyOrdersController
 * - 2018-10-27: Severin Zahler: Added script for testing DB access
 * - 2018-10-29: Nadine Seiler: updated comments
 * - 2018-10-30: Severin Zahler: Added check for Login and redirect to Forbidden page.
 * - 2018-10-30: Severin Zahler: Added method to build viewModel.
 *
 * summary: Controller for OrderForm view.
*/

require_once("./persistence/HpDataDbContext.php");
require_once("./models/Order.php");
require_once("./viewmodels/OrderViewModel.php");

class MyOrdersController extends Controller {
	
	/*
	 * Override of the default Controller::CreateView action.
	 * Checks whether the user is logged and then loads the
	 * orders of that user to display them.
	 */
	public static function CreateView($viewName) {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			session_regenerate_id();
		}
		
		if ($_SESSION["logged_in"] and isset($_SESSION["username"])) {
			
			$dbContext = new HpDataDbContext();
			$orders = $dbContext->getAllOrdersByUser($_SESSION["username"]);
			
			$orderViewModels = array();
			
			foreach($orders as $order) {
				$orderViewModels[] = MyOrdersController::buildViewModel($order);
			}
			
			require_once("./views/$viewName.php");
		}
		else {
			require_once("./views/Forbidden.php");
		}
	}
	
	private static function buildViewModel($order) {
		$viewModel = new OrderViewModel();
			
		$viewModel->id = $order->id;
		
		$date = new DateTime($order->date);
		$viewModel->date = date_format($date,"d.m.Y");
		
		switch ($order->orderType) {
			case "translation-transcription":
				$viewModel->orderType = "Übersetzung + Transkription";
				$viewModel->hasTranslation = true;
				$viewModel->hasTranscription = true;
				break;
			case "translation":
				$viewModel->orderType = "Übersetzung";
				$viewModel->hasTranslation = true;
				$viewModel->hasTranscription = false;
				break;
			case "transcription":
				$viewModel->orderType = "Transkription";
				$viewModel->hasTranslation = false;
				$viewModel->hasTranscription = true;
				break;
			default :
				$viewModel->orderType = "Andere Frage";
				$viewModel->hasTranslation = false;
				$viewModel->hasTranscription = false;
		}
		
		$languageArray = explode(",", $order->languages);
		for ($i = 0; $i < sizeof($languageArray); $i++) {
			$viewModel->languages .= ucfirst($languageArray[$i]) . ' ';
		}
		
		if (strlen($order->text) == 0) {
			$viewModel->text = $order->orderDescription;
		}
		else {
			$viewModel->text = $order->text;
		}
		
		$viewModel->translation = $order->translation;
		$viewModel->transcription = $order->transcription;
		
		if ($order->status == "COMPLETED") {
			$viewModel->status = "Abgeschlossen";
			$viewModel->statusClass = "text-completed";
		}
		else {
			$viewModel->status = "In Bearbeitung";
			$viewModel->statusClass = "text-pending";
		}
		
		if ($order->status == "COMPLETED") {
			$viewModel->isCompleted = true;
		}
		else {
			$viewModel->isCompleted = false;
		}
		
		return $viewModel;
	}
}

?>