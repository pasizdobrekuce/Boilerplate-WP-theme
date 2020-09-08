<?php 
/**
 * Taxonomy images
 * 
 * @package Headlab
 * 
 *  Call on front end
 * 
 * $image_id = get_term_meta( 13, 'taxonomy-image-id', true );
 * echo wp_get_attachment_image( $image_id, 'thumbnail', '', ['class' => 'tag-image'] );
 */

namespace HEADLAB_THEME\Inc;

// Use Singleton
use HEADLAB_THEME\Inc\Traits\Singleton;

class TaxonomyImages {
    use Singleton;

	protected function __construct() {
		$this->init();
	}
    
    /*
      * Initialize the class and start calling our hooks and filters
    */
    protected function init() {

		/**
		 * Slugs of taxonomies on which to add image
		 * Eg. for post tag taxonomy $slug = 'post_tag'
		 */
		$taxonomy_slugs = [
			'category',
			'post_tag'
		];

		// Hook to taxonomies
		foreach($taxonomy_slugs as $slug) {
			add_action( $slug . '_add_form_fields', [$this, 'add_taxonomy_image'], 10, 2 );
			add_action( 'created_' . $slug, [$this, 'save_taxonomy_image'], 10, 2 );
			add_action( $slug . '_edit_form_fields', [$this, 'update_taxonomy_image'], 10, 2 );
			add_action( 'edited_' . $slug, [$this, 'updated_taxonomy_image'], 10, 2 );
		}

		// Enqueue scripts
		add_action( 'admin_enqueue_scripts', [$this, 'load_media'] );

		// Hook scripts
		add_action( 'admin_footer', [$this, 'add_script'] );
    }

	// Enqueue media
    public function load_media() {
    	wp_enqueue_media();
    }
    
    /*
      * Add a form field in the new taxonomy page
    */
    public function add_taxonomy_image ( $taxonomy ) { ?>
		<div class="form-field term-group">
			<label for="taxonomy-image-id"><?php _e('Image'); ?></label>
			<input type="hidden" id="taxonomy-image-id" name="taxonomy-image-id" class="custom_media_url" value="">
			<div id="taxonomy-image-wrapper"></div>
			<p>
			<input type="button" class="button button-secondary hdlb_tax_media_button" id="hdlb_tax_media_button" name="hdlb_tax_media_button" value="<?php _e( 'Add Image' ); ?>" />
			<input type="button" class="button button-secondary hdlb_tax_media_remove" id="hdlb_tax_media_remove" name="hdlb_tax_media_remove" value="<?php _e( 'Remove Image' ); ?>" />
			</p>
		</div>
    <?php
    }
    
    /*
      * Save the form field
    */
    public function save_taxonomy_image ( $term_id, $tt_id ) {
		if( isset( $_POST['taxonomy-image-id'] ) && '' !== $_POST['taxonomy-image-id'] ){
			$image = $_POST['taxonomy-image-id'];
			add_term_meta( $term_id, 'taxonomy-image-id', $image, true );
		}
    }
    
    /*
      * Edit the form field
    */
    public function update_taxonomy_image ( $term, $taxonomy ) { ?>
		<tr class="form-field term-group-wrap">
			<th scope="row">
			<label for="taxonomy-image-id"><?php _e( 'Image' ); ?></label>
			</th>
			<td>
			<?php $image_id = get_term_meta ( $term->term_id, 'taxonomy-image-id', true ); ?>
			<input type="hidden" id="taxonomy-image-id" name="taxonomy-image-id" value="<?php echo $image_id; ?>">
			<div id="taxonomy-image-wrapper">
				<?php if ( $image_id ) { ?>
				<?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
				<?php } ?>
			</div>
			<p>
				<input type="button" class="button button-secondary hdlb_tax_media_button" id="hdlb_tax_media_button" name="hdlb_tax_media_button" value="<?php _e( 'Add Image' ); ?>" />
				<input type="button" class="button button-secondary hdlb_tax_media_remove" id="hdlb_tax_media_remove" name="hdlb_tax_media_remove" value="<?php _e( 'Remove Image' ); ?>" />
			</p>
			</td>
		</tr>
    <?php
    }

    /*
    * Update the form field value
    * @since 1.0.0
    */
    public function updated_taxonomy_image ( $term_id, $tt_id ) {
		if( isset( $_POST['taxonomy-image-id'] ) && '' !== $_POST['taxonomy-image-id'] ){
			$image = $_POST['taxonomy-image-id'];
			update_term_meta ( $term_id, 'taxonomy-image-id', $image );
		} else {
			update_term_meta ( $term_id, 'taxonomy-image-id', '' );
		}
    }

    /*
    * Add script
    * @since 1.0.0
    */
    public function add_script() { ?>
		<script>
			jQuery(document).ready( function($) {
			function hdlb_media_upload(button_class) {
				var _custom_media = true,
				_orig_send_attachment = wp.media.editor.send.attachment;
				$('body').on('click', button_class, function(e) {
				var button_id = '#'+$(this).attr('id');
				var send_attachment_bkp = wp.media.editor.send.attachment;
				var button = $(button_id);
				_custom_media = true;
				wp.media.editor.send.attachment = function(props, attachment){
					if ( _custom_media ) {
					$('#taxonomy-image-id').val(attachment.id);
					$('#taxonomy-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
					$('#taxonomy-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
					} else {
					return _orig_send_attachment.apply( button_id, [props, attachment] );
					}
					}
				wp.media.editor.open(button);
				return false;
			});
			}
			hdlb_media_upload('.hdlb_tax_media_button.button'); 
			$('body').on('click','.hdlb_tax_media_remove',function(){
			$('#taxonomy-image-id').val('');
			$('#taxonomy-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
			});
			// Thanks: http://stackoverflow.com/questions/152819create-category-ajax-response
			$(document).ajaxComplete(function(event, xhr, settings) {
			var queryStringArr = settings.data.split('&');
			if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
				var xml = xhr.responseXML;
				$response = $(xml).find('term_id').text();
				if($response!=""){
				// Clear the thumb image
				$('#taxonomy-image-wrapper').html('');
				}
			}
			});
		});
		</script>
    <?php }
}