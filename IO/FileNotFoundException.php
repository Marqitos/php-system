<?php

namespace System\IO;

use System\IO\IOException;

require_once 'System/IO/IOException.php';

/*
 * Excepción que es lanzada cuando se intenta acceder a un archivo que no existe, o hay un error de disco.
 */
class FileNotFoundException extends IOException {
	
	public function __construct($message = 'No se ha podido encontrar el archivos especificado', $code = self::COR_E_FILENOTFOUND) {
		parent::__construct($message, $code);
	}
	
}