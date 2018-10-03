<?php
/*
file: index.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-03: Severin Zahler: added class

summary:
Base class for all controllers.
*/

class Controller {
	public static function CreateView($viewName) {
		require_once("./views/$viewName.php");
	}
}

?>