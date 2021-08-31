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

	public function __construct(string $paramName, string $message = Resources::ArgumentNullExceptionDefaultMessage, int $code = HResults::E_POINTER, Throwable $previous = null) {
		parent::__construct($paramName, $message, $code, $previous);
	}

	/**
	 * Comprueba el valor de una variable, y en caso de que sea null, lanza una excepción
	 * 
	 * @param string $paramName Nombre del parametro a comprobar
	 * @param mixed $value Variable a comprobar
	 * @throws ArgumentNullException En caso de que $value sea null
	 */
	public static function validate(string $paramName, $value) {
		if($value === null) {
			throw new self($paramName);
		}
	}

	/**
	 * Comprueba el valor de un elemento dentro de un array,  y en caso de que sea null, lanza una excepción
	 * 
	 * @param string $paramName Nombre del parametro a comprobar
	 * @param array $value Array donde buscar el elemento
	 * @param mixed $key Indice del elemento en el array
	 * @return mixed El valor de $value[$key]
	 * @throws ArgumentNullException En caso de que $value[$key] sea null
	 */
	public static function validateArray(string $paramName, array $value, $key) {
		if(isset($value[$key]) ||
		   $value[$key] === null ) {
			throw new self($paramName . '[' . $key . ']');
		}
		return $value[$key];
	}
	
}
