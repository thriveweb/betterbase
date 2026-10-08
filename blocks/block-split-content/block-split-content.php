<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$left_column = get_field('left_column') ?: array();
$left_type = $left_column['column_type'] ?? '';
$left_content = $left_column['content'] ?? '';
$left_image = $left_column['image'] ?? null;
$left_gallery = $left_column['gallery'] ?? null;
$left_button_alignment = $left_column['button_group']['button_alignment'] ?? '';
$left_add_button = $left_column['button_group']['add_button'] ?? null;

$right_column = get_field('right_column') ?: array();
$right_type = $right_column['column_type'] ?? '';
$right_content = $right_column['content'] ?? '';
$right_image = $right_column['image'] ?? null;
$right_gallery = $right_column['gallery'] ?? null;
$right_button_alignment = $right_column['button_group']['button_alignment'] ?? '';
$right_add_button = $right_column['button_group']['add_button'] ?? null;

if (!empty($left_column) && !empty($right_column)): ?>
    <div class="<?php echo esc_attr(implode(' ', array_filter($block_classes))); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
        <div class="<?php echo esc_attr(implode(' ', $setting_classes)); ?>" style="<?php echo esc_attr(implode('; ', $setting_styles)); ?>">
            <div class="container-<?php echo esc_attr($container); ?>">
                <div class="grid-col-2 flex-align-center">
                    <div class="col-1 col-<?php echo esc_attr($left_type); ?>">
                        <?php if ($left_type === 'content' && !empty($left_content)): ?>
                            <div class="wysiwyg-content <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                                <?php echo wp_kses_post($left_content); ?>
                                <?php
                                $add_button = $left_add_button;
                                $button_alignment = $left_button_alignment;
                                include(get_template_directory().'/parts/group-button.php'); ?>
                            </div>
                        <?php elseif ($left_type === 'image' && !empty($left_image)): ?>
                            <img class="image-landscape" src="<?php echo esc_url($left_image['sizes']['large']); ?>" alt="<?php echo esc_attr($left_image['alt']); ?>">
                        <?php elseif ($left_type === 'gallery' && !empty($left_gallery)): ?>
                            <div class="carousel-split-gallery swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($left_gallery as $image): ?>
                                        <div class="swiper-slide">
                                            <img class="image-landscape" src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-2 col-<?php echo esc_attr($right_type); ?>">
                        <?php if ($right_type === 'content' && !empty($right_content)): ?>
                            <div class="wysiwyg-content <?php echo esc_attr(betterbase_get_text_color($background_color)); ?>">
                                <?php echo wp_kses_post($right_content); ?>
                                <?php
                                $add_button = $right_add_button;
                                $button_alignment = $right_button_alignment;
                                include(get_template_directory().'/parts/group-button.php'); ?>
                            </div>
                        <?php elseif ($right_type === 'image' && !empty($right_image)): ?>
                            <img class="image-landscape" src="<?php echo esc_url($right_image['sizes']['large']); ?>" alt="<?php echo esc_attr($right_image['alt']); ?>">
                        <?php elseif ($right_type === 'gallery' && !empty($right_gallery)): ?>
                            <div class="carousel-split-gallery swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($right_gallery as $image): ?>
                                        <div class="swiper-slide">
                                            <img class="image-landscape" src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>
