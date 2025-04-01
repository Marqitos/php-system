<?php declare(strict_types = 1);
/**
  * Determina si el principio de una cadena coincide con una cadena especificada.
  *
  * Description. Determina si el principio de una cadena coincide con una cadena especificada,
  * opcionalmente puede ignorar distinciones entre minusculas y mayusculas.
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.1
  */

namespace System\String;

use function function_exists;
use function mb_stripos;
use function mb_strpos;
use function stripos;
use function strpos;
use function str_starts_with;

/**
* Determina si el principio de una cadena coincide con una cadena especificada.
*
* @param string $haystack (pajar) Cadena completa
* @param string $needle (aguja) Cadena a comparar
* @param boolean $ignoreCase Si true, ignora distinciones entre mayusculas y minusculas, por defecto false;
* @return boolean Es true si value coincide con el principio de esta cadena; en caso contrario, es false.
*/
function startWith(string $haystack, string $needle, $ignoreCase = false) : bool {
    if($ignoreCase) {
        return function_exists('mb_stripos')
            ? mb_stripos($haystack, $needle) === 0
            : stripos($haystack, $needle) === 0;
    }
    if (function_exists('str_starts_with')) {
        return str_starts_with($haystack, $needle);
    } else {
        return function_exists('mb_strpos')
            ? mb_strpos($haystack, $needle) === 0
            : strpos($haystack, $needle) === 0;
    }
}
