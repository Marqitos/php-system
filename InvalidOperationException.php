<?php

namespace System;

use Exception;

class InvalidOperationException	extends Exception {
    const COR_E_INVALIDOPERATION = 0x80131509;
    
    public function __contruct($message = 'Se ha producido una operación no permitida', $code = self::COR_E_INVALIDOPERATION) {
        parent::__contruct($message, $code);
    }
  
}