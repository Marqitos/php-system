<?php declare(strict_types = 1);
/**
  * Excepción que se produce cuando la clave especificada para obtener acceso a un elemento
  * de una colección no coincide con ninguna clave de la colección.
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  */

namespace System\Collections;

use OutOfBoundsException;
use Throwable;
use System\HResults;
use System\Localization\Resources;

require_once 'System/HResults.php';
require_once 'System/Localization/Resources.php';

/**
  * Excepción que se produce cuando la clave especificada para obtener acceso a un elemento
  * de una colección no coincide con ninguna clave de la colección.
  */
class KeyNotFoundException extends OutOfBoundsException {

    public function __construct($message = Resources::KEY_NOT_FOUND_EXCEPTION_DEFAULT_MESSAGE, $code = HResults::COR_E_DLLNOTFOUND, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}
