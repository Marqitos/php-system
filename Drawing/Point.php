<?php

namespace System\Drawing;

/**
 * Representa un par ordenado de coordenadas x e y que define un punto en un plano bidimensional.
 */
class Point {
	public $x;
	public $y;
	
	/**
	 * Crea un nuevo punto
	 * 
	 * @param number $x Coordenada x
	 * @param number $y Coordenada y
	 */
	public function __construct($x, $y) {
		$this->x = $x;
		$this->y = $y;
	}
	
	/**
	 * Obtiene un valor que indica si este punto está vacío.
	 * 
	 * @return bool true si está vacía.
	 */
	public function getIsEmpty() {
		return $this->x == 0 && $this->y == 0;
	}
	
}