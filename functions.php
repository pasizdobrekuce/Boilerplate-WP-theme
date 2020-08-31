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

require_once HEADLAB_DIR_PATH . '/inc/helpers/autoloader.php';

function headlab_get_theme_instance() {
    \HEADLAB_THEME\Inc\HEADLAB_THEME::get_instance();
}
headlab_get_theme_instance();