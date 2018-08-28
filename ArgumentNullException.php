<?php
namespace System;
use System\ArgumentException;

require_once 'ArgumentException.php';

class ArgumentNullException extends ArgumentException {

  const  E_POINTER = 0x80004003;
	
	public function __contruct($paramName, $message = 'El argumento no puede ser NULL', $code = self::E_POINTER) {
		parent::__contruct($paramName, $message, $code);
	}
	
}
