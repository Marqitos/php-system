<?php
/**
 * Representa una excepción, que se lanza cuando una acción no es soportada por un objeto
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.4
 */

namespace System;

use Throwable;
use RuntimeException;
use System\HResults;
use System\Localization\Resources;

require_once 'HResults.php';
require_once 'System/Localization/Resources.php';

class NotSupportedException extends RuntimeException {

	public function __construct(string $message = Resources::NotSupportedExceptionDefaultMessage, int $code = HResults::COR_E_NOTSUPPORTED, Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
	}

	/**
	 * Lanza la exception, con un mensaje indicando que el entorno especificado no es válido
	 */
	public static function NotValidEnvironment(string $status) {
		throw new self(sprintf(Resources::NOT_SUPPORTED_EXCEPTION_NO_ENVIRONMENT_FORMAT, $status));
	}
	
}
