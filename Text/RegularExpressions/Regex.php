<?php

class System_Text_RegularExressions_Regex {
	
	private $_pattern;
	private $_caseSensitive;
	
	public function __construct($pattern, $caseSensitive = true) {
		$this->_pattern = $pattern;
		$this->_caseSensitive = $caseSensitive;
	}
	
	
	public static function Escape($string) {
		
	}
	
	public static function Unescape($string) {
		
	}
	
}
