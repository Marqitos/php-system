<?php

namespace System\Text\RegularExpressions;

class Regex {
	
	private $pattern;
	private $caseSensitive;
	
	public function __construct($pattern, $caseSensitive = true) {
		$this->pattern = $pattern;
		$this->caseSensitive = $caseSensitive;
	}
	
	public static function Escape($string) {
		
	}
	
	public static function Unescape($string) {
		
	}
	
}
