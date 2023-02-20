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
 * @param string $mimeType
 * @return bool|string Extension when found, False otherwise
 *
 */
function mime2ext(string $mimeType) {
  $mimes = unserialize(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'mimes.ser'));

  if ($ext = array_search($mimeType, $mimes, true)) {
    return $ext;
  }

  foreach ($mimes as $ext => $mimeArray) {
    if (is_array($mimeArray) &&
        in_array($mimeType, $mimeArray)) {
      return $ext;
    }
  }

  return false;

}
