<?php

namespace System\String;

use function is_string;
use function trim;
	
/**
* Determina si una cadena esta vacía
*
* @param string $value Cadena a comprobar
* @return boolean Es true si la cadena está vacía.
*/
function isNullOrEmpty($value) {
    if(!isset($value) || $value == false)
        return true;
    if(is_string($value))
        return trim($value) == false;
    return false;
}
