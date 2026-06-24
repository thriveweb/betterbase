<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-image-gallery';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_color = $block['settings_background_color'] ?? 'none';
    $container = $block['settings_container'] ?? 'xl';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_color.')'];

    $add_images = get_field('block_add_images');

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
        <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
            <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
                <div class="container-<?php echo $container; ?>">
                    <div class="swiper-carousel-wrap">
                        <div class="carousel-gallery swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($add_images as $image): ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-footer <?php echo get_text_colour($background_color); ?>">
                                <div class="swiper-pagination"></div>
                                <div class="swiper-navigation">
                                    <div class="swiper-nav-prev">
                                        <?php include_asset('icon-arrow-left.svg'); ?>
                                    </div>
                                    <div class="swiper-nav-next">
                                        <?php include_asset('icon-arrow-right.svg'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>