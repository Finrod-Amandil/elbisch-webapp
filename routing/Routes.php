<?php
/*
 * file: routing/Routes.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-03: Severin Zahler: added class
 * - 2018-10-03: Severin Zahler: added routes for OrderForm and MyOrders views
 * - 2018-10-27: Nadine Seiler: Added routes for login and register
 * - 2018-10-28: Nadine Seiler: Added route for Logout
 * - 2018-10-28: Nadine Seiler: Added route for form submit
 * - 2018-10-28: Severin Zahler: Moved file to routing folder.
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary:
 * Defines which Controller/Action method specific routes map to.
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

Route::set('logout', function() {
	LoginController::Logout();
});

Route::set('submit-order', function() {
	OrderFormController::Submit();
});


?>