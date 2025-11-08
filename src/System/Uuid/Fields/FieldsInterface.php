<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on Rfc4122\FieldsInterface.php && Fields\FieldsInterface.php
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

namespace System\Uuid\Fields;

use Serializable;
use System\Type\Hexadecimal;

require_once __DIR__ . '/../../Type/Hexadecimal.php';

/**
 * UUID fields, as defined by RFC 4122
 *
 * This interface defines the fields of an RFC 4122 variant UUID. Since RFC 9562 removed the concept of fields and
 * instead defined layouts that are specific to a given version, this interface is a legacy artifact of the earlier, and
 * now obsolete, RFC 4122.
 *
 * The fields of an RFC 4122 variant UUID are:
 *
 * * **time_low**: The low field of the timestamp, an unsigned 32-bit integer
 * * **time_mid**: The middle field of the timestamp, an unsigned 16-bit integer
 * * **time_hi_and_version**: The high field of the timestamp multiplexed with the version number, an unsigned 16-bit integer
 * * **clock_seq_hi_and_reserved**: The high field of the clock sequence multiplexed with the variant, an unsigned 8-bit integer
 * * **clock_seq_low**: The low field of the clock sequence, an unsigned 8-bit integer
 * * **node**: The spatially unique node identifier, an unsigned 48-bit integer
 *
 * @link https://www.rfc-editor.org/rfc/rfc4122#section-4.1 RFC 4122, 4.1. Format
 * @link https://www.rfc-editor.org/rfc/rfc9562#section-4 RFC 9562, 4. UUID Format
 *
 * @immutable
 */
interface FieldsInterface extends Serializable {
# Constants
    # Variants
    /**
     * Variant: reserved, NCS backward compatibility
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.1 RFC 9562, 4.1. Variant Field
     */
    public const RESERVED_NCS = 0;

    /**
     * Variant: the UUID layout specified in RFC 9562 (formerly RFC 4122)
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.1 RFC 9562, 4.1. Variant Field
     * @see Uuid::RFC_9562
     */
    public const RFC_4122 = 2;

    /**
     * Variant: the UUID layout specified in RFC 9562 (formerly RFC 4122)
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.1 RFC 9562, 4.1. Variant Field
     */
    public const RFC_9562 = 2;

    /**
     * Variant: reserved, Microsoft Corporation backward compatibility
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.1 RFC 9562, 4.1. Variant Field
     */
    public const RESERVED_MICROSOFT = 6;

    /**
     * Variant: reserved for future definition
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.1 RFC 9562, 4.1. Variant Field
     */
    public const RESERVED_FUTURE = 7;
    # -- Variants
    
    # Versions
    /**
     * Version 1 (Gregorian time) UUID
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     */
    public const UUID_TYPE_TIME = 1;

    /**
     * Version 2 (DCE Security) UUID
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     */
    public const UUID_TYPE_DCE_SECURITY = 2;

    /**
     * @deprecated Use {@see Uuid::UUID_TYPE_DCE_SECURITY} instead.
     */
    public const UUID_TYPE_IDENTIFIER = 2;

    /**
     * Version 3 (name-based and hashed with MD5) UUID
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     */
    public const UUID_TYPE_HASH_MD5 = 3;

    /**
     * Version 4 (random) UUID
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     */
    public const UUID_TYPE_RANDOM = 4;

    /**
     * Version 5 (name-based and hashed with SHA1) UUID
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     */
    public const UUID_TYPE_HASH_SHA1 = 5;

    /**
     * @deprecated Use {@see Uuid::UUID_TYPE_REORDERED_TIME} instead.
     */
    public const UUID_TYPE_PEABODY = 6;

    /**
     * Version 6 (reordered Gregorian time) UUID
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     */
    public const UUID_TYPE_REORDERED_TIME = 6;

    /**
     * Version 7 (Unix Epoch time) UUID
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     */
    public const UUID_TYPE_UNIX_TIME = 7;

    /**
     * Version 8 (custom format) UUID
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     */
    public const UUID_TYPE_CUSTOM = 8;
    # -- Versions
# -- Constants

# Properties
    /**
     * Gets the bytes that comprise the fields
     *
     * @var non-empty-string
     */
    public string $bytes { get; }

    /**
     * Gets the full 16-bit clock sequence, with the variant bits (two most significant bits) masked out
     *
     * @var Hexadecimal
     */
    public Hexadecimal $clockSeq { get; }

    /**
     * Gets the high field of the clock sequence multiplexed with the variant
     *
     * @var Hexadecimal
     */
    public Hexadecimal $clockSeqHiAndReserved { get; }

    /**
     * Gets the low field of the clock sequence
     *
     * @var Hexadecimal
     */
    public Hexadecimal $clockSeqLow { get; }

    /**
     * Gets the node field
     *
     * @var Hexadecimal
     */
    public Hexadecimal $node { get; }

    /**
     * Gets the high field of the timestamp multiplexed with the version
     *
     * @var Hexadecimal
     */
    public Hexadecimal $timeHiAndVersion { get; }

    /**
     * Gets the low field of the timestamp
     *
     * @var Hexadecimal
     */
    public Hexadecimal $timeLow { get; }

    /**
     * Gets the middle field of the timestamp
     *
     * @var Hexadecimal
     */
    public Hexadecimal $timeMid { get; }

    /**
     * Gets the full 60-bit timestamp, without the version
     *
     * @var Hexadecimal
     */
    public Hexadecimal $timestamp { get; }

    /**
     * Gets the variant
     *
     * The variant number describes the layout of the UUID. The variant number has the following meaning:
     *
     * - 0 - Reserved for NCS backward compatibility
     * - 2 - The RFC 9562 (formerly RFC 4122) variant
     * - 6 - Reserved, Microsoft Corporation backward compatibility
     * - 7 - Reserved for future definition
     *
     * For RFC 9562 (formerly RFC 4122) variant UUIDs, this value should always be the integer `2`.
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.1 RFC 9562, 4.1. Variant Field
     *
     * @var int
     */
    public int $variant { get; }

    /**
     * Gets the UUID version
     *
     * The version number describes how the UUID was generated and has the following meaning:
     *
     * 1. Gregorian time UUID
     * 2. DCE security UUID
     * 3. Name-based UUID hashed with MD5
     * 4. Randomly generated UUID
     * 5. Name-based UUID hashed with SHA-1
     * 6. Reordered Gregorian time UUID
     * 7. Unix Epoch time UUID
     * 8. Custom format UUID
     *
     * This returns `null` if the UUID is not an RFC 9562 (formerly RFC 4122) variant, since the version is only
     * meaningful for this variant.
     *
     * @link https://www.rfc-editor.org/rfc/rfc9562#section-4.2 RFC 9562, 4.2. Version Field
     *
     * @var ?int
     */
    public ?int $version { get; }
# -- Properties
}
