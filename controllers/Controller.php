<?php
/**
 * file: controllers/Controller.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-03: Severin Zahler: added class
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary: Base class for all controllers.
 */

class Controller {
	
	/**
	 * Shared controller action which simply returns
	 * a view without executing additional logic.
	 */
	public static function CreateView($viewName) {
		require_once("./views/$viewName.php");
	}
}

?>