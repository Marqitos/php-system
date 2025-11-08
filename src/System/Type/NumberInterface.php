<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on Type\NumberInterface.php
 * ramsey/uuid from Ben Ramsey.
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

namespace System\Type;

/**
 * NumberInterface ensures consistency in numeric values returned by ramsey/uuid
 *
 */
interface NumberInterface extends TypeInterface {
    /**
     * Gets true if this number is less than zero
     *
     * @var bool
     */
    public bool $isNegative { get; }
}
