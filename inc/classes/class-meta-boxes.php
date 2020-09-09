<?php 
/**
 * Class Meta Boxes
 * 
 * @package Headlab
 */

 namespace HEADLAB_THEME\Inc;

// Use Singleton
use HEADLAB_THEME\Inc\Traits\Singleton;

 class Meta_Boxes {
    use Singleton;

     protected function __construct() {
         $this->init();
     }

     protected function init() {
          
        //Init
        add_action('add_meta_boxes', [$this, 'hdlb_add_custom_box']);
     }

     public function hdlb_add_custom_box($post) {
        $screens = ['post'];
        foreach ($screens as $screen) {
            add_meta_box(
                'featured-post',           // Unique ID
                __('Featured post', 'headlab'),  // Box title
                [$this, 'featured_post_html'],  // Content callback, must be of type callable
                $screen                   // Post type
            );
        }
     }

     public function featured_post_html($post) {
        $value = get_post_meta($post->ID, '_featured_post', true);
        ?>
        <label for="hdlb_field">
            <?php esc_html_e( 'Is this a featured post?', 'headlab' ); ?>
        </label>
        <input type="checkbox" name="hdlb_field" id="hdlb-field" value="1" <?php checked( $value, 1 ); ?> /> <small>Yes/No</small>
        <?php
     }
 }