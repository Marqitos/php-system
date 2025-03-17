<?php declare(strict_types = 1);

namespace System\Drawing;

/**
 * Almacena un par numeros, que especifican ancho y alto.
 */
class Size {
    
    public function __construct(
        public $width,
        public $height
    ) {}
    
    public function getIsEmpty() {
        return $this->width == 0 || $this->height == 0;
    }
    
}
