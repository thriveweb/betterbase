<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$add_logos = get_field('add_logos');

if (!empty($add_logos)) {
    $original = $add_logos;
    $slide_count = count($original);
    $min_slides = 12;

    if ($slide_count > 0 && $slide_count < $min_slides) {
        $multi = (int) ceil($min_slides / $slide_count);
        $target = $multi * $slide_count;
        $i = 0;

        while (count($add_logos) < $target) {
            $add_logos[] = $original[$i % $slide_count];
            $i++;
        }
    }
}

if (!empty($add_logos)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <div class="container-<?php echo esc_attr($container); ?>">
                <div class="carousel-logo-slider swiper <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                    <div class="swiper-wrapper">
                        <?php foreach ($add_logos as $logo): ?>
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url($logo['sizes']['medium'] ?? $logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: ($logo['title'] ?? '')); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>
