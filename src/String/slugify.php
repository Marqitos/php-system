<?php declare(strict_types = 1);
/**
  * Devuelve una cadena sin caracteres no ASCII ni espacios
  *
  * Description. Elimina o remplaza los caracteres no ASCII y espacios
  *
  * @package    Kansas
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto <lib-kansas@marcospor.to>
  * @since      v0.1
  */
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
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text); // remplaza caracteres que no sean letras ni digitos por -

    $text = trim($text, '-'); // Elimina - al principio y al final

    if (function_exists('iconv')) {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // convierte caracteres no ASCII en ASCII
    } else {
        require_once 'NotImplementedException.php';
        throw new NotImplementedException(Resources::NOT_IMPLEMENTED_EXCEPTION_NEED_ICONV);
    }

    $text = strtolower($text); // minusculas

    $text = preg_replace('~[^-\w]+~', '', $text); // elimina caracteres no deseados

    return empty($text) ?
        'n-a':
        $text;
}
