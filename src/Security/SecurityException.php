<?php declare(strict_types = 1);
/**
  * Representa un error que se produce cuando se detecta un error de seguridad
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto <lib-system@marcospor.to>
  * @since      v0.5
  */

namespace System\Security;

use LogicException;
use Throwable;

class SecurityException extends LogicException {

    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}
