<?php
/**
 * Excepción por argumento fuera de un rango válido
 *
 * Description. Crea una excepción indicando que parametro, con su valor
 * y el motivo por el cual no es válido.
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

use function gettype;
use function is_int;
use function is_null;
use function is_object;
use function is_string;
use function System\String\isNullOrEmpty as StringIsNullOrEmpty;

require_once 'ArgumentException.php';

/**
 * Representa una excepción por argumento fuera de un rango válido
 */
class ArgumentOutOfRangeException extends ArgumentException {

	private $actualValue;
  
	public function __construct(string $paramName, $message = null, $actualValue = null, $code = null, Throwable $previous = null) {
        require_once 'System/String/isNullOrEmpty.php';
		if(!is_string($message) || StringIsNullOrEmpty($message)) {
			$message = Resources::ARGUMENT_OUT_OF_RANGE_EXCEPTION_DEFAULT_MESSAGE;
		}
		if(!is_int($code) && !is_object($code) && !is_null($code)) {
			$code = intval($code);
		}
		if(is_object($code) || is_null($code) || $code == 0) {
			$code = HResults::COR_E_ARGUMENTOUTOFRANGE;
		}
		parent::__construct($paramName, $message, $code, $previous);
		$this->actualValue = $actualValue;
	}
	
	/**
	 * Obtiene el valor del parametro
	 * 
	 * @return mixed valor del parametro
	 */
	public function getActualValue() {
		return $this->actualValue;
	}

	/**
	 * Obtiene el tipo de parametro
	 * 
	 * @return string tipo de valor
	 */
	public function getTypeValue() : string {
		return gettype($this->actualValue);
	}
	
}
