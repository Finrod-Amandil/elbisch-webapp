<?php
/*
file: Routes.php
author: Severin Zahler, Nadine Seiler
history:
- 2018-10-03: Severin Zahler: added class

summary:
Defines which Controller/Action method specific routes map to.
*/

Route::set('index.php', function() {
	IndexController::CreateView('Index');
});

Route::set('orderform', function() {
	OrderFormController::CreateView('OrderForm');
});

Route::set('orderform.php', function() {
	OrderFormController::CreateView('OrderForm');
});

Route::set('myorders', function() {
	MyOrdersController::CreateView('MyOrders');
});

Route::set('myorders.php', function() {
	MyOrdersController::CreateView('MyOrders');
});

Route::set('login', function() {
	LoginController::Login();
});

Route::set('register', function() {
	LoginController::Register();
});

?>