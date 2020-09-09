<?php 
/**
 * Archive post card template
 * 
 * @package Headlab
 */
?>

<div class="card border-0" style="height: 100%;">
    <?php the_post_thumbnail('medium', ['class' => 'card-img-top blog-thumbnail']); ?>
    <div class="card-body d-flex flex-column">
        <?php the_title('<h5 class="card-title mb-3" style="line-height: 1.4">', '</h5>'); ?>
        <p class="mt-auto mb-0">
            <a class=stretched-link href="<?php the_permalink(); ?>">
                Read more
            </a>
        </p>
    </div>
</div>