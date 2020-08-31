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
        $this->set_hooks();
    }

    protected function set_hooks() {
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

    public function get_menu_id( $location ) {
        // Get all the locations
        $locations = get_nav_menu_locations();

        // Get object ID by location
        $menu_id = $locations[$location];

        return ! empty( $menu_id ) ? $menu_id : '';
    }
};