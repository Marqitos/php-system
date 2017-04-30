<?php
require_once 'IOException.php';

/*
 * Excepción que es lanzada cuando se intenta acceder a un archivo que no existe, o hay un error de disco.
 */
 
class System_IO_DirectoryNotFoundException
    extends System_IO_IOException {
		
	public function __construct($message = 'No se ha podido encontrar el directorio especificado', $code = self::COR_E_DIRECTORYNOTFOUND) {
		parent::__construct($message, $code);
	}
	
}