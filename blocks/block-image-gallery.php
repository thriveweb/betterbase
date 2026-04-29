<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/block-image-gallery.jpg" class="acf_pre" style="width: 100%;">
<?php else:
    $classes = 'block-image-gallery';
    $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
    $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
    $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
    $container = (isset($block['settings_container']) ? $block['settings_container'] : 'xl');
    $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
    $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

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
        <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
            <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
                <div class="container-<?php echo $container; ?>">
                    <div class="swiper-carousel-wrap">
                        <div class="carousel-gallery swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($add_images as $image): ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-footer <?php echo get_text_colour($background); ?>">
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
    <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>