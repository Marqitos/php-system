<?php declare(strict_types = 1);
/**
 * Excepción que se produce cuando ocurre un error al acceder a la red mediante un protocolo acoplable.
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.1
 */

namespace System\Net;

use System\Collections\KeyNotFoundException;
use System\InvalidOperationException;
use System\Localization\Resources;

use function sprintf;

require_once 'System/InvalidOperationException.php';

/**
 * Excepción que se produce cuando ocurre un error al acceder a la red mediante un protocolo acoplable.
 */
class WebException extends InvalidOperationException {
    
    public function __construct(
        private int $status,
        string $message = null
    ) {
        if($message == null) {
            $message = isset(Resources::WEB_EXCEPTION_MESSAGES[$this->status])
                ? Resources::WEB_EXCEPTION_MESSAGES[$this->status]
                : Resources::WEB_EXCEPTION_MESSAGES[500];
        }
        parent::__construct($message);
    }
    
    public function getStatus() : int {
        return $this->status;
    }

    /**
     * Obtiene el mensaje de error correspondiente al un código de error http
     *
     * @param int $code Código de error http
     * @return string Mensaje de error
     * @throws KeyNotFoundException Si se especifica un código de error desconocido
     */
    public static function getCodeMessage(int $code) : string {
        if(isset(Resources::WEB_EXCEPTION_MESSAGES[$code])) {
            return Resources::WEB_EXCEPTION_MESSAGES[$code];
        }
        require_once 'System/Collections/KeyNotFoundException.php';
        throw new KeyNotFoundException(sprintf(Resources::KEY_NOT_FOUND_EXCEPTION_NO_HTTP_FORMAT, $code));
    }
    
  }
