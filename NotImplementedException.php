<?php declare(strict_types = 1);
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
use System\HResults;
use System\Localization\Resources;

require_once 'HResults.php';
require_once 'System/Localization/Resources.php';

/**
 * Representa una excepción, que se lanza cuando se intenta ejecutar codigo que aun no ha sido desarrollado
 * @package System
 */
class NotImplementedException extends RuntimeException {

    public function __construct($message = Resources::NotImplementedExceptionDefaultMessage, $code = HResults::E_NOTIMPL, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
