<?php

namespace System\IO;

use System\HResults;
use System\IO\IOException;
use System\Localization\Resources;

require_once 'System/IO/IOException.php';

/*
 * Excepción que es lanzada cuando se intenta acceder a un archivo que no existe, o hay un error de disco.
 */
class FileNotFoundException extends IOException {
	
	public function __construct($message = Resources::FileNotFoundExceptionDefaultMessage, $code = HResults::COR_E_FILENOTFOUND) {
		parent::__construct($message, $code);
	}
	
}