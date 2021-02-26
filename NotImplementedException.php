<?php
/**
 * Representa una excepción, que se lanza cuando se intenta ejecutar codigo que aun no ha sido desarrollado
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.4
 */

namespace System;

use RuntimeException;
use Throwable;
use System\Localization\Resources;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

require_once 'HResults.php';

/**
 * Representa una excepción, que se lanza cuando se intenta ejecutar codigo que aun no ha sido desarrollado
 * @package System
 */
class NotImplementedException extends RuntimeException {

	public function __construct($message = Resources::NotImplementedExceptionDefaultMessage, $code = HResults::E_NOTIMPL, Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
	}
}