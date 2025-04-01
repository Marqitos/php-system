<?php declare(strict_types = 1);
/**
  * Error por argumento no válido
  *
  * Description. Crea una excepción indicando que parámetro y el motivo por el cual no es válido
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto
  * @since      v0.1
  * @version    v0.6
  */

namespace System;

use InvalidArgumentException;
use Throwable;
use System\HResults;
use System\Localization\Resources;

require_once 'HResults.php';
require_once 'System/Localization/Resources.php';

/**
  * Representa una excepción indicando que parametro y el motivo por el cual no es válido
  */
class ArgumentException extends InvalidArgumentException {

    public function __construct(private string $paramName, string $message = Resources::E_ARGUMENT_EXCEPTION, int $code = HResults::COR_E_ARGUMENT, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
      * Obtiene el nombre del argumento que tiene un valor incorrecto
      */
    public function getParamName() {
        return $this->paramName;
    }

}
