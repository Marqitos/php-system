<?php

namespace System\Collections;

use OutOfBoundsException;
use Throwable;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}
 
/*
 * Excepción que se produce cuando la clave especificada para obtener acceso a un elemento
 * de una colección no coincide con ninguna clave de la colección.
 */
class KeyNotFoundException extends OutOfBoundsException {
    
    const COR_E_DLLNOTFOUND = 80131577; //0x80131577;
    
    public function __construct($message = Resources::KeyNotFoundExceptionDefaultMessage, $code = self::COR_E_DLLNOTFOUND, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
    
}