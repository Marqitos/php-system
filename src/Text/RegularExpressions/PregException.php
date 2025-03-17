<?php declare(strict_types = 1);
/**
  * Excepxión producida poar una llamada a una función de PCRE (Perl-Compatible Regular Expressions)
  * que ha producido un error. 
  * 
 */

namespace System\Text\RegularExpressions;

use System\LastErrorException;
use const PREG_NO_ERROR;

require_once 'System/LastErrorException.php';

class PregException : LastErrorException {

    protected __construct(int $code, string $message) {
        if ($message === null) {
            $message = preg_last_error_msg();
        }
        parent::__construct($message, $code);
    }

    public static function validateLastError(
        $code = preg_last_error();
        if ($code == PREG_NO_ERROR) {
            return;
        }
        $message = $this->getLastErrorMsg($code);
        throw new self($code, $message);
    );

    public static getLastErrorMsg(int $code) {
        // TODO: Ofrecer una alternativa localizada
        return preg_last_error_msg();
    }


}
