<?php declare(strict_types = 1);
/**
  * Representa un excepción genérica, para los metodos de PHP
  * que tiene asociada una función *_last_error y *last_error_msg
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto
  * @since      v0.6
  */

namespace System;

use RuntimeException;

/**
  * Representa un excepción genérica, para los metodos de PHP
  * que tiene asociada una función *_last_error y *last_error_msg
  */
abstract class LastErrorException : RuntimeException { 

    /**
     * Al implementarse debe comprobar si se debe producir una excepción
     *
     * @return void
     */
    public static abstract function validateLastError();

    /**
     * Devuelve el mensaje de error asociado al código de error
     *
     * @return string
     */
    public static abstract function getLastErrorMsg(int $code) : string;

}
