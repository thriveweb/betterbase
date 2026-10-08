<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$title = get_field('title');
$add_images = get_field('add_images');

if (!empty($add_images)) {
    $min_slides = 12;
    $slide_count = count($add_images);

    if ($slide_count > 0 && $slide_count < $min_slides) {
        $multi = (int) ceil($min_slides / $slide_count);
        $target = $multi * $slide_count;
        $i = 0;

        while (count($add_images) < $target) {
            $add_images[] = $add_images[$i % $slide_count];
            $i++;
        }
    }
}

if (!empty($add_images)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <?php if (!empty($title)): ?>
                <div class="inner-block-head">
                    <div class="container-sm">
                        <div class="wysiwyg-content text-align-center <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                            <h3 class="h2"><?php echo esc_html($title); ?></h3>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="inner-block-main">
                <div class="container-<?php echo esc_attr($container); ?>">
                    <div class="carousel-gallery swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($add_images as $image): ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-footer <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                            <div class="swiper-pagination"></div>
                            <div class="swiper-navigation">
                                <div class="swiper-nav-prev">
                                    <?php betterbase_include_asset('icon-arrow-left.svg'); ?>
                                </div>
                                <div class="swiper-nav-next">
                                    <?php betterbase_include_asset('icon-arrow-right.svg'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>
