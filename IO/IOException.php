<?php

namespace System\IO;

use Exception;

/*
 * Excepción que es lanzada cuando se produce un error de E/S.
 */
 class IOException extends Exception {
	
	const COR_E_IO = 0x80131620;
	const COR_E_ENDOFSTREAM = 0x80070026;
	const COR_E_FILELOAD = 0x80131621;
	const COR_E_FILENOTFOUND  = 0x80070002;
	const COR_E_DIRECTORYNOTFOUND = 0x80070003;
    const COR_E_PATHTOOLONG = 0x800700CE;	

	public function __construct($message = 'Error E/S', $code = self::COR_E_IO) {
		parent::__construct($message, $code);
	}
	
}