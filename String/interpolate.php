<?php declare(strict_types = 1);
/**
 * Comprueba si una variable es una cadena vacia
 *
 * Description. Comprueba si una variable es una cadena vacia,
 * compuesta solo de espacios o null
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.5
 */

namespace System\String;

 /**
 * Interpola valores de contexto en los marcadores de posición del mensaje..
 */
function interpolate(string $message, array $context = []) : string {
    // Construye una matriz de reemplazo con llaves alrededor de las claves de contexto
    $replace = [];
    foreach ($context as $key => $val) {
        // Comprobamos que el valor se puede convertir a cadena
        if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
            $replace['{' . $key . '}'] = $val;
        }
    }

    // Interpola los valores de reemplazo en el mensaje
    return strtr($message, $replace);
}
