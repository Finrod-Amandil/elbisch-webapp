<?php
/*
 * file: routing/Route.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-03: Severin Zahler: added class
 * - 2018-10-27: Nadine Seiler: Moved file to routing folder
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary:
 * The Route class invokes a specified Controller method, if the requested
 * URL is being specified in the Routes.php file.
*/

class Route {
	
	public static $validRoutes = array();
	
	/**
	 * The set()-Method couples routes with a Controller-Action
	 */
	public static function set($route, $function) {
		self::$validRoutes[] = $route;
		
		if ($_GET['url'] == $route) {
			$function->__invoke();
			return;
		}
	}
}
?>