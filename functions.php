<?php
/**
 * Main functions file
 * 
 * @package Headlab
 */

if(!defined('HEADLAB_DIR_PATH')) {
    define('HEADLAB_DIR_PATH', untrailingslashit( get_template_directory() ));
}

if(!defined('HEADLAB_DIR_URI')) {
    define('HEADLAB_DIR_URI', untrailingslashit( get_template_directory_uri() ));
}

if(!defined('HEADLAB_BUILD_URI')) {
    define('HEADLAB_BUILD_URI', untrailingslashit( get_template_directory_uri() . '/assets/build' ));
}

if(!defined('HEADLAB_BUILD_JS_URI')) {
    define('HEADLAB_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/js' ));
}

if(!defined('HEADLAB_BUILD_JS_DIR_PATH')) {
    define('HEADLAB_BUILD_JS_DIR_PATH', untrailingslashit( get_template_directory() . '/assets/build/js' ));
}

if(!defined('HEADLAB_BUILD_CSS_URI')) {
    define('HEADLAB_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/css' ));
}

if(!defined('HEADLAB_BUILD_CSS_DIR_PATH')) {
    define('HEADLAB_BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() . '/assets/build/css' ));
}

if(!defined('HEADLAB_BUILD_IMG_URI')) {
    define('HEADLAB_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/src/img' ));
}

require_once HEADLAB_DIR_PATH . '/inc/helpers/autoloader.php';

function headlab_get_theme_instance() {
    \HEADLAB_THEME\Inc\HEADLAB_THEME::get_instance();
}
headlab_get_theme_instance();