<?php
/**
 * Main template file
 * 
 * @package Headlab
 */
?>

<?php get_header(); ?>

    

        <div class="container">
            <div class="row">

            <?php if ( have_posts() ) : ?>
                
                <?php if(is_home() && ! is_front_page()) : ?>
                    <header class="col-12 page-header py-5 text-center">
                        <h1 class="page-title text-uppercase">
                            <?php single_post_title(); ?>
                        </h1><!-- /.page-title -->
                    </header>
                <?php endif; ?>
            
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="col-xl-4 mb-5">
                        <?php get_template_part( 'template-parts/blog/post', 'card' ); ?>
                    </div>
                <?php endwhile; ?>
            
            <?php else: ?>
                <div class="blobs d-flex justify-content-center align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 mx-auto text-center">
                            <p>
                            <?php esc_html_e( 'Currently no posts are found. We messed up something, or we\'ve been super lazy. Please try again later.', 'headlab' ); ?>
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            </div>
        </div>

<?php get_footer(); ?>


