<?php declare(strict_types = 1);
/**
  * Excepción producida por una llamada a una función de codificación o decodificación JSON
  * que ha producido un error.
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.6
  */

namespace System\Text\RegularExpressions;

use System\LastErrorException;
use function json_last_error;
use function json_last_error_msg;
use const JSON_ERROR_NONE;

require_once 'System/LastErrorException.php';

class JsonException extends LastErrorException {

    protected function __construct(int $code, ?string $message) {
        if ($message === null) {
            $message = json_last_error_msg();
        }
        parent::__construct($message, $code);
    }

    public static function validateLastError() {
        $code = json_last_error();
        if ($code == JSON_ERROR_NONE) {
            return;
        }
        $message = self::getLastErrorMsg($code);
        throw new self($code, $message);
    }

    public static function getLastErrorMsg(int $code) {
        // TODO: Ofrecer una alternativa localizada
        return json_last_error_msg();
    }

}
