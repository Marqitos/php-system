<?php declare(strict_types = 1);
/**
  * Comprueba si una variable es una cadena vacia
  *
  * Description. Comprueba si una variable es una cadena vacia,
  * compuesta solo de espacios o null
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto <lib-system@marcospor.to>
  * @since      v0.1
  */
namespace System\String;

use function is_string;
use function trim;

/**
  * Comprueba si una variable es una cadena vacia
  *
  * @param string $value Cadena a comprobar
  * @return boolean Es true si la cadena está vacía.
  */
function isNullOrEmpty($value) : bool {
    return !isset($value) ||
        $value === null ||
        (is_string($value) &&
         trim($value) === '');
}
