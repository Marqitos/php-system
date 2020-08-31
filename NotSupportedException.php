<?php

namespace System;

use Exception;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

class NotSupportedException extends Exception {

  const COR_E_NOTSUPPORTED = 0x80131515;
	
	public function __construct($message = Resources::NotSupportedExceptionDefaultMessage, $code = self::COR_E_NOTSUPPORTED) {
		parent::__construct($message, $code);
	}
	
}
