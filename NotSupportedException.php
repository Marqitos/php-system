<?php

class System_NotSupportedException
	extends Exception {
  const COR_E_NOTSUPPORTED = 0x80131515;
	
	public function __construct($message = 'Instrucción no soportada', $code = self::COR_E_NOTSUPPORTED) {
		parent::__construct($message, $code);
	}
	
}
