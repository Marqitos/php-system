<?php declare(strict_types = 1);
/**
  * Devuelve un string en formato GUID de un array, si el valor actual es null o Guid::Empty, devuelve null.
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  */

namespace System\Collections;

use function time;

/**
  * Devuelve el valor en un array, o la hora actual en caso de que no esté establecido
  *
  * @param array         $self Array donde buscar el elemento;
  * @param int|string $key Clave donde se debe buscar el valor
  * @return mixed Valor almacenado en el array o hora actual
  */
function getValueNowDate(array $self, int|string $key) {
    return isset($self[$key])
        ? $self[$key]
        : time();
}
