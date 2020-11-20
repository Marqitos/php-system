<?php
/**
 * Excepción por argumento no válidos
 *
 * Description. Crea una excepción indicando que parametro y el motivo por el cual no es válido
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 5 >= 5.3.0, PHP 7
 */

namespace System;

use InvalidArgumentException;
use Throwable;
use System\HResults;
use System\Localization\Resources;
use function class_exists;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

require_once 'HResults.php';

/**
 * Representa una excepción indicando que parametro y el motivo por el cual no es válido
 */
class ArgumentException	extends InvalidArgumentException {
	
	private $paramName;

	public function __construct(string $paramName, string $message = Resources::ArgumentExceptionDefaultMessage, int $code = HResults::COR_E_ARGUMENT, Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
		$this->paramName = $paramName;
	}
	
	/**
	 * Obtiene el nombre del argumento que tiene un valor incorrecto
	 */
	public function getParamName() {
		return $this->paramName;
	}
	
}
