<?php
/**
 * This file is part of the Rodas\System library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Rodas\System
 * @copyright 2026 Marcos Porto <php@marcospor.to>
 * @license https://opensource.org/license/mit The MIT License
 * @link https://marcospor.to/repositories/system
 */

declare(strict_types=1);

namespace Rodas\System;

use Rodas\System\Localization\Resources;

/**
 * Represents a region
 */
class Region {

    /**
     * Get a code that represents the region
     *
     * @var string
     */
    public protected(set) string $code {
        get => $this->code;
    }

    /**
     * Get the name of the region, in current language
     *
     * @var string|null
     */
    public protected(set) ?string $name {
        get {
            if (! isset($this->name)) {
                require_once __DIR__ . '/Localization/Resources.php';
                $this->name = isset(Resources::REGIONS[$this->code])
                    ? Resources::REGIONS[$this->code]
                    : null;
            }
            return $this->name;
        }
    }

    /**
     * Create a new instance of Region
     *
     * @param  string      $code
     * @param  string|null $name
     */
    public function __construct(string $code, ?string $name) {
        $this->code = $code;
        if ($name !== null) {
            $this->name = $name;
        }
    }

    public static function getFromCode(string $code): ?Region {
        $code = strtoupper($code);
        require_once __DIR__ . '/Localization/Resources.php';
        if (isset(Continent::LIST[$code])) {
            // Is a continent
            $name = isset(Resources::REGIONS[$code])
                ? new Region($code, Resources::REGIONS[$code])
                : null;
            return new Continent($code, $name);
        }
        return isset(Resources::REGIONS[$code])
            ? new Region($code, Resources::REGIONS[$code])
            : null;
    }
}
