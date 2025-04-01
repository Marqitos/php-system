<?php declare(strict_types = 1);
/**
  * Proporciona funciones para trabajar con expresiones regulares, mediante PCRE (Perl-Compatible Regular Expressions)
  *
  * @package    System
  * @author     Marcos Porto Mariño
  * @copyright  2025, Marcos Porto <lib-system@marcospor.to>
  * @since      v0.6
  */

namespace System\Text\RegularExpressions;

use System\Text\RegularExpressions\PregException;
use function preg_grep;
use function preg_match;
use function preg_match_all;
use function preg_quote;
use const PREG_GREP_INVERT;
use const PREG_OFFSET_CAPTURE;

/**
  * Representa una clase para manejar las funciones Regular Expressions (Perl-Compatible)
  *
  * @property-read string $pattern
  */
#[SuppressWarnings("php:S1192")]
class PerlCompatible {

    public function __construct(private $pattern) {}

    public static function escape(string $value, ?string $delimiter = null) {
        return preg_quote($value, $delimiter);
    }

    public function grep(array $array, bool $invert = false) {
        $flags = $invert ? PREG_GREP_INVERT : 0;
        $matches = preg_grep($this->pattern, $array, $flags);
        require_once 'System/Text/RegularExpressions/PregException.php';
        PregException::validate();
        return $matches;
    }

    /**
     * Devuelve la primera coincidencia de la cadena de entrada
     *
     * @param string $subject La cadena de entrada.
     * @param integer $offsetCapture
     * @param integer $offset
     * @return array Devuelve los resultados de la búsqueda. [0] contendrá el texto que coincidió con el patrón completo, [1] tendrá el texto que coincidió con el primer sub-patrón entre paréntesis capturado, y así sucesivamente.
     */
    public function match(string $subject, bool $offsetCapture = false, int $offset = 0) : array {
        $matches = [];
        $flags = $offsetCapture ? PREG_OFFSET_CAPTURE : 0;
        if (@preg_match($this->pattern, $subject, $matches, $flags, $offset) === false) {
            require_once 'System/Text/RegularExpressions/PregException.php';
            PregException::validate();
            throw new LogicException();
        }
        return $matches;
    }

    public function matchAll(string $subject, int $flags = PREG_PATTERN_ORDER, int $offset = 0) : array {
        $matches = [];
        if (@preg_match_all($this->pattern, $subject, $matches, $flags, $offset) === false) {
            require_once 'System/Text/RegularExpressions/PregException.php';
            PregException::validate();
            throw new LogicException();
        }
        return $matches;
    }

    /**
     * Divide un string mediante una expresión regular
     *
     * @param string $subject string a dividir
     * @param integer $limit Si se especifica, son devueltos únicamente los substrings hasta limit, con el resto del string colocado en el último substring. Si limit vale -1 o 0 significa "sin límite".
     * @param integer $flags Si se especifica, puede ser la combinación de las flags PREG_SPLIT_NO_EMPTY, PREG_SPLIT_DELIM_CAPTURE, PREG_SPLIT_OFFSET_CAPTURE
     * @return array
     */
    public function split(string $subject, int $limit = -1, int $flags = 0) : array {
        $matches = preg_split($this->pattern, $subject, $limit, $flags);
        if ($matches === false) {
            require_once 'System/Text/RegularExpressions/PregException.php';
            PregException::validate();
            throw new LogicException();
        }
        return $matches;
    }

}
