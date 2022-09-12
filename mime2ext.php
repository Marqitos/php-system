<?php declare(strict_types = 1);
/**
 * Devuelve una extensión asociada a un tipo de archivo
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.4
 */

// Función original de https://github.com/dmsmidt/mime2ext/blob/master/mime2ext.php
namespace System;

use function array_search;
use function in_array;
use function is_array;

/**
 * Obtiene la extensión / abreviatura identificadora de un archivo, para humanos de un cierto 'mime type'
 * Ciertos tipos de 'mime type' tienen múltiples extensiones, asumimos que queremos mostrar solo una
 *
 * @param string $mime_type
 * @return bool|string Extension when found, False otherwise
 *
 */
function mime2ext(string $mime_type) {
  $mimes = unserialize(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'mimes.ser'));

  if ($ext = array_search($mime_type, $mimes, TRUE)) {
    return $ext;
  }

  foreach ($mimes as $ext => $mime_array) {
    if (is_array($mime_array) &&
        in_array($mime_type, $mime_array)) {
      return $ext;
    }
  }

  return false;

}
