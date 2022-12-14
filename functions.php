<?php
/**
 * Les Rapporteuses functions and definitions
 *
 * @package WordPress
 * @subpackage WordPressTheme
 */

// Autoloader.
require_once get_template_directory() . '/vendor/autoload.php';

Timber\Timber::init();
WordPressTheme\Init::run_services();
