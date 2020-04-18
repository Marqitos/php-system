<?php

namespace System\Collections;

use Exception;
use System\ArgumentNullException;
use System\ArgumentOutOfRangeException;
use System\Guid;

require_once 'System/Guid.php';

/**
 * Comprueba que el valor en un array es GUID, en caso contrario lanza un error.
 * 
 * @param array $self Array donde buscar el elemento;
 * @param mixed $key Clave donde se debe buscar el GUID
 * @throws ArgumentNullException Si el valor encontrado es null o Guid::Empty
 * @throws ArgumentOutOfRangeException En caso de que el Array contenga un valor no GUID
 * @return mixed Texto en formato GUID
 */
function validateGuid(array $self, $key) {
    try {
        $id = isset($self[$key])
            ? new Guid($self[$key])
            : null;
    } catch(Exception $ex) {
        require_once 'System/ArgumentOutOfRangeException.php';
        throw new ArgumentOutOfRangeException($key);
    }
    if($id == null || Guid::isEmpty($id)) {
        require_once 'System/ArgumentNullException.php';
        throw new ArgumentNullException($key);
    }
    return $id->getHex();
}
