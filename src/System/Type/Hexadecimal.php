<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on Type\Hexadecimal.php
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

use Ramsey\Uuid\Exception\InvalidArgumentException;
use ValueError;

use function preg_match;
use function sprintf;
use function substr;

/**
 * A value object representing a hexadecimal number
 *
 * This class exists for type-safety purposes, to ensure that hexadecimal numbers returned from ramsey/uuid methods as
 * strings are truly hexadecimal and not some other kind of string.
 *
 * @immutable
 */
final class Hexadecimal implements TypeInterface {
# Fields
    /**
     * @var non-empty-string
     */
    private string $value;
# -- Fields

# Constructor
    /**
     * Creates a new instance of Hexadecimal
     *
     * @param self | string $value The hexadecimal value to store
     */
    public function __construct(self | string $value) {
        $this->value = $value instanceof self
            ? (string) $value
            : self::parse($value);
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
     * Return string representation of object
     *
     * @return non-empty-string
     */
    public function serialize(): string {
        return $this->__toString();
    }
    /**
     * Return array representation of object
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
     * @return non-empty-string
     */
    public function __toString(): string {
        return $this->value;
    }
# -- Members of Stringable

# Methods
    /**
     * Parse a hexadecimal string
     *
     * @return non-empty-string
     */
    public static function parse(string $value): string {
        $value = strtolower($value);

        if (str_starts_with($value, '0x')) {
            $value = substr($value, 2);
        }

        if (!preg_match('/^[A-Fa-f0-9]+$/', $value)) {
            throw new InvalidArgumentException('Value must be a hexadecimal number');
        }

        /** @var non-empty-string */
        return $value;
    }
# -- Methods
}
