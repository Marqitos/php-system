<?php

namespace System;

use Exception;
use System\Localization\Resources;

if (!class_exists(Resources, false)) {
	require_once 'System/Localization/es.php';
}

class NotImplementedException extends RuntimeException {

    const E_NOTIMPL	=	0x80004001;
	
	public function __construct($message = Resources::NotImplementedExceptionDefaultMessage, $code = self::E_NOTIMPL) {
		parent::__construct($message, $code);
	}
}