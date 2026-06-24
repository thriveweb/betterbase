<?php
$post_permalink = get_the_permalink($post_ID);
$post_title = get_the_title($post_ID);
$post_image = get_the_post_thumbnail_url($post_ID, 'large');
$post_categories = get_the_category($post_ID); ?>

<a class="entry-post" href="<?php echo esc_url($post_permalink); ?>" title="<?php echo esc_attr($post_title); ?>">
    <div class="inner-entry-image image-landscape">
        <?php if (!empty($post_image)): ?>
            <img src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr($post_title); ?>">
        <?php endif; ?>
    </div>
    <div class="inner-entry-content">
        <?php if (!empty($post_categories)): ?>
            <div class="group-tags">
                <span><?php echo $post_categories[0]->name; ?></span>
            </div>
        <?php endif; ?>
        <h5><?php echo $post_title; ?></h5>
    </div>
</a>
