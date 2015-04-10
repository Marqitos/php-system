<?php

/*
 * Excepción que es lanzada cuando se produce un error de E/S.
 */
 
class System_IO_IOException
	extends Exception {
	
	const COR_E_IO = 0x80131620;
	
	public function __construct($message = 'Error E/S', $code = self::COR_E_IO) {
		parent::__construct($message, $code);
	}
	
}