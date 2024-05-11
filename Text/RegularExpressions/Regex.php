<?php declare(strict_types = 1);

namespace System\Text\RegularExpressions;

class Regex {
    
    public function __construct(
        private $pattern, 
        private bool $caseSensitive = true
    ) {}
    
    public static function Escape($string) {
        
    }
    
    public static function Unescape($string) {
        
    }
    
}
