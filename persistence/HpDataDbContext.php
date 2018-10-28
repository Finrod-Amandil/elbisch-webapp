<?php

require_once('./models/Order.php');
require_once('./persistence/DbContext.php');

class HpDataDbContext extends DbContext {

	public function __construct() {
		parent::__construct('localhost', 'webuser', 'superSecurePassword', 'elbisch-webapp_hp-data');
		
		try {
			$this->connect();
		}
		catch (Exception $e) {
			echo 'Error occurred while connecting to database ' . $this->dbName . ': ' . $e->getMessage() . '\n';
		}
	}
	
	public function getAllOrders() {
		$rs = $this->query("SELECT * FROM orders;");
		
		$retArr = array();
		while($row = $rs->fetch_array()) {
		   $currentOrder = $this->mapOrder($row);
		   $retArr[$currentOrder->id] = $currentOrder;
		}
		
		return $retArr;
	}
	
	public function getAllOrdersByUser($userLoginName) {
		$userLoginName = $this->dbConnection->real_escape_string($userLoginName);
		$rs = $this->query("SELECT * FROM orders WHERE email LIKE '" .  $userLoginName . "';");
		
		$retArr = array();
		while($row = $rs->fetch_array()) {
		   $currentOrder = $this->mapOrder($row);
		   $retArr[$currentOrder->id] = $currentOrder;
		}
		
		return $retArr;
	}
	
	public function addOrder($order) {
		if (!is_a($order, 'Order')) {
			return;
		}
		
		$name = $this->dbConnection->real_escape_string($order->name);
		$email = $this->dbConnection->real_escape_string($order->email);
		$orderType = $this->dbConnection->real_escape_string($order->orderType);
		$languages = $this->dbConnection->real_escape_string($order->languages);
		$fonts = $this->dbConnection->real_escape_string($order->fonts);
		$orderDescription = $this->dbConnection->real_escape_string($order->orderDescription);
		$derivation = $order->derivation ? 1 : 0;
		$offer = $order->offer ? 1 : 0;
		$gallery = $order->gallery ? 1 : 0;
		$payment = $this->dbConnection->real_escape_string($order->payment);
		$currency = $this->dbConnection->real_escape_string($order->currency);
		$comments = $this->dbConnection->real_escape_string($order->comments);
		
		$query = "INSERT INTO orders (name, email, order_type, languages, fonts, order_description, derivation, offer, gallery, payment, currency, comments, status) 
			VALUES ('" . $name . "', '" . $email . "', '" .  $orderType . "', '" . $languages . "', 
			'" . $fonts . "', '" . $orderDescription . "', " . $derivation . ", " . $offer . ", " . $gallery . ",
			'" . $payment . "', '" . $currency . "', '" . $comments . "', 'PENDING')";
			
		$this->query($query);
	}

	private function mapOrder($dbEntryRow) {
		$order = new Order();
		$order->id = $dbEntryRow['id_order'];
		$order->date = $dbEntryRow['date'];
		$order->name = $dbEntryRow['name'];
		$order->email = $dbEntryRow['email'];
		$order->orderType = $dbEntryRow['order_type'];
		$order->languages = $dbEntryRow['languages'];
		$order->fonts = $dbEntryRow['fonts'];
		$order->orderDescription = $dbEntryRow['order_description'];
		$order->text = $dbEntryRow['text'];
		$order->translation = $dbEntryRow['translation'];
		$order->transcription = $dbEntryRow['transcription'];
		$order->derivation = $dbEntryRow['derivation'];
		$order->offer = $dbEntryRow['offer'];
		$order->gallery = $dbEntryRow['gallery'];
		$order->payment = $dbEntryRow['payment'];
		$order->currency = $dbEntryRow['currency'];
		$order->comments = $dbEntryRow['comments'];
		$order->status = $dbEntryRow['status'];
		$order->lastChange = $dbEntryRow['last_change'];
		
		return $order;
	}
	
}
?>