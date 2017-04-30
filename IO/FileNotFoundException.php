<?php
require_once 'IOException.php';

/*
 * Excepción que es lanzada cuando se intenta acceder a un archivo que no existe, o hay un error de disco.
 */
 
class System_IO_FileNotFoundException
    extends System_IO_IOException {
	
	public function __construct($message = 'No se ha podido encontrar el archivos especificado', $code = self::COR_E_FILENOTFOUND) {
		parent::__construct($message, $code);
	}
	
}