<?php declare(strict_types = 1);
/**
  * Devuelve un string en formato GUID de un array, si el valor actual es null o Guid::Empty, devuelve null.
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  */

namespace System\Collections;

use Exception;
use System\ArgumentOutOfRangeException;
use System\Guid;

require_once 'System/Guid.php';

/**
  * Devuelve un string en formato GUID de un array, si el valor actual es null o Guid::Empty, devuelve null.
  *
  * @param  array   $self               Array donde buscar el elemento;
  * @param  mixed   $key                Clave donde se debe buscar el GUID
  * @throws ArgumentOutOfRangeException En caso de que el Array contenga un valor no GUID
  * @return ?string                     Texto en formato GUID o null
  */
function valueNullGuid(array $self, $key): ?string {
    try {
        $id = isset($self[$key])
            ? new Guid($self[$key])
            : null;
    } catch(Exception $ex) {
        require_once 'System/ArgumentOutOfRangeException.php';
        throw new ArgumentOutOfRangeException($key);
    }
    return Guid::isEmpty($id)
        ? null
        : $id->getHex();
}
