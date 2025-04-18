<?php declare(strict_types = 1);


namespace System\IO;

use System\HResults;
use System\IO\IOException;
use System\Localization\Resources;

require_once 'System/IO/IOException.php';

/**
  * Excepción que es lanzada cuando se intenta acceder a un archivo que no existe, o hay un error de disco.
  */
class DirectoryNotFoundException extends IOException {

    public function __construct(string $message = Resources::E_DIRECTORY_NOT_FOUND_EXCEPTION_DEFAULT_MESSAGE, int $code = HResults::COR_E_DIRECTORYNOTFOUND) {
        parent::__construct($message, $code);
    }

}
