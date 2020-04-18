<?php

namespace System\String;

use System\Localization\Resources;
use System\NotImplementedException;

use function function_exists;
use function iconv;
use function preg_replace;
use function strtolower;
use function trim;

/**
* Devuelve una cadena sin caracteres no ASCII ni espacios.
*
* @param string $text Cadena a transformar
* @throws NotImplementedException Si no existe la funcion iconv
* @return string Cadena transformada
*/
function slugify($text) {
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text); // replace non letter or digits by -
    
    $text = trim($text, '-'); // trim
    
    if (function_exists('iconv'))
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // transliterate
    else {
        require_once 'NotImplementedException.php';
        throw new NotImplementedException(Resources::NotImplementedExceptionNeedIconv);
    }
    
    $text = strtolower($text); // lowercase
    
    $text = preg_replace('~[^-\w]+~', '', $text); // remove unwanted characters

    return empty($text) ?
        'n-a':
        $text;
}
