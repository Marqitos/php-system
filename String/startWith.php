<?php

namespace System\String;

use function strtolower;
use function strlen;
use function substr;

/**
* Determina si el principio de una cadena coincide con una cadena especificada.
*
* @param string $haystack (pajar) Cadena completa
* @param string $needle (aguja) Cadena a comparar
* @return boolean Es true si value coincide con el principio de esta cadena; en caso contrario, es false.
*/
function startWith($haystack, $needle, $ignoreCase = FALSE) {
    if($ignoreCase) {
        $haystack  = strtolower(substr($haystack, 0, strlen($needle)));
        $needle = strtolower($needle);
    } else {
        $haystack  = substr($haystack, 0, strlen($needle));
    }
    return $haystack == $needle;
}
