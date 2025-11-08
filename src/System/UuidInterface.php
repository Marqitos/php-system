<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on UuidInterface.php
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

namespace Rodas\System;

use JsonSerializable;
use Ramsey\Uuid\Fields\FieldsInterface;
use Ramsey\Uuid\Type\Hexadecimal;
use Ramsey\Uuid\Type\Integer;
use Serializable;
use Stringable;

/**
 * A UUID is a universally unique identifier adhering to an agreed-upon representation format and standard for generation
 *
 * @immutable
 */
interface UuidInterface extends
    JsonSerializable,
    Serializable,
    Stringable {
# Properties
    /**
     * Gets the binary string representation of the UUID
     *
     * @var non-empty-string
     */
    public string $bytes { get; }

    /**
     * Gets the fields that comprise this UUID
     *
     * @var FieldsInterface
     */
    public FieldsInterface $fields { get; }

    /**
     * Gets the hexadecimal representation of the UUID
     *
     * @var Hexadecimal
     */
    public Hexadecimal $hex { get; }

    /**
     * Gets the integer representation of the UUID
     *
     * @var Integer
     */
    public Integer $integer { get; }

    /**
     * Gets the string standard representation of the UUID as a URN
     *
     * @link http://en.wikipedia.org/wiki/Uniform_Resource_Name Uniform Resource Name
     * @link https://www.rfc-editor.org/rfc/rfc9562.html#section-4 RFC 9562, 4. UUID Format
     * @link https://www.rfc-editor.org/rfc/rfc9562.html#section-7 RFC 9562, 7. IANA Considerations
     * @link https://www.rfc-editor.org/rfc/rfc4122.html#section-3 RFC 4122, 3. Namespace Registration Template
     *
     * @var string
     */
    public string $urn { get; }
# -- Properties

# Methods
    /**
     * Returns -1, 0, or 1 if the UUID is less than, equal to, or greater than the other UUID
     *
     * The first of two UUIDs is greater than the second if the most significant field in which the UUIDs differ is
     * greater for the first UUID.
     *
     * @param UuidInterface $other The UUID to compare
     *
     * @return int<-1,1> -1, 0, or 1 if the UUID is less than, equal to, or greater than $other
     */
    public function compareTo(UuidInterface $other): int;

    /**
     * Returns true if the UUID is equal to the provided object
     *
     * The result is true if and only if the argument is not null, is a UUID object, has the same variant, and contains
     * the same value, bit-for-bit, as the UUID.
     *
     * @param object | null $other An object to test for equality with this UUID
     *
     * @var bool True if the other object is equal to this UUID
     */
    public function equals(?object $other): bool;
# -- Methods
}
