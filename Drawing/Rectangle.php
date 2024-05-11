<?php declare(strict_types = 1);

namespace System\Drawing;

use System\Drawing\Point;
use System\Drawing\Size;
use function max;
use function min;

require_once 'Point.php';
require_once 'Size.php';

/**
 * Almacena un conjunto de cuatro números que representan la posición y el tamaño de un rectángulo.
 */
class Rectangle {
    
    public function __construct(
        private Point $location,
        private Size $size
    ) {}
    
    public function getLocation() {
        return $this->location;
    }
    public function getSize() {
        return $this->size;
    }
    public function getX() {
        return $this->location->x;
    }
    public function getY() {
        return $this->location->y;
    }
    public function getWidth() {
        return $this->size->width;
    }
    public function getHeight() {
        return $this->size->height;
    }
    
    public function getLeft() {
        return $this->size->width < 0
            ? $this->location->x + $this->size->width
            : $this->location->x;
    }
    public function getTop() {
        return $this->size->height < 0
            ? $this->location->y + $this->size->height
            : $this->location->y;
    }
    public function getRight() {
        return $this->size->width < 0
            ? $this->location->x
            : $this->location->x + $this->size->width;
    }
    public function getBottom() {
        return $this->size->height < 0
            ? $this->location->y
            : $this->location->y + $this->size->height;
    }
    
    public static function fromLTRB($left, $top, $right, $bottom) {
        $point = new Point($left, $top);
        $size = new Size($right - $left, $bottom - $top);
        return new self($point, $size);
    }
    
    public static function union(Rectangle $a, Rectangle $b) {
        return self::fromLTRB(
            min($a->getLeft(), $b->getLeft()),
            min($a->getTop(), $b->getTop()),
            max($a->getRight(), $b->getRight()),
            max($a->getBottom(), $b->getBottom())
        );
    }
    
}
