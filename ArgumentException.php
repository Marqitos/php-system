<?php

namespace System;

use InvalidArgumentException;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

class ArgumentException	extends InvalidArgumentException {
	
	private $paramName;
  
	const COR_E_ARGUMENT = 80070057; // 0x80070057;
	
	public function __construct($paramName, $message = Resources::ArgumentExceptionDefaultMessage, $code = self::COR_E_ARGUMENT) {
		parent::__construct($message, $code);
		$this->paramName = $paramName;
	}
	
	public function getParamName() {
		return $this->paramName;
	}
	
}
