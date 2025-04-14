<?php declare(strict_types = 1);

namespace System\Net;

use Exception;
use function curl_error;
use function curl_errno;

class CurlException extends RuntimeException {

    public static function validate(CurlHandle|false $handle) {
        if ($handle === false) { // No se ha creado el manejador
            throw new RuntimeException;
        } else {
            if (curl_errno($handle) !== 0) { // Se ha producido un error
                throw new self(curl_error($handle), curl_errno($handle));
            }
        }
    }
}
