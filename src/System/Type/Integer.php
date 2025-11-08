<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on Type\Integer.php
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

use ValueError;
use System\ArgumentException;

use function assert;
use function is_numeric;
use function preg_match;
use function sprintf;
use function substr;

/**
 * A value object representing an integer
 *
 * This class exists for type-safety purposes, to ensure that integers returned from ramsey/uuid methods as strings are
 * truly integers and not some other kind of string.
 *
 * To support large integers beyond PHP_INT_MAX and PHP_INT_MIN on both 64-bit and 32-bit systems, we store the integers
 * as strings.
 *
 * @immutable
 */
final class Integer implements NumberInterface {
# Fields
    /**
     * @var numeric-string
     */
    private string $value;
# -- Fields

# Constructor
    /**
     * Creates a new instance of Integer
     */
    public function __construct(self | float | int | string $value) {
        if ($value instanceof self) {
            $this->value = (string) $value;
            $this->isNegative = $value->isNegative;
        } else {
            list($this->value, $this->isNegative) = $this->parse($value);
        }
    }
# -- Constructor

# Members of JsonSerializable
    /**
     * Returns JSON value
     *
     * @return non-empty-string
     */
    public function jsonSerialize(): string {
        return $this->__toString();
    }
# -- Members of JsonSerializable

# Members of Serializable
    /**
     * Returns a string representation of the object
     *
     * @return non-empty-string
     */
    public function serialize(): string {
        return $this->__toString();
    }
    /**
     * Return a array representation of the object
     *
     * @return array{string: string}
     */
    public function __serialize(): array {
        return ['string' => $this->__toString()];
    }
    /**
     * Constructs the object from a serialized string representation
     *
     * @param string $data The serialized string representation of the object
     */
    public function unserialize(string $data): void {
        $this->__construct($data);
    }
    /**
     * Restore object data from array representation
     *
     * @param array{string?: string} $data  The array representation of the object
     * @throws ValueError                   If the array representation doesn't contains the 'string' key
     */
    public function __unserialize(array $data): void {
        // @codeCoverageIgnoreStart
        if (!isset($data['string'])) {
            throw new ValueError(sprintf('%s(): Argument #%d ($data) is invalid', __METHOD__, 1));
        }
        // @codeCoverageIgnoreEnd

        $this->unserialize($data['string']);
    }
# -- Members of Serializable

# Members of Stringable
    /**
     * Returns a string representation of the object
     *
     * @return numeric-string
     */
    public function __toString(): string {
        return $this->value;
    }
# -- Members of Stringable

# Members of NumberInterface
    /**
     * Gets true if this number is less than zero
     *
     * @var bool
     */
    public private(set) bool $isNegative = false {
        get => $this->isNegative;
        set(bool $value) => $this->isNegative = $value;
    }
# -- Members of NumberInterface

# Methods
    /**
     * Parse a integer value to a numeric string
     *
     * @return array[numeric-string, bool] Numeric string representation, True if the value is negative
     * @throws InvalidArgumentException If the value is not a signed integer or a string containing only digits 0-9 and, optionally, a sign (+ or -)
     */
    public static function parse(float | int | string $value): array {
        $value      = (string) $value;
        $sign       = '+';
        $isNegative = false;

        // If the value contains a sign, remove it for the digit pattern check.
        if (str_starts_with($value, '-') ||
            str_starts_with($value, '+')) {

            $sign = substr($value, 0, 1);
            $value = substr($value, 1);
        }

        // Parse float '/^([+-])?(\d+.?\d*)$/'
        if (!preg_match('/^\d+$/', $value)) {
            require_once __DIR__ . '/../ArgumentException.php';
            throw new InvalidArgumentException('value',
                'Value must be a signed integer or a string containing only '
                . 'digits 0-9 and, optionally, a sign (+ or -)'
            );
        }

        // Trim any leading zeros.
        $value = ltrim($value, '0');

        // Set to zero if the string is empty after trimming zeros.
        if ($value === '') {
            $value = '0';
        }

        // Add the negative sign back to the value.
        if ($sign === '-' &&
            $value !== '0') {

            $value = $sign . $value;

            /** @phpstan-ignore property.readOnlyByPhpDocAssignNotInConstructor */
            $isNegative = true;
        }

        assert(is_numeric($value));

        return [$value, $isNegative];
    }
# -- Methods
}
