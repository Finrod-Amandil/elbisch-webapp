<?php
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
	public $comment = '';
	public $status = '';
	public $lastChange = '';
	
	public function __construct() {}
}

?>