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
use Rodas\System\Collections\KeyNotFoundException;

use function strlen;
use function strtoupper;

/**
 * Represents a continent
 */
class Continent extends Region {

    /**
     * List of continent codes
     *
     * America has 2 continent codes
     *
     * @var array<string,array>
     */
    public const LIST = [
        'AF'    => [
            'name'      => 'Africa',
            'timezones' => [
                DateTimeZone::AFRICA,
                DateTimeZone::ATLANTIC]],
        'AN'    => [
            'name'      => 'Antarctica',
            'timezones' => [
                DateTimeZone::ANTARCTICA]],
        'AS'    => [
            'name'      => 'Asia',
            'timezones' => [
                DateTimeZone::ARCTIC,
                DateTimeZone::ASIA,
                DateTimeZone::ATLANTIC,
                DateTimeZone::INDIAN,
                DateTimeZone::PACIFIC]],
        'EU'    => [
            'name'      => 'Europe',
            'timezones' => [
                DateTimeZone::ARCTIC,
                DateTimeZone::EUROPE]],
        'NA' => [
            'name'      => 'America',
            'timezones' => [
                DateTimeZone::AMERICA,
                DateTimeZone::ARCTIC,
                DateTimeZone::ATLANTIC,
                DateTimeZone::PACIFIC]],
        'OC'    => [
            'name'      => 'Oceania',
            'timezones' => [
                DateTimeZone::AUSTRALIA,
                DateTimeZone::PACIFIC]],
        'SA' => [
            'name'      => 'America',
            'timezones' => [
                DateTimeZone::AMERICA,
                DateTimeZone::ATLANTIC,
                DateTimeZone::PACIFIC]]];
    /**
     * List of America continent codes
     *
     * @var array<string,string>
     */
    public const AMERICA_LIST = [
        'NA' => 'North America',
        'SA' => 'South America',
    ];
    /**
     * List of ultramar timezone codes
     *
     * @var array<int>
     */
    public const ULTRAMAR_LIST = [
        DateTimeZone::ATLANTIC,
        DateTimeZone::ARCTIC,
        DateTimeZone::PACIFIC
    ]

    public protected(set) string $enName {
        get => $this->enName;
        set => $this->enName = $value;
    }

    public protected(set) array $timezones {
        get => $this->timezones;
        set => $this->timezones = $value;
    }

    public function __construct(string $code, ?string $name = null) {
        if (strlen($code) !== 2) {
            throw new InvalidArgumentException('Continent code must be a 2-letter Alpha-2.');
        }
        $code = strtoupper($code);
        $valid = false;
        foreach (static::LIST as $key => $value) {
            if ($value['code'] === $key) {
                $this->enName = $value['name'];
                if ($name === null) {
                    $name = $value['name'];
                }
                $this->timezones = $value['timezones'];
                $valid = true;
                break;
            }
        }
        if (! $valid) {
            throw new KeyNotFoundException("Continent not found: {$this->code}");
        }
        parent::__construct($code, $name);
    }

    // TODO: countries
}
