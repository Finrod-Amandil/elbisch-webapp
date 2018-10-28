<?php
/*
file: Route.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-03: Severin Zahler: added class

summary:
The Route class invokes a specified Controller method, if the requested
URL is being specified in the Routes.php file.
*/

class Route {
	
	public static $validRoutes = array();
	
	public static function set($route, $function) {
		self::$validRoutes[] = $route;
		
		if ($_GET['url'] == $route) {
			$function->__invoke();
			return;
		}
	}
}
?>