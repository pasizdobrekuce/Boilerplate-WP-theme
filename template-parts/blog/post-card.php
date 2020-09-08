<?php 
/**
 * Archive post card template
 * 
 * @package Headlab
 */
?>

<div class="card border-0 shadow" style="height: 100%;">
    <a href="<?php the_permalink() ?>">
    <?php the_post_thumbnail('medium', ['class' => 'card-img-top blog-thumbnail']); ?>
    </a>
    <div class="card-body d-flex flex-column">
        <?php the_title('<h5 class="card-title">', '</h5>'); ?>
        <p class="mt-auto mb-0">
            <a href="<?php the_permalink(); ?>">
                Read more
            </a>
        </p>
    </div>

    <?php $tags = wp_get_post_tags(get_the_ID());
    ?>

    <?php if($tags) : ?>
    <div class="card-footer bg-white">
        <p class="mb-0">

        <?php foreach($tags as $tag) : ?>
        <a class="text-muted mr-1" href="<?php echo get_term_link($tag->term_id, 'post_tag'); ?>">
            <small>#<?php echo strtolower($tag->name); ?></small>
        </a>
        <?php endforeach; ?>
        </p>
    </div>
        <?php endif; ?>
</div>