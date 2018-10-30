<?php
/*
 * file: controllers/MyOrdersController.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-24: Severin Zahler: added class
 * - 2018-10-27: Severin Zahler: Renamed file from MyOrders to MyOrdersController
 * - 2018-10-27: Severin Zahler: Added script for testing DB access
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary: Controller for OrderForm view.
*/

require_once("./persistence/HpDataDbContext.php");
require_once("./models/Order.php");

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
			
			require_once("./views/$viewName.php");
			
			foreach ($orders as $order) {
				echo($order->id . '<br>');
				echo($order->date . '<br>');
				echo($order->name . '<br>');
				echo($order->email . '<br>');
				echo($order->orderType . '<br>');
				echo($order->languages . '<br>');
				echo($order->fonts . '<br>');
				echo($order->orderDescription . '<br>');
				echo($order->text . '<br>');
				echo($order->translation . '<br>');
				echo($order->transcription . '<br>');
				echo($order->derivation . '<br>');
				echo($order->offer . '<br>');
				echo($order->gallery . '<br>');
				echo($order->payment . '<br>');
				echo($order->currency . '<br>');
				echo($order->comments . '<br>');
				echo($order->status . '<br>');
				echo($order->lastChange . '<br>');
			}
			
			
		}
		else {
			require_once("./views/Forbidden.php");
		}
	}
}

?>