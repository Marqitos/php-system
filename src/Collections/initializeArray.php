<?php declare(strict_types = 1);

namespace System\Collections;

/**
 * Comprueba si hay un valor asignado a una clave de un array, y si no hay ningun valor establecido, le asigna uno
 */
function initializeArray(array &$array, $key, $defaultValue) {
    if (! isset($array[$key])) {
        $array[$key] = $defaultValue;
    }
}
