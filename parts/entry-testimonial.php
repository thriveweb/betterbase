<?php
if (empty($testimonial_ID)) {
    return;
}

$testimonial_title = get_the_title($testimonial_ID);
$testimonial_rating = get_field('rating', $testimonial_ID);
$testimonial_quote = get_field('quote', $testimonial_ID);
$testimonial_quote_count = explode(' ', (string) $testimonial_quote);
$testimonial_byline = get_field('byline', $testimonial_ID);
?>

<div class="entry-testimonial">
    <?php if (!empty($testimonial_rating)): ?>
        <div class="inner-entry-rating is-<?php echo esc_attr($testimonial_rating); ?>-star">
            <?php betterbase_include_asset('el-star-rating.svg'); ?>
        </div>
    <?php endif; ?>
    <div class="inner-entry-quote text-align-center <?php echo (count($testimonial_quote_count) > 40 ? 'has-read-more' : ''); ?>">
        <h5><?php echo esc_html($testimonial_quote); ?></h5>
        <?php if (count($testimonial_quote_count) > 40): ?>
            <a class="toggle-read-more" data-text="Read less">Read more</a>
        <?php endif; ?>
    </div>
    <div class="inner-entry-author text-align-center">
        <p><?php echo esc_html($testimonial_title); ?></p>
        <?php if (!empty($testimonial_byline)): ?>
            <span class="h6"><?php echo esc_html($testimonial_byline); ?></span>
        <?php endif; ?>
    </div>
</div>
