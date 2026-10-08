<?php
if (empty($search_ID)) {
    return;
}

$search_query = $search_query ?? get_search_query();
$search_permalink = get_the_permalink($search_ID);
$search_title = get_the_title($search_ID);
$search_excerpt = betterbase_get_search_excerpt($search_ID, $search_query);
?>

<div class="entry-search">
    <div class="inner-entry-content">
        <h5>
            <a href="<?php echo esc_url($search_permalink); ?>" title="<?php echo esc_attr($search_title); ?>"><?php echo esc_html($search_title); ?></a>
        </h5>
        <?php if (!empty($search_excerpt)): ?>
            <p><?php echo wp_kses($search_excerpt, array('mark' => array())); ?></p>
        <?php endif; ?>
    </div>
</div>
