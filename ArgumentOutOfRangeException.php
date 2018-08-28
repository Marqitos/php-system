<?php

namespace System;
use System\ArgumentException;
use function gettype;

require_once 'ArgumentException.php';

class ArgumentOutOfRangeException extends ArgumentException {
		
	private $actualValue;
  
	const COR_E_ARGUMENTOUTOFRANGE = 0x80131502;
	
	public function __construct($paramName, $message = 'Se ha especificado un argumento fuera de rango', $actualValue = null, $code = self::COR_E_ARGUMENTOUTOFRANGE) {
		parent::__construct($paramName, $message, $code);
		$this->actualValue = $actualValue;
	}
	
	public function getActualValue() {
		return $this->actualValue;
	}

	public function getTypeValue() {
		return gettype($this->actualValue);
	}
	
}
