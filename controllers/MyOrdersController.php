<?php
/*
file: Index.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-23: Severin Zahler: added class

summary:
Controller for OrderForm view.
*/

require_once("./persistence/HpDataDbContext.php");
require_once("./models/Order.php");

class MyOrdersController extends Controller {
	public static function CreateView($viewName) {
		if (true) {
			
			$dbContext = new HpDataDbContext();
			$orders = $dbContext->getAllOrdersByUser("severin.zahler@gmail.com");
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
				echo($order->comment . '<br>');
				echo($order->status . '<br>');
				echo($order->lastChange . '<br>');
			}
			
			//require_once("./views/$viewName.php");
		}
		else {
			require_once("./views/NotFound.php");
		}
	}
}

?>