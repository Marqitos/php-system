<?php

namespace System;

use Exception;
use RuntimeException;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

class InvalidOperationException	extends RuntimeException {

    const COR_E_INVALIDOPERATION = 0x80131509;
    
    public function __contruct($message = Resources::InvalidOperationExceptionDefaultMessage, $code = self::COR_E_INVALIDOPERATION) {
        parent::__contruct($message, $code);
    }
  
}