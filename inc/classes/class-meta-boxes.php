<?php 
/**
 * Class Meta Boxes
 * 
 * @package Headlab
 */

namespace HEADLAB_THEME\Inc;

// Use Singleton
use HEADLAB_THEME\Inc\Traits\Singleton;

require_once('includes/class-metabox-constructor.php');

 class Meta_Boxes {
    use Singleton;

    protected $mtb;

    protected function __construct() {

        // Init custom fields on home.php template
        $this->add_mtb_to_home_template();
    }

    /**
     * Add metaboxes to home template
     * 
     * @return void
     */
    private function add_mtb_to_home_template() {

        if($this->get_template_filename() === 'home.php') {

            $metabox = new Metabox_Constructor([
                'id' => 'home_template_custom_fields',
                'title' => __('Custom fields', 'headlab'),
                'screen' => 'page'
            ]);
            
            $metabox_repeater_block15_fields[] = $metabox->addImage(array(
                'id' => 'metabox_repeater_image_field',
                'label' => 'Block Image'
            ), true);
            
            $metabox_repeater_block15_fields[] = $metabox->addText(array(
                'id' => 'metabox_repeater_text_field',
                'label' => 'Block Title'
            ), true);
            
            $metabox_repeater_block15_fields[] = $metabox->addTextArea(array(
                'id' => 'metabox_repeater_textarea_field',
                'label' => 'Block Description'
            ), true);
            
            $metabox->addRepeaterBlock(array(
                'id' => 'metabox_repeater_block15',
                'label' => 'Repeater Block Field',
                'desc' => 'Repeater Description.',
                'fields' => $metabox_repeater_block15_fields,
                'single_label' => 'Block'
            ));
            
            $metabox_repeater_block15_fields[] = $metabox->addWysiwyg(array(
                'id' => 'metabox_wysiwyg_field',
                'label' => 'WYSIWYG Field',
                'desc' => 'WYSIWIG Description.'
            ));
        }
    }

    private function get_template_filename() {

        $post_id = $_REQUEST['post'] ?? null;
        
        $pageTemplate = basename(get_post_meta($post_id, '_wp_page_template', true));

        return $pageTemplate; // {template_name}.php
    }
 }