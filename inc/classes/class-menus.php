<?php 
/**
* Class Menus
* 
* @package Headlab
*/

 namespace HEADLAB_THEME\Inc;

 // Use Singleton
 use HEADLAB_THEME\Inc\Traits\Singleton;

class Menus {
    use Singleton;

    protected function __construct() {
        $this->init();
    }

    protected function init() {
        /**
         * Hook styles
         */
        add_action( 'init', [$this, 'register_menus'] );
    }

    public function register_menus() {
        // Register_menus
        register_nav_menus([
            'headlab-primary-menu'  => __('Primary Menu', 'headlab'),
            'headlab-footer-menu'   => __('Footer Menu', 'headlab'),
        ]);
    }

    public function get_menu( $location ) {
        // Get all the locations
        $locations = get_nav_menu_locations();

        // Get object ID by location
        $menu_id = $locations[$location];

        // Throw error if menu ID not found
        if( empty( $menu_id ) ) {
            return;
        }

        return wp_get_nav_menu_items( $menu_id );
    }
};