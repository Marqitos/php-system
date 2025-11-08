<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on Rfc4122\Fields.php
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

use System\ArgumentException;
use System\Type\Hexadecimal;
use System\Uuid;

use function bin2hex;
use function dechex;
use function hexdec;
use function sprintf;
use function str_pad;
use function strlen;
use function substr;
use function unpack;

use const STR_PAD_LEFT;

require_once __DIR__ . '/FieldsInterface.php';
require_once __DIR__ . '/SerializableFieldsTrait.php';
require_once __DIR__ . '/VariantTrait.php';
require_once __DIR__ . '/VersionTrait.php';
require_once __DIR__ . '/../../Type/Hexadecimal.php';

const R_ARGUMENT_EXCEPTION = __DIR__ . '/../../ArgumentException.php';
const R_UUID = __DIR__ . '/../../Uuid.php';

/**
 * RFC 9562 (formerly RFC 4122) variant UUIDs consist of a set of named fields
 *
 * Internally, this class represents the fields together as a 16-byte binary string.
 *
 * @immutable
 */
final class Fields implements FieldsInterface {
    use SerializableFieldsTrait;
    use VariantTrait;
    use VersionTrait;

# Constructor
    /**
     * @param string $bytes A 16-byte binary string representation of a UUID
     *
     * @throws ArgumentException if the byte string is not exactly 16 bytes
     * @throws ArgumentException if the byte string does not represent an RFC 9562 (formerly RFC 4122) UUID
     * @throws ArgumentException if the byte string does not contain a valid version
     */
    public function __construct(string $bytes) {
        $this->bytes = $bytes;

        if (strlen($this->bytes) !== 16) {
            require_once R_ARGUMENT_EXCEPTION;
            throw new ArgumentException(
                'bytes',
                'The byte string must be 16 bytes long; ' . 'received ' . strlen($this->bytes) . ' bytes',
            );
        }

        if (!$this->isCorrectVariant()) {
            require_once R_ARGUMENT_EXCEPTION;
            throw new ArgumentException(
                'bytes',
                'The byte string received does not conform to the RFC 9562 (formerly RFC 4122) variant',
            );
        }

        if (!$this->isCorrectVersion()) {
            require_once R_ARGUMENT_EXCEPTION;
            throw new ArgumentException(
                'bytes',
                'The byte string received does not contain a valid RFC 9562 (formerly RFC 4122) version',
            );
        }
    }
# -- Constructor

# Members of FieldsInterface
    /**
     * Gets the bytes that comprise the fields
     *
     * @var non-empty-string
     */
    public private(set) string $bytes {
        get => $this->bytes;
        set(string $value) => $this->bytes = $value;
    }

    /**
     * Gets the full 16-bit clock sequence, with the variant bits (two most significant bits) masked out
     *
     * @var Hexadecimal
     */
    public Hexadecimal $clockSeq {
        get {
            require_once R_UUID;
            if (Uuid::isMax($this)) {
                $clockSeq = 0xffff;
            } elseif (Uuid::isNil($this)) {
                $clockSeq = 0x0000;
            } else {
                $clockSeq = hexdec(bin2hex(substr($this->bytes, 8, 2))) & 0x3fff;
            }

            return new Hexadecimal(str_pad(dechex($clockSeq), 4, '0', STR_PAD_LEFT));
        }
    }

    /**
     * Gets the high field of the clock sequence multiplexed with the variant
     *
     * @var Hexadecimal
     */
    public Hexadecimal $clockSeqHiAndReserved {
        get => new Hexadecimal(bin2hex(substr($this->bytes, 8, 1)));
    }

    /**
     * Gets the low field of the clock sequence
     *
     * @var Hexadecimal
     */
    public Hexadecimal $clockSeqLow {
        get => new Hexadecimal(bin2hex(substr($this->bytes, 9, 1)));
    }

    /**
     * Gets the node field
     *
     * @var Hexadecimal
     */
    public Hexadecimal $node {
        get => new Hexadecimal(bin2hex(substr($this->bytes, 10)));
    }

    /**
     * Gets the high field of the timestamp multiplexed with the version
     *
     * @var Hexadecimal
     */
    public Hexadecimal $timeHiAndVersion {
        get => new Hexadecimal(bin2hex(substr($this->bytes, 6, 2)));
    }

    /**
     * Gets the low field of the timestamp
     *
     * @var Hexadecimal
     */
    public Hexadecimal $timeLow {
        get => new Hexadecimal(bin2hex(substr($this->bytes, 0, 4)));
    }

    /**
     * Gets the middle field of the timestamp
     *
     * @var Hexadecimal
     */
    public Hexadecimal $timeMid {
        get => new Hexadecimal(bin2hex(substr($this->bytes, 4, 2)));
    }

    /**
     * Returns the full 60-bit timestamp, without the version
     *
     * For version 2 UUIDs, the time_low field is the local identifier and should not be returned as part of the time.
     * For this reason, we set the bottom 32 bits of the timestamp to 0's. As a result, there is some loss of timestamp
     * fidelity, for version 2 UUIDs. The timestamp can be off by a range of 0 to 429.4967295 seconds (or 7 minutes, 9
     * seconds, and 496,730 microseconds).
     *
     * For version 6 UUIDs, the timestamp order is reversed from the typical RFC 9562 (formerly RFC 4122) order (the
     * time bits are in the correct bit order, so that it is monotonically increasing). In returning the timestamp
     * value, we put the bits in the order: time_low + time_mid + time_hi.
     *
     * @var Hexadecimal
     */
    public Hexadecimal $timestamp {
        get => new Hexadecimal(match ($this->getVersion()) {
                self::UUID_TYPE_DCE_SECURITY => sprintf(
                    '%03x%04s%08s',
                    hexdec($this->timeHiAndVersion->__toString()) & 0x0fff,
                    $this->timeMid->__toString(),
                    ''
                ),
                self::UUID_TYPE_REORDERED_TIME => sprintf(
                    '%08s%04s%03x',
                    $this->timeLow->__toString(),
                    $this->timeMid->__toString(),
                    hexdec($this->timeHiAndVersion->__toString()) & 0x0fff
                ),
                // The Unix timestamp in version 7 UUIDs is a 48-bit number, but for consistency, we will return a 60-bit
                // number, padded to the left with zeros.
                self::UUID_TYPE_UNIX_TIME => sprintf(
                    '%011s%04s',
                    $this->timeLow->__toString(),
                    $this->timeMid->__toString(),
                ),
                default => sprintf(
                    '%03x%04s%08s',
                    hexdec($this->timeHiAndVersion->__toString()) & 0x0fff,
                    $this->timeMid->__toString(),
                    $this->timeLow->__toString()
                ),
            });
    }

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
    public ?int $version {
        get {
            require_once R_UUID;
            if (Uuid::isNil($this) ||
                Uuid::isMax($this)) {
                return null;
            }

            /** @var int[] $parts */
            $parts = unpack('n*', $this->bytes);

            return $parts[4] >> 12;
        }
    }
# -- Members of FieldsInterface

# Methods
    private function isCorrectVariant(): bool {
        require_once R_UUID;
        if (Uuid::isNil($this) ||
            Uuid::isMax($this)) {
            return true;
        }

        return $this->variant === self::RFC_4122;
    }
# -- Methods
}
