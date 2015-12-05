<?php
	
class System_Drawing_Size {
	public $width;
	public $height;
	
	public function __construct($width, $height) {
		$this->width = $width;
		$this->height = $height;
	}
	
	public function getIsEmpty() {
		return $this->x == 0 || $this->y == 0;
	}
	
}