<?php
/**
 * file: models/Order.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-27: Nadine Seiler: added class
 * - 2018-10-29: Nadine Seiler: updated comments
 *
 * summary: Model class for order entity of database.
 */

class Order {
	
	public $id = 0;
	public $date = null;
	public $name = '';
	public $email = '';
	public $orderType = '';
	public $languages = '';
	public $fonts = '';
	public $orderDescription = '';
	public $text = '';
	public $translation = '';
	public $transcription = '';
	public $derivation = false;
	public $offer = false;
	public $gallery = false;
	public $payment = '';
	public $currency = '';
	public $comments = '';
	public $status = '';
	public $lastChange = '';
	
	public function __construct() {}
}

?>