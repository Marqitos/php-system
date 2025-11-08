<?php
/**
 * This file is part of the Rodas\System library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Rodas\System
 * @copyright 2025 Marcos Porto <php@marcospor.to>
 * @license https://opensource.org/license/mit The MIT License
 * @link https://marcospor.to/repositories/system
 */

declare(strict_types=1);

namespace System\String;

use System\Localization\Resources;

require_once __DIR__ . '/../Localization/Resources.php';

function concatenate(array $messages): string {
    $message    = '';
    if (! empty($messages)) {
        if (count($messages) == 1) {
            $message = array_shift($messages);
        } else {
            $end        = array_pop($messages);
            $and        = substr($end, 0, 1) == 'i'
                        ? Resources::AND[1]
                        : Resources::AND[0];
            $message    = implode(', ', $messages) . $and . $end;
        }
    }

    return $message;
}
