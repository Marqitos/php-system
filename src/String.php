<?php declare(strict_types = 1);
/**
  * Representa una excepción, que se lanza cuando una acción no es soportada por un objeto
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.6
  */

namespace System;

use System\Localization\Resources;
use System\NotImplementedException;
use System\Text\RegularExpressions\PerlCompatible;
use function function_exists;
use function iconv;
use function is_array;
use function is_object;
use function is_string;
use function method_exists;
use function strtr;
use function strtolower;
use function trim;

class String {

    /**
      * Interpola valores de contexto en los marcadores de posición del mensaje.
      */
    public static function interpolate(string $message, array $context = []): string {
        // Construye una matriz de reemplazo con llaves alrededor de las claves de contexto
        $replace = [];
        foreach ($context as $key => $val) {
            if (is_object($val) &&
                method_exists($val, '__toString')) {
                $val = $val->__toString();
            }
            // Comprobamos que el valor se puede convertir a cadena
            if (! is_array($val) &&
                ! is_object($val)) {
                $replace['{' . $key . '}'] = $val;
            }
        }
    
        // Interpola los valores de reemplazo en el mensaje
        return strtr($message, $replace);
    }

    /**
     * Comprueba si una variable es una cadena vacia
    *
    * @param string $value Cadena a comprobar
    * @return boolean Es true si la cadena está vacía.
    */
    public static function isNullOrEmpty($value): bool {
        return !isset($value) ||
            $value === null ||
            (is_string($value) &&
            trim($value) === '');
    }
      
    /**
      * Devuelve una cadena sin caracteres no ASCII ni espacios.
      *
      * @param string $text Cadena a transformar
      * @throws NotImplementedException Si no existe la funcion iconv
      * @return string Cadena transformada
      */
    public static function slugify($text) {
        require_once 'System/Text/RegularExpressions/PerlCompatible.php';
        $regex = new PerlCompatible('~[^\\pL\d]+~u');
        $text  = $regex->replace($text, '-'); // remplaza caracteres que no sean letras ni digitos por -
    
        $text = trim($text, '-'); // Elimina - al principio y al final
    
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // convierte caracteres no ASCII en ASCII
        } else {
            require_once 'System/NotImplementedException.php';
            throw new NotImplementedException(Resources::NOT_IMPLEMENTED_EXCEPTION_NEED_ICONV);
        }
    
        $text = strtolower($text); // minusculas
    
        $regex = new PerlCompatible('~[^-\w]+~');
        $text  = $regex->replace($text, '-'); // elimina caracteres no deseados
    
        return empty($text) ?
            'n-a':
            $text;
    }

    /**
      * Determina si el principio de una cadena coincide con una cadena especificada.
      *
      * @param  string  $haystack   (pajar) Cadena completa
      * @param  string  $needle     (aguja) Cadena a comparar
      * @param  boolean $ignoreCase (Opcional) Si true, ignora distinciones entre mayusculas y minusculas, por defecto false;
      * @return boolean             Es true si value coincide con el principio de esta cadena; en caso contrario, es false.
      */
    public static function startWith(string $haystack, string $needle, bool $ignoreCase = false): bool {
        if ($ignoreCase) {
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
  
    public static function compare(string $needle, string|array $haystack, bool $ignoreCase = false): int {
        if (is_array($haystack)) {
            $result = 0;
            foreach ($haystack as $str2) {
                $value = $ignoreCase
                    ? strcasecmp($needle, $str2)
                    : strcmp($needle, $str2);
                if ($value == 0) {
                    return 0;
                } else {
                    $result += $value;
                }
            }
            return $result == 0 // No puede devolver 0 si ninguno coincidio
                ? -1
                : $result;
        } else {
            return $ignoreCase
                ? strcasecmp($needle, $haystack)
                : strcmp($needle, $haystack);
        }

    }
  
}
