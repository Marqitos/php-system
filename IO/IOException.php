<?php declare(strict_types = 1);

namespace System\IO;

use Exception;
use System\HResults;
use System\Localization\Resources;

require_once 'System/HResults.php';
require_once 'System/Localization/Resources.php';

/*
 * Excepción que es lanzada cuando se produce un error de E/S.
 */
 class IOException extends Exception {
    
    public function __construct($message = Resources::IOExceptionDefaultMessage, $code = HResults::COR_E_IO) {
        parent::__construct($message, $code);
    }
    
}
