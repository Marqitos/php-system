<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on Rfc4122\VariantTrait.php
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

use RuntimeException;
use System\Uuid;
use System\Uuid\Fields\FieldsInterface;
use Ramsey\Uuid\Exception\InvalidBytesException;

use function decbin;
use function str_pad;
use function str_starts_with;
use function strlen;
use function substr;
use function unpack;

use const STR_PAD_LEFT;

/**
 * Provides common functionality for handling the variant, as defined by RFC 9562 (formerly RFC 4122)
 *
 * @immutable
 */
trait VariantTrait {
# Properties
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
     */
    public int $variant {
        get {
            // TODO: Verificar en el contructor
            if (strlen($this->bytes) !== 16) {
                throw new RuntimeException('Invalid number of bytes');
            }

            require_once __DIR__ . '/../../Uuid.php';
            require_once __DIR__ . '/FieldsInterface.php';
            // According to RFC 9562, sections {@link https://www.rfc-editor.org/rfc/rfc9562#section-4.1 4.1} and
            // {@link https://www.rfc-editor.org/rfc/rfc9562#section-5.10 5.10}, the Max UUID falls within the range
            // of the future variant.
            if (Uuid::isMax($this)) {
                return FieldsInterface::RESERVED_FUTURE;
            }

            // According to RFC 9562, sections {@link https://www.rfc-editor.org/rfc/rfc9562#section-4.1 4.1} and
            // {@link https://www.rfc-editor.org/rfc/rfc9562#section-5.9 5.9}, the Nil UUID falls within the range
            // of the Apollo NCS variant.
            if (Uuid::isNil($this)) {
                return FieldsInterface::RESERVED_NCS;
            }

            /** @var int[] $parts */
            $parts = unpack('n*', $this->bytes);

            // TODO: Use PHP 8.5 syntax |>
            // $parts[5] is a 16-bit, unsigned integer containing the variant bits of the UUID. We convert this integer into
            // a string containing a binary representation, padded to 16 characters. We analyze the first three characters
            // (three most-significant bits) to determine the variant.
            /** @var string $msb */
            $msb = substr(str_pad(decbin($parts[5]), 16, '0', STR_PAD_LEFT), 0, 3);

            return match (true) {
                $msb === '111' => FieldsInterface::RESERVED_FUTURE,
                $msb === '110' => FieldsInterface::RESERVED_MICROSOFT,
                str_starts_with($msb, '10') => FieldsInterface::RFC_4122,
                default => FieldsInterface::RESERVED_NCS
            };
        }
    }
# -- Properties

# Abstract Members
    /**
     * Returns the bytes that comprise the fields
     *
     * @var non-empty-string
     */
    abstract public string $bytes { get; }
# -- Abstract Members
}
