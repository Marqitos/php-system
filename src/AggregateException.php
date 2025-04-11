<?php declare(strict_types = 1);
/**
  * Representa uno o más errores que se producen durante la ejecución de una aplicación.
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.5
  * @version    v0.6
  */

namespace System;

use LogicException;
use Throwable;

class AggregateException extends LogicException {

    private $errors     = [];
    private $exceptions = [];

    /**
     * Crea una instancia de AggregateException, con un mensaje de error.
     *
     * @param string    $message    Mensaje de error
     * @param int       $code       Código de error (FLAG)
     * @param Throwable $previous   Excepción previa, se alacenará como una excepción interna
     */
    public function __construct(?Throwable $innerException) {
        parent::__construct('', 0, $innerException);
        $this->addInnerException($innerException);
    }

    /**
      * Añade un error a la colección
      *
      * @param  string  $message    Mensaje de error
      * @param  int     $code       Código de error (FLAG)
      * @return int                 Código de error actualizado
      */
    protected function addError(string $message, int $code) : int {
        if(!isset($this->errors[$code])) {
            $this->code    += $code;
            $this->message .= ($this->message == '')
                            ? $message
                            : '<br/>' . $message;
            $this->errors[$code] = $message;
        }
        return $this->code;
    }

    public function addInnerException(Throwable $exception) : void {
        $this->exceptions[] = $exception;
        $this->addError($exception->getMessage(), $exception->getCode());
    }

    public function getInnerExceptions() : array {
        return $this->exceptions;
    }

    /**
      * Añade una excepción a la colección, si la colección no existe la crea
      *
      * @param  ?AggregateException $aggregateException Grupo de excepciones
      * @param  Throwable           $innerException     Excepción a añadir
      * @return void
      */
    public static function aggregateException(Throwable $innerException, ?AggregateException &$aggregateException = null) : void {
        if ($aggregateException === null) {
            $aggregateException = new self($innerException);
        } else {
            $aggregateException->addInnerException($innerException);
        }
    }

}
