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

namespace Rodas\System\Region;

use Rodas\System\Region;
use Rodas\System\Country;

/**
 * Represents a macro region
 */
class MacroRegion extends Region {

    public const LIST_SUBTYPES = [
        '419' => [
            'type' => Country::class,
            'children' => [
                'AR', // Argentina
                'BO', // Bolivia
                'CL', // Chile
                'CO', // Colombia
                'CR', // Costa Rica
                'CU', // Cuba
                'DO', // República Dominicana
                'EC', // Ecuador
                'GT', // Guatemala
                'HN', // Honduras
                'MX', // México
                'NI', // Nicaragua
                'PA', // Panamá
                'PE', // Perú
                'PY', // Paraguay
                'SV', // El Salvador
                'UY', // Uruguay
                'VE', // Venezuela
                'PR', // Puerto Rico (territorio de EE. UU., pero hispanohablante)
        ]
    ];

    /**
     * Return if the regions has subregions
     *
     * @return string|false Child regions type, or false otherwise
     */
    public function hasChildren(): string|false {
        if (isset(static::LIST_SUBTYPES[$this->code])) {
            return static::LIST_SUBTYPES[$this->code]['type'];
        }
        return false;
    }
    /**
     * Get the child regions iterator
     *
     * @var Iterator
     */
    public Iterator $children {
        get {
            if (! isset($this->children)) {
                if (isset(static::LIST_SUBTYPES[$this->code])) {
                    $array  = [];
                    $type   = static::LIST_SUBTYPES[$this->code]['type'];
                    foreach (static::LIST_SUBTYPES[$this->code]['children'] as $code) {
                        $name = null;
                        if (is_string(Resources::REGIONS[$code])) {
                            $name = Resources::REGIONS[$code];
                        } elseif (is_array(Resources::REGIONS[$code]) &&
                                isset(Resources::REGIONS[$code]['name'])) {

                            $name = Resources::REGIONS[$code]['type'];
                        }
                        $array[] = new $type($code, $name);
                    }
                    $this->children = new ArrayIterator($array);
                } else {
                    $this->children = new ArrayIterator([]);
                }
            }
            return $this->children;
        }
    }


}