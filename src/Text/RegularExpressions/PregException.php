<?php declare(strict_types = 1);
/**
  * Excepción producida poar una llamada a una función de PCRE (Perl-Compatible Regular Expressions)
  * que ha producido un error.
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto <lib-system@marcospor.to>
  * @since      v0.6
  */

namespace System\Text\RegularExpressions;

use System\LastErrorException;
use function preg_last_error;
use function preg_last_error_msg;
use const PREG_NO_ERROR;

require_once 'System/LastErrorException.php';

class PregException extends LastErrorException {

    protected function __construct(int $code, string $message) {
        if ($message === null) {
            $message = preg_last_error_msg();
        }
        parent::__construct($message, $code);
    }

    public static function validateLastError() {
        $code = preg_last_error();
        if ($code == PREG_NO_ERROR) {
            return;
        }
        $message = self::getLastErrorMsg($code);
        throw new self($code, $message);
    }

    public static function getLastErrorMsg(int $code) {
        // TODO: Ofrecer una alternativa localizada
        return preg_last_error_msg();
    }

}
