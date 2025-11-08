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

global $lang, $application;

if (! isset($lang) &&
    isset($application) &&

    $localizationPlugin = $application->hasPlugin('localization')) {
    $localizationPlugin->getLocale();
}
if (isset($lang) &&
    file_exists(__DIR__ . DIRECTORY_SEPARATOR . "$lang.php")) {

    require_once __DIR__ . DIRECTORY_SEPARATOR . "$lang.php";
} elseif (isset($lang) &&
          strlen($lang) > 2 &&
          file_exists(__DIR__ . DIRECTORY_SEPARATOR . substr($lang, 0, 2) . '.php')) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . substr($lang, 0, 2) . '.php';
} else {
    require_once 'es.php';
}
