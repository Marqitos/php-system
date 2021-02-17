<?php

namespace System\IO;

use Exception;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

require_once 'HResults.php';

/*
 * Excepción que es lanzada cuando se produce un error de E/S.
 */
 class IOException extends Exception {
	
	public function __construct($message = Resources::IOExceptionDefaultMessage, $code = HResults::COR_E_IO) {
		parent::__construct($message, $code);
	}
	
}