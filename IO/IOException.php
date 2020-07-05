<?php

namespace System\IO;

use Exception;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

/*
 * Excepción que es lanzada cuando se produce un error de E/S.
 */
 class IOException extends Exception {
	
	const COR_E_IO = 80131620; // 0x80131620;
	const COR_E_ENDOFSTREAM = 80070026; // 0x80070026;
	const COR_E_FILELOAD = 80131621; // 0x80131621;
	const COR_E_FILENOTFOUND = 80070002; // 0x80070002;
	const COR_E_DIRECTORYNOTFOUND = 80070003; // 0x80070003;
    const COR_E_PATHTOOLONG = 80070099; // 0x800700CE;	

	public function __construct($message = Resources::IOExceptionDefaultMessage, $code = self::COR_E_IO) {
		parent::__construct($message, $code);
	}
	
}