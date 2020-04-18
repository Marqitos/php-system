<?php

namespace System\Collections;

/**
 * Devuelve el valor en un array, o null en caso de que no esté establecido.
 * 
 * @param array $self Array donde buscar el elemento;
 * @param mixed $key Clave donde se debe buscar el valor
 * @return mixed Valor almacenado en el array o null
 */

function valueOrNull(array $self, $key) {
    return isset($self[$key])
        ? $self[$key]
        : null;
}
