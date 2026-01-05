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

use DateTimeZone;

use function strlen;
use function strtoupper;

/**
 * Represents a country
 */
class Country extends Region {
    /**
     * ISO 3166-1 alpha-2 code
     *
     * @var string
     */
    public string $alpha2Code {
        get => $this->code;
    }

    public protected(set) array $timezones {
        get => $this->timezones;
        set => $this->timezones = $value;
    }

    public function __construct(string $code, ?string $name = null) {
        if (strlen($code) !== 2) {
            throw new InvalidArgumentException('Country code must be a 2-letter ISO Alpha-2 code.');
        }
        $code = strtoupper($code);
        parent::__construct($code, $name);
        $this->timezones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $code);
    }

    // TODO: continents

}
