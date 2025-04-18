<?php declare(strict_types = 1);
/**
  * Representa una excepción, que se lanza cuando una operación no se puede ejecutar
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
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

    public function __construct(?string $message = null, ?int $code = null, ?Throwable $previous = null) {
        require_once 'System/String/isNullOrEmpty.php';
        if (StringIsNullOrEmpty($message)) {
            $message = Resources::INVALID_OPERATION_EXCEPTION_DEFAULT_MESSAGE;
        }
        if (is_null($code) ||
            $code == 0) {
            $code = HResults::COR_E_INVALIDOPERATION;
        }
        parent::__construct($message, $code, $previous);
    }

}
