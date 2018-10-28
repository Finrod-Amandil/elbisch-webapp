<?php
/*
file: Index.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-23: Severin Zahler: added class

summary:
Controller for OrderForm view.
*/

class MyOrders extends Controller {
	public static function CreateView($viewName) {
		if (true) {
			require_once("./views/$viewName.php");
		}
		else {
			require_once("./views/NotFound.php");
		}
	}
}

?>