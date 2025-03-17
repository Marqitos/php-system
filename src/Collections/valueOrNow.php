<?php

namespace System\Collections;

use function time;

/**
 * Devuelve el valor en un array, o la hora actual en caso de que no esté establecido
 * 
 * @param array $self Array donde buscar el elemento;
 * @param mixed $key Clave donde se debe buscar el valor
 * @return mixed Valor almacenado en el array o hora actual
 */
function getValueNowDate(array $self, $key) {
    return isset($self[$key])
        ? $self[$key]
        : time();
}