<?php 
/**
 * Header navigation template
 * 
 * @package Headlab
*/
?>

<nav class="navbar navbar-expand fixed-top">

	<?php if(has_custom_logo()) : the_custom_logo(); else : ?>
		<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
	<?php endif; ?>

  	<ul class="navbar-nav ml-auto">
		<li class="nav-item active">
			<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Link</a>
		</li>
    </ul>
</nav>