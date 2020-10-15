<?php

namespace System\String;

use function mb_stripos;
use function mb_strpos;

/**
* Determina si el principio de una cadena coincide con una cadena especificada.
*
* @param string $haystack (pajar) Cadena completa
* @param string $needle (aguja) Cadena a comparar
* @return boolean Es true si value coincide con el principio de esta cadena; en caso contrario, es false.
*/
function startWith($haystack, $needle, $ignoreCase = FALSE) {
    if($ignoreCase) {
        return mb_stripos($haystack, $needle) === 0;
    }
    return mb_strpos($haystack, $needle) === 0;
}
