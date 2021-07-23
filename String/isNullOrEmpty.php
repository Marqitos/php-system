<?php
/**
 * Comprueba si una variable es una cadena vacia
 *
 * Description. Comprueba si una variable es una cadena vacia,
 * compuesta solo de espacios o null
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 5 >= 5.3.0, PHP 7
 */
namespace System\String;

use function is_string;
use function trim;
	
/**
* Comprueba si una cadena esta vacía
*
* @param string $value Cadena a comprobar
* @return boolean Es true si la cadena está vacía.
*/
function isNullOrEmpty($value) {
    return !isset($value) ||
        $value === null ||
        (is_string($value) && trim($value) === '');
}
