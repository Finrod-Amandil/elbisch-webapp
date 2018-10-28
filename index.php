<?php 
/*
file: index.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-03: Severin Zahler: added class

summary:
Redirect target for all requests from the webapp. Loads all class required for routing
in order to redirect request to correct controller.
*/

require_once('Routes.php');

function __autoload($class_name) {
	if (file_exists('./routing/'.$class_name.'.php')) {
		require_once './routing/'.$class_name.'.php';
	}
	else if (file_exists('./controllers/'.$class_name.'.php')) {
		require_once './controllers/'.$class_name.'.php';
	}
}
?>