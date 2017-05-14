<?php
require_once 'Point.php';
require_once 'Size.php';
	
class System_Drawing_Rectangle {
	private $_location;
	private $_size;
	
	public function __construct(System_Drawing_Point $location, System_Drawing_Size $size) {
		$this->_location = $location;
		$this->_size = $size;
	}
	
	public function getLocation() {
		return $this->_location;
	}
	public function getSize() {
		return $this->_size;
	}
	public function getX() {
		return $this->_location->x;
	}
	public function getY() {
		return $this->_location->y;
	}
	public function getWidth() {
		return $this->_size->width;
	}
	public function getHeight() {
		return $this->_size->height;
	}
	
	public function getLeft() {
		return $this->_size->width < 0 
			? $this->_location->x + $this->_size->width
			: $this->_location->x;
	}
	public function getTop() {
		return $this->_size->height < 0 
			? $this->_location->y + $this->_size->height
			: $this->_location->y;
	}
	public function getRight() {
		return $this->_size->width < 0 
			? $this->_location->x
			: $this->_location->x + $this->_size->width;
	}	
	public function getBottom() {
		return $this->_size->height < 0 
			? $this->_location->y
			: $this->_location->y + $this->_size->height;
	}
	
	public static function fromLTRB($left, $top, $right, $bottom) {
		$point = new System_Drawing_Point($left, $top);
		$size = new System_Drawing_Size($right - $left, $bottom - $top);
		return new self($point, $size);
	}
	
	public static function union(System_Drawing_Rectangle $a, System_Drawing_Rectangle $b) {
		return self::fromLTRB(
			min($a->getLeft(), $b->getLeft()),
			min($a->getTop(), $b->getTop()),
			max($a->getRight(), $b->getRight()),
			max($a->getBottom(), $b->getBottom())
		);
	}
	
}