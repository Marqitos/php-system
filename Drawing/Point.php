<?php
	
class System_Drawing_Point {
	public $x;
	public $y;
	
	public function __construct($x, $y) {
		$this->x = $x;
		$this->y = $y;
	}
	
	public function getIsEmpty() {
		return $this->x == 0 && $this->y == 0;
	}
	
}