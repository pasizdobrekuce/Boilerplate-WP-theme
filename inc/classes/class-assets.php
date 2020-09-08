<?php 
/**
* Class Assets
* 
* @package Headlab
*/

 namespace HEADLAB_THEME\Inc;

 // Use Singleton
 use HEADLAB_THEME\Inc\Traits\Singleton;

class Assets {
    use Singleton;

    protected function __construct() {
        $this->set_hooks();
    }

    protected function set_hooks() {
        /**
         * Hook styles
         */
        add_action( 'wp_enqueue_scripts', [$this, 'register_styles'] );

        /**
         * Hook scripts
         */
        add_action( 'wp_enqueue_scripts', [$this, 'register_scripts'] );
    }
    
    public function register_styles() {
        // Register styles
        wp_register_style( 
            'bootstrap-style', 
            HEADLAB_DIR_URI . '/assets/src/libs/bootstrap/css/bootstrap.min.css', 
            array(), 
            '4.5.0', 
            'all' 
        );
        wp_register_style( 'headlab-style',
            HEADLAB_DIR_URI . '/style.css', 
            array(), 
            filemtime(HEADLAB_DIR_PATH . '/style.css'), 
            'all' 
        );

        // Enqueue styles
        wp_enqueue_style( 'bootstrap-style' );
        wp_enqueue_style( 'headlab-style' );
    }

    public function register_scripts() {
        // Register scripts
        wp_register_script( 
            'bootstrap-script', 
            HEADLAB_DIR_URI . '/assets/src/libs/bootstrap/js/bootstrap.min.js', 
            array('jquery'), 
            '4.5.0', 
            true 
        );
        wp_register_script( 
            'headlab-script', 
            HEADLAB_BUILD_JS_URI . '/main.js', 
            array('jquery'), 
            filemtime(HEADLAB_BUILD_JS_DIR_PATH . '/main.js'), 
            true 
        );

        // Enqueue scripts
        wp_enqueue_script( 'bootstrap-script' );
        wp_enqueue_script( 'headlab-script' );
    }
};