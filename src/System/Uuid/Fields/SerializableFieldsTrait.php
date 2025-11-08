<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on Fields\SerializableFieldsTrait.php
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

use ValueError;
use System\ArgumentException;

use function base64_decode;
use function sprintf;
use function strlen;

/**
 * Provides common serialization functionality to fields
 *
 * @immutable
 */
trait SerializableFieldsTrait {
# Members of Serializable
    /**
     * Returns a string representation of the object
     *
     * @return non-empty-string
     */
    public function serialize(): string {
        return $this->bytes;
    }
    /**
     * Return a array representation of the object
     *
     * @return array{bytes: string}
     */
    public function __serialize(): array {
        return ['bytes' => $this->bytes];
    }
    /**
     * Constructs the object from a serialized string representation
     *
     * @param string $data The serialized string representation of the object
     * @throws ArgumentException If the data string is not exactly 16 bytes
     */
    public function unserialize(string $data): void {
        if (! strlen($data)) {
            $data = base64_decode($data);
        }

        if (strlen($data) === 16) {
            $this->__construct($data);
        } else {
            require_once __DIR__ . '/../../ArgumentException.php';
            throw new ArgumentException('data', 'Invalid number of bytes');
        }
    }
    /**
     * Restore object data from array representation
     *
     * @param array{bytes?: string} $data   The array representation of the object
     * @throws ValueError                   If the array representation doesn't contains the 'bytes' key
     */
    public function __unserialize(array $data): void {
        // @codeCoverageIgnoreStart
        if (!isset($data['bytes'])) {
            throw new ValueError(sprintf('%s(): Argument #%d ($data) is invalid', __METHOD__, 1));
        }
        // @codeCoverageIgnoreEnd

        $this->unserialize($data['bytes']);
    }
# -- Members of Serializable

# Abstract Members
    /**
     * @param string $bytes The bytes that comprise the fields
     */
    abstract public function __construct(string $bytes);

    /**
     * Returns the bytes that comprise the fields
     *
     * @var non-empty-string
     */
    abstract public string $bytes { get; }
# -- Abstract Members
}
