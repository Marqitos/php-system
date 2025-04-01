<?php declare(strict_types = 1);
/**
  * Interfaz del patrón Disposable
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since v0.5
  */

namespace System;

/**
  * Implementación del patrón Disposable
  *
  * Interfaz que debe ser implementada por los objetos
  * que deben liberar recursos al dejar de ser utilizados.
  */
interface DisposableInterface {

## Patrón Disposable
    /* Override __destruct
    public function __destruct() {
        $this->dispose();
    }
    */

    /**
      * Liberar los recursos utilizados por el objeto
      *
      * @return void
      */
    function dispose() : void;
## --

    /**
      * Devuelve si ya se han liberado los recursos
      * utilizados por el objeto
      *
      * Normalmente si ya se ha liberado, se debe crear un nuevo objeto ya que posiblemente
      * no se podrá volver a utilizar
      *
      * @return boolean
      */
    function isDisposed() : bool;

}
