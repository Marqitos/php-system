<?php declare(strict_types = 1);
/**
 * Interfaz para un objeto con recursos
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.5
 */

namespace System;

/**
 * Interfaz que debe ser implementada por los objetos
 * que deben liberar recursos al dejar de ser utilizados.
 */
interface DisposableInterface {
    
    /**
     * Liberar los recursos utilizados por el objeto
     *
     * @return void
     */
    function dispose() : void;
}
