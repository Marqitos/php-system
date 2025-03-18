<?php declare(strict_types = 1);
/**
  * Representa una excepción, que se lanza cuando una operación no se puede ejecutar
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto
  * @since      v0.4
  */

namespace System;

use RuntimeException;
use Throwable;
use System\HResults;
use System\Localization\Resources;
use function System\String\isNullOrEmpty as StringIsNullOrEmpty;
use function is_int;
use function is_null;
use function is_object;
use function is_string;

require_once 'HResults.php';
require_once 'System/Localization/Resources.php';

/**
 * Representa una excepción, que se lanza cuando una operación no se puede ejecutar
 * @package System
 */
class InvalidOperationException extends RuntimeException {

    public function __construct($message = null, $code = null, Throwable $previous = null) {
        require_once 'System/String/isNullOrEmpty.php';
        if(!is_string($message) || StringIsNullOrEmpty($message)) {
            $message = Resources::INVALID_OPERATION_EXCEPTION_DEFAULT_MESSAGE;
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
