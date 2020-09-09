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
        $this->init();
    }

    protected function init() {
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
            'bootstrap', 
            HEADLAB_DIR_URI . '/assets/src/libs/bootstrap/css/bootstrap.min.css', 
            [], 
            '4.5.0', 
            'all' 
        );
        wp_register_style( 'main',
            HEADLAB_BUILD_CSS_URI . '/main.css', 
            ['bootstrap'], 
            filemtime(HEADLAB_BUILD_CSS_DIR_PATH . '/main.css'), 
            'all' 
        );

        // Enqueue styles
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style( 'main' );
    }

    public function register_scripts() {
        // Register scripts
        wp_register_script( 
            'bootstrap', 
            HEADLAB_DIR_URI . '/assets/src/libs/bootstrap/js/bootstrap.min.js', 
            ['jquery'], 
            '4.5.0', 
            true 
        );
        wp_register_script( 
            'main', 
            HEADLAB_BUILD_JS_URI . '/main.js', 
            ['jquery'], 
            filemtime(HEADLAB_BUILD_JS_DIR_PATH . '/main.js'), 
            true 
        );

        // Enqueue scripts
        wp_enqueue_script( 'bootstrap' );
        wp_enqueue_script( 'main' );
    }
};