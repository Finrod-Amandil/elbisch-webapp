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
	Index::CreateView('Index');
});

?>