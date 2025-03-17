<?php declare(strict_types = 1);

namespace System\Net;

use Exception;
use function curl_error;
use function curl_errno;

class CurlException extends Exception {

    public function __contruct($curlResource) {
        parent::__construct(curl_error($curlResource), curl_errno($curlResource));
    }

}
