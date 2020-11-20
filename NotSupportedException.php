<?php

namespace System;

use Throwable;
use RuntimeException;
use System\HResults;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

require_once 'HResults.php';

class NotSupportedException extends RuntimeException {

	public function __construct($message = Resources::NotSupportedExceptionDefaultMessage, $code = HResults::COR_E_NOTSUPPORTED, Throwable $previous) {
		parent::__construct($message, $code, $previous);
	}
	
}
