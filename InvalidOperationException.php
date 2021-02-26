<?php
/**
 * Representa una excepción, que se lanza cuando una operación no se puede ejecutar
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.4
 */

namespace System;

use RuntimeException;
use Throwable;
use System\HResults;
use System\Localization\Resources;
use function System\String\isNullOrEmpty as StringIsNullOrEmpty;

if (!class_exists('Resources', false)) {
	require_once 'System/Localization/es.php';
}

require_once 'HResults.php';

/**
 * Representa una excepción, que se lanza cuando una operación no se puede ejecutar
 * @package System
 */
class InvalidOperationException	extends RuntimeException {

    public function __construct($message = null, $code = null, Throwable $previous = null) {
        require_once 'System/String/isNullOrEmpty.php';
		if(!is_string($message) || StringIsNullOrEmpty($message)) {
            $message = Resources::InvalidOperationExceptionDefaultMessage;
        }
		if(!is_int($code) && !is_object($code) && !is_null($code)) {
			$code = intval($code);
		}
		if(is_object($code) || is_null($code) || $code == 0) {
            $code = HResults::COR_E_INVALIDOPERATION;
        }
        parent::__construct($message, $code, $previous);
    }
  
}