<?php 
/**
 * Class Tags
 * 
 * @package Headlab
 */

 namespace HEADLAB_THEME\Inc;

// Use Singleton
use HEADLAB_THEME\Inc\Traits\Singleton;

 class Tags {
    use Singleton;

     protected function __construct() {
         $this->init();
     }

     protected function init() {
          //init
          add_filter('get_the_archive_title', [$this, 'strip_tag_prefix']);
     }

     public function strip_tag_prefix($title) {
         // Strip tag archive title prefix
        if ( is_tag() ) {    
            $title = single_term_title( '', false );    
        }
        return $title; 
     }
 }