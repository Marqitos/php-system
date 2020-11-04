<?php
/**
 * Unidad de almacenamiento de bytes
 *
 * Description. Representa un tamaño en bytes
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto Mariño
 * @since v0.1
 * PHP 5 >= 5.3.0, PHP 7
 */
namespace System\Uom;

use System\Uom\UomInterface;
use function sprintf;

require_once 'System/Uom/UomInterface.php';
/**
 * Representa un tamaño en bytes
 */
class Byte implements UomInterface{

    private $quantity;
    private $multiplos = 'ISO';
    // ISO/IEC 80000-13
    // Sistema Internacional
    const SI_UNITS = [
        0   => 'B',     // Byte
        1   => 'KB',    // Kilobyte
        2   => 'MB',    // Megabyte
        3   => 'GB',    // Gigabyte
        4   => 'TB',    // Terabyte
        5   => 'PB',    // Petabyte
        6   => 'EB',    // Exabyte
        7   => 'ZB'     // Zettabyte
    ];

    /**
     * Crea un objeto con la cantidad inicial de bytes
     * 
     * @param int $quantity Cantidad de bytes
     */
    public function __construct(int $quantity) {
        $this->quantity = $quantity;
    }

    /**
     * @inheritdoc
     */
    public function getQuantity() {
        return $this->getBytes;
    }

    /**
     * Obtiene la cantidad de bytes
     * 
     * @return int Cantidad de bytes
     */
    public function getBytes() {
        return $this->quantity;
    }

    /**
     * Establece la cantidad de bytes
     * 
     * @param int $value Cantidad de bytes
     */
    public function setBytes(int $value) {
        $this->quantity = $value;
    }

    /**
     * Devuelve una cadena expresando el tamaño, en la unidad más adecuada
     * 
     * @return string Representación del tamaño como texto
     */
    public function __toString() {
        $quantity = $this->quantity;
        $m = 0;
        while($quantity > 1000) {
            $quantity /= 1024; // ISO
            $m++;
        }
        if($m == 0) {
            return sprintf("%d", $quantity) . ' ' . self::SI_UNITS[$m];
        }
        return sprintf("%01.2f", $quantity) . ' ' . self::SI_UNITS[$m];
    }

}