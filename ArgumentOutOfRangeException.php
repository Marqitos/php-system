<?php

require_once 'ArgumentException.php';

class System_ArgumentOutOfRangeException
	extends System_ArgumentException {
		
	private $_actualValue;
  
	const COR_E_ARGUMENTOUTOFRANGE = 0x80131502;
	
	public function __construct($paramName, $message = 'Se ha especificado un argumento fuera de rango', $actualValue = null, $code = self::COR_E_ARGUMENTOUTOFRANGE) {
		parent::__construct($paramName, $message, $code);
		$this->_actualValue = $actualValue;
	}
	
	public function getActualValue() {
		return $this->_actualValue;
	}
	
}
