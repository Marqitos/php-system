<?php

namespace System\Collections;

use Exception;
 
/*
 * Excepción que se produce cuando la clave especificada para obtener acceso a un elemento
 * de una colección no coincide con ninguna clave de la colección.
 */
class KeyNotFoundException extends Exception {
    
    const COR_E_DLLNOTFOUND = 80131577; //0x80131577;
    
    public function __construct($message = 'La clave especificada no existe', $code = self::COR_E_DLLNOTFOUND) {
        parent::__construct($message, $code);
    }
    
}