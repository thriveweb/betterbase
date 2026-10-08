<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$post_ID = get_the_ID();
$post_prev = get_previous_post();
$post_next = get_next_post();
?>
<div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
    <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
        <div class="container-<?php echo esc_attr($container); ?>">
            <div class="post-pagination flex-layout flex-align-center flex-justify-between flex-gap <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                <div class="prev-post">
                    <?php if (!empty($post_prev)): ?>
                        <a href="<?php echo esc_url(get_permalink($post_prev->ID)); ?>" title="Previous post">
                            <?php betterbase_include_asset('icon-arrow-left.svg'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php include get_template_directory() . '/parts/social-share.php'; ?>
                <div class="next-post">
                    <?php if (!empty($post_next)): ?>
                        <a href="<?php echo esc_url(get_permalink($post_next->ID)); ?>" title="Next post">
                            <?php betterbase_include_asset('icon-arrow-right.svg'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
