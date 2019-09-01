<?php

namespace System;

use Exception;

class ArgumentException	extends Exception {
	
	private $paramName;
  
	const COR_E_ARGUMENT = 0x80070057;
	
	public function __construct($paramName, $message = 'Se ha especificado un argumento no válido', $code = self::COR_E_ARGUMENT) {
		parent::__construct($message, $code);
		$this->paramName = $paramName;
	}
	
	public function getParamName() {
		return $this->paramName;
	}
	
}
