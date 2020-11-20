<?php
/**
 * Excepción por argumento no especificado
 *
 * Description. Crea una excepción indicando que parametro
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 5 >= 5.3.0, PHP 7
 */

 namespace System;

use Throwable;
use System\ArgumentException;
use System\HResults;
use System\Localization\Resources;

require_once 'ArgumentException.php';

/**
 * Representa una excepción por un parametro establecido a null, indicando el parametro
 */
class ArgumentNullException extends ArgumentException {

	public function __construct($paramName, $message = Resources::ArgumentNullExceptionDefaultMessage, $code = HResults::E_POINTER, Throwable $previous = null) {
		parent::__construct($paramName, $message, $code, $previous);
	}

	/**
	 * Comprueba el valor de una variable, y en caso de que sea null, lanza una excepción
	 */
	public static function validate($paramName, $value) {
		if($value === null)
			throw new self($paramName);
		return true;
	}
	
}
