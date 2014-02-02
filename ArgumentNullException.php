<?php

require_once 'ArgumentException.php';

class System_ArgumentNullException extends System_ArgumentException {
  const  E_POINTER = 0x80004003;
	
	public function __contruct($paramName, $message = 'El argumento no puede ser null', $code = self::E_POINTER) {
		parent::__contruct($paramName, $message, $code);
	}
	
}
