<?php
/**
  * Unidad de almacenamiento
  *
  * Description. Define unidades de almacenamiento
  *
  * @package    System
  * @author     Marcos Porto Mariño <lib-system@marcospor.to>
  * @copyright  2025, Marcos Porto
  * @since      v0.1
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
