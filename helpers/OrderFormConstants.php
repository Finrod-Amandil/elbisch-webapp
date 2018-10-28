<?php

class OrderFormConstants {

	public const ORDER_TYPE_NAMES = array("translation-transcription", "transcription", "translation", "other");

	public const LANGUAGE_NAMES = array("quenya", "sindarin");

	public const FONT_NAMES = 
		array("tengwar-annatar", "tengwar-annatar-bold", "tengwar-annatar-italic", "tengwar-annatar-bold-italic", 
			  "tengwar-noldor", "tengwar-noldor-caps", "tengwar-quenya", "tengwar-quenya-caps", "tengwar-sindarin",
			  "tengwar-sindarin-caps", "tengwar-beleriand", "tengwar-elfica", "tengwar-formal", "tengwar-parmaite",
			  "tengwar-eldamar", "tengwar-galvorn", "tengwar-mornedhel", "tengwar-telerin", "tengwar-hereno",
			  "elfic-caslon", "tengwar-gothika", "greifswalder-tengwar", "tengwar-optime", "cirth-erebor",
			  "cirth-erebor-caps", "cirth-erebor-1", "cirth-erebor-2");
			  
	public const EXTRA_NAMES = array("derivation", "offer");

	public const PAYMENT_NAMES = array("e-banking", "paypal");

	public const CURRENCY_NAMES = array("chf", "eur");

}

?>