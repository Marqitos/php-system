<?php declare(strict_types = 1);

namespace System\Drawing;

/**
 * Representa un par ordenado de coordenadas x e y que define un punto en un plano bidimensional.
 */
class Point {

    /**
     * Crea un nuevo punto
     *
     * @param number $x Coordenada x
     * @param number $y Coordenada y
     */
    public function __construct(
        public $x,
        public $y
    ) {}

    /**
     * Obtiene un valor que indica si este punto está vacío.
     *
     * @return bool true si está vacía.
     */
    public function getIsEmpty() {
        return $this->x == 0 && $this->y == 0;
    }

}
