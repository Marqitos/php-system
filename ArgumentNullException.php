<?php
namespace System;

use System\ArgumentException;
use System\Localization\Resources;

require_once 'ArgumentException.php';

class ArgumentNullException extends ArgumentException {

  const  E_POINTER = 0x80004003;
	
	public function __contruct($paramName, $message = Resources::ArgumentNullExceptionDefaultMessage, $code = self::E_POINTER) {
		parent::__contruct($paramName, $message, $code);
	}
	
}
