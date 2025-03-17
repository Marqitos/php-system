<?php
/**
 * Unidad de almacenamiento
 *
 * Description. Define unidades de almacenamiento
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 5 >= 5.3.0, PHP 7
 */
namespace System\Uom;

/**
 * Define una unidad de almacenamiento, con su cantidad
 */
interface UomInterface {
    /**
     * Obtiene la cantidad
     */
    public function getQuantity();
}