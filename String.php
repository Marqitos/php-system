<?php

namespace System;

class String {
  /**
	* Determina si el principio de una cadena coincide con una cadena especificada.
	*
	* @param string $self Cadena completa
	* @param string $value Cadena a comparar
	* @return boolean Es true si value coincide con el principio de esta cadena; en caso contrario, es false.
	*/
	public static function startWith($self, $value, $ignoreCase = FALSE) {
		if($ignoreCase) {
			$self = strtolower($self);
			$value = strtolower($value);
		}
		return substr($self, 0, strlen($value)) == $value;
	}

  /**
    * Devuelve una cadena sin caracteres no ASCII ni espacios.
	*
	* @param string $text Cadena a transformar
	* @throws System_NotImplementedException Si no existe la funcion iconv
	* @return string Cadena transformada
    */
    public static function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text); // replace non letter or digits by -
        
        $text = trim($text, '-'); // trim
        
        if (function_exists('iconv'))
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // transliterate
		else {
			require_once 'NotImplementedException.php';
			throw new System_NotImplementedException('Se necesita la funcion "iconv"');
		}
        
        $text = strtolower($text); // lowercase
        
        $text = preg_replace('~[^-\w]+~', '', $text); // remove unwanted characters

        return empty($text)?
            'n-a':
            $text;
    }    

}