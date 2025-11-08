<?php
/**
 * This file is part of the Rodas\System library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Rodas\System
 * @copyright 2025 Marcos Porto <php@marcospor.to>
 * @license https://opensource.org/license/mit The MIT License
 * @link https://marcospor.to/repositories/system
 */

declare(strict_types=1);

namespace System;

use InvalidArgumentException;
use Throwable;
use System\HResults;
use System\Localization\Resources;

require_once __DIR__ . '/HResults.php';
require_once __DIR__ . '/Localization/Resources.php';

/**
  * Represents an exception, indicating which parameter and the reason why it is not valid.
  */
class ArgumentException extends InvalidArgumentException {
    /**
      * Create a new instance of ArgumentException
      *
      * @param  string         $paramName The name of the argument that has an incorrect value
      * @param  string         $message   (Optional) The error message
      * @param  int            $code      (Optional) The error code
      * @param  Throwable|null $previous  (Optional) The previously thrown exception
      */
    public function __construct(string $paramName, string $message = Resources::E_ARGUMENT_EXCEPTION, int $code = HResults::COR_E_ARGUMENT, ?Throwable $previous = null) {
        $this->paramName = $paramName;
        parent::__construct($message, $code, $previous);
    }

    /**
      * Gets the name of the argument that has an incorrect value
      *
      * @var string
      */
    public private(set) string $paramName {
        get => $this->paramName;
        set(string $value) => $this->paramName = $value;
    }

}
