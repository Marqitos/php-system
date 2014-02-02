<?php

class System_NotImplementedException
	extends Exception {
  const E_NOTIMPL	=	0x80004001;
	
	public function __construct($message = 'Instrucción no implementada', $code = self::E_NOTIMPL) {
		parent::__construct($message, $code);
	}
}