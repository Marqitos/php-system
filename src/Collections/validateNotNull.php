<?php

namespace System\Collections;

use System\ArgumentNullException;

/**
 * Comprueba que el valor en un array no es null, en caso contrario lanza un error.
 *
 * @param array $self Array donde buscar el elemento;
 * @param mixed $key Clave donde se debe buscar el valor
 * @throws ArgumentNullException Si el valor encontrado es null o no está establecido
 * @return mixed Valor almacenado en el array
 */
function validateNotNull(array $self, $key) {
    if (! isset($self[$key]) || $self[$key] === null) {
        require_once 'System/ArgumentNullException.php';
        throw new ArgumentNullException($key);
    }
    return $self[$key];
}
