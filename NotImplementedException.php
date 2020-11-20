<?php

namespace System;

use RuntimeException;
use Throwable;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

require_once 'HResults.php';

/**
 * Class NotImplementedException
 * @package System
 */
class NotImplementedException extends RuntimeException {

	public function __construct($message = Resources::NotImplementedExceptionDefaultMessage, $code = HResults::E_NOTIMPL, Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
	}
}