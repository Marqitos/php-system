<?php
/**
 * Carga los recursos localizados para mensajes de error y otros
 *
 * @package System
 * @author Marcos Porto
 * @copyright Marcos Porto
 * @since v0.4
 */

global $lang, $application;

if(!isset($lang) &&
   isset($application) &&
   $localizationPlugin = $application->hasPlugin('localization')) {
    $localizationPlugin->getLocale();
}

if(isset($lang)) {
    if(file_exists("$lang.php")) {
        require_once "$lang.php";
    } elseif(strlen($lang) > 2 && file_exists(substr($lang, 0, 2) . '.php')) {
        require_once substr($lang, 0, 2) . '.php';
    }
} else {
    require_once 'es.php';
}
