<?php
/**
 * Boottstraps the theme,
 * 
 * @package Headlab
 */

 namespace HEADLAB_THEME\Inc;

 // Use Singleton
 use HEADLAB_THEME\Inc\Traits\Singleton;
 
 class HEADLAB_THEME {
    use Singleton;

    protected function __construct() {

        // Load assets
        Assets::get_instance();

        // Load menus
        Menus::get_instance();

        // Run hooks
        $this->setup_hooks();

    }

    public function setup_hooks() {
        /**
         * Actions
         */
        add_action('after_setup_theme', [$this, 'setup_theme']);
    }

    public function setup_theme() {

        // HTML 5 support
        add_theme_support( 'html5', 
            [
            'comment-list', 
            'comment-form', 
            'search-form', 
            'gallery', 
            'caption', 
            'style', 
            'script'
            ] 
        );

        // Title
        add_theme_support( 'title-tag' );

        // Custom logo
        add_theme_support( 'custom-logo', [
                'header-text' => ['site-title', 'site-description' ],
                'height'      => 100,
                'width'       => 400,
                'flex-height' => true,
                'flex-width'  => true,
            ]
        );

        // Custom background
        add_theme_support( 'custom-background', [
            'default-color' => 'rgb(255, 255, 255)',
        ]);

        // Selective customizer preview refresh
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Automatic feed links
        add_theme_support( 'automatic-feed-links' );

        // Post thumbnail
        add_theme_support( 'post-thumbnails' );

        // Block styles
        add_theme_support( 'wp-block-styles' );

        // Align wide & full width alignment for image block
        add_theme_support( 'align-wide' );

        // Max width sucks
        if( ! isset($content_width) ) {
            $content_width = 1240;
        }
    }
 };