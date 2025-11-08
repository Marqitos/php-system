<?php
/**
 * This file is part of the Rodas\System library
 *
 * Based on Rfc4122\VersionTrait.php
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

use System\Uuid;

/**
 * Provides common functionality for handling the version, as defined by RFC 9562 (formerly RFC 4122)
 *
 * @immutable
 */
trait VersionTrait {
# Methods
    /**
     * Returns true if the version matches one of those defined by RFC 9562 (formerly RFC 4122)
     *
     * @return bool True if the UUID version is valid, false otherwise
     */
    private function isCorrectVersion(): bool {
        require_once __DIR__ . '/../../Uuid.php';
        if (Uuid::isNil($this) ||
            Uuid::isMax($this)) {

            return true;
        }

        require_once __DIR__ . '/FieldsInterface.php';
        return match ($this->version) {
            FieldsInterface::UUID_TYPE_TIME,
            FieldsInterface::UUID_TYPE_DCE_SECURITY,
            FieldsInterface::UUID_TYPE_HASH_MD5,
            FieldsInterface::UUID_TYPE_RANDOM,
            FieldsInterface::UUID_TYPE_HASH_SHA1,
            FieldsInterface::UUID_TYPE_REORDERED_TIME,
            FieldsInterface::UUID_TYPE_UNIX_TIME,
            FieldsInterface::UUID_TYPE_CUSTOM => true,

            default => false,
        };
    }
# -- Methods

# Abstract Members
    /**
     * Returns the UUID version
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
     */
    abstract public ?int $version { get; }
# -- Abstract Members
}
