<?php 
/**
 * Header navigation template
 * 
 * @package Headlab
*/
?>

<?php 
// Get primary menu
$menus = \HEADLAB_THEME\Inc\MENUS::get_instance();
$primary_menu = $menus->get_menu('headlab-primary-menu');
?>

<nav class="navbar navbar-expand fixed-top">

	<?php if(has_custom_logo()) : the_custom_logo(); else : ?>
		<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
	<?php endif; ?>

  	<?php if( ! empty($primary_menu) && is_array($primary_menu)) : ?>
	<div class="ml-auto">
		
		<?php foreach($primary_menu as $menu_item) : 
			$title = esc_html( $menu_item->title );
			$url = esc_url( $menu_item->url );
			$active_class = get_the_id() === intval($menu_item->object_id) ? 'class="active"' : ''; 
 		?>

		 <a href="<?php echo $url; ?>" <?php echo $active_class; ?>><?php echo $title; ?></a>

		<?php endforeach; ?>
		
    </div>
	<?php endif; ?>
</nav>