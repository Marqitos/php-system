<?php declare(strict_types = 1);
/**
 * Concatena varios mensajes en una solo texto
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.5
 */

namespace System\String;

use System\Localization\Resources;

require_once 'System/Localization/Resources.php';

function concatenate(array $messages) : string {
    $message    = '';
    if(!empty($messages)) {
        if(count($messages) == 1) {
            $message = array_shift($messages);
        } else {
            $end        = array_pop($messages);
            $and        = substr($end, 0, 1) == 'i'
                        ? Resources::AND[1]
                        : Resources::AND[0];
            $message = implode(', ', $messages) . $and . $end;
        }
    }

    return $message;
}
