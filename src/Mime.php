<?php declare(strict_types = 1);
/**
  * Proporciona métodos para asociar mime/type, con extensiones de archivos
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.6
  */

namespace System;

use Generator;
use function array_search;
use function file_get_contents;
use function in_array;
use function is_array;
use function is_string;
use function strcasecmp;
use function unserialize;

/**
  * Proporciona métodos para asociar mime/type, con extensiones de archivos
  */
class Mime {

    // Función original de https://github.com/dmsmidt/mime2ext/blob/master/mime2ext.php
    /**
     * Devuelve una extensión asociada a un tipo de archivo (mime/type)
     *
     * @param  string       $mimeType Mime/type a buscar
     * @return string|false           La extensión del archivo, o false si no se encuentra
     */
    public static function mime2ext(string $mimeType) : string|false {
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

    public static function mime2exts (string $mimeType) : Generator {
        $mimes = unserialize(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'mimes.ser'));

        foreach ($mimes as $ext => $mimeArray) {
            if (is_array($mimeArray) &&
                in_array($mimeType, $mimeArray)) {
                    yield $ext;
            }
        }

    }

    public static function ext2mime(string $extension) : string|false {
        $extension  = ltrim(strtolower($extension), '.');
        $mimes      = unserialize(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'mimes.ser'));

        // Busqueda case-sensitive
        if (isset($mimes[$extension])) {
            $mimeArray = $mimes[$extension];
            if (is_string($mimeArray)) {
                return $mimeArray;
            } elseif (is_array($mimeArray) &&
                      ! empty($mimeArray)) {
                return $mimeArray[0];
            }
        }

        return false;
    }

    public static function mime2exts(string $mimeType) : Generator {
        $mimes = unserialize(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'mimes.ser'));

        foreach ($mimes as $ext => $mimeArray) {
            if (strcasecmp($ext, $mimeType)) {
                if (is_string($mimeArray)) {
                    yield $mimeArray;
                } elseif (is_array($mimeArray)) {
                    yield from $mimeArray;
                }
            }
        }
    }

}
