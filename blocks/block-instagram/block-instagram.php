<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$add_social_media = get_field('add_social_media', 'options');
$instagram = betterbase_get_instagram($add_social_media);
?>
<div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
    <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
        <div class="inner-block-head">
            <div class="container-sm">
                <div class="wysiwyg-content text-align-center <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                    <h3 class="h2">
                        Follow us
                        <?php if (!empty($instagram['url']) && !empty($instagram['username'])): ?>
                            <a href="<?php echo esc_url($instagram['url']); ?>" target="_blank" title="Follow us on Instagram">@<?php echo esc_html($instagram['username']); ?></a>
                        <?php endif; ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="inner-block-main">
            <div class="container-<?php echo esc_attr($container); ?>">
                <div class="block-empty">
                    <p>Insert Instagram shortcode here.</p>
                </div>
                <?php /* Replace with shortcode on production, e.g. echo do_shortcode('[instagram-feed]'); */ ?>
            </div>
        </div>
    </div>
</div>

</div>
