<?php
/**
 * file: viewModels/OrderViewModel.php
 * author: Severin Zahler, Nadine Seiler
 * history:
 * - 2018-10-30: Severin Zahler: added class
 *
 * summary: ViewModel of Order entity for MyOrders view.
 */

class OrderViewModel {
	public $id = 0;
	public $date = '';
	public $orderType = '';
	public $languages = '';
	public $text = '';
	public $translation = '';
	public $transcription = '';
	public $status = '';
	public $statusClass = '';
	public $isCompleted = false;
	public $hasTranslation = false;
	public $hasTranscription = false;
	
	public function __construct() {}
}

?>