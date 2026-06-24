<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-hero-banner';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_colour = $block['settings_background_colour'] ?? 'none';
    $container = $block['settings_container'] ?? 'md';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px', '--block-background-color: var(--'.$background_colour.')'];

    $title = get_field('block_title');
    $description = get_field('block_description');
    $add_button = get_field('block_add_button');
    $background_media = get_field('block_background_media');
    $background_image = get_field('block_background_image');
    $background_video = get_field('block_background_video');
    $video_thumbnail = get_field('block_video_thumbnail');

    if (!empty($background_image) || !empty($background_video)): ?>
       <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
            <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
                <div class="container-<?php echo $container; ?>">
                    <div class="wysiwyg-content text-center text-white">
                        <?php if (!empty($title)): ?>
                            <h1><?php echo $title; ?></h1>
                        <?php endif; ?>
                        <?php if (!empty($description)): ?>
                            <h5><?php echo $description; ?></h5>
                        <?php endif; ?>
                        <?php $button_alignment = 'center';
                        include(get_template_directory().'/parts/group-button.php'); ?>
                    </div>
                </div>
                <?php if ($background_media === 'image' && !empty($background_image)): ?>
                    <div class="background-image has-overlay" style="background-image: url(<?php echo esc_url($background_image['sizes']['2048x2048']); ?>);"></div>
                <?php elseif ($background_media === 'video' && !empty($background_video) && !empty($video_thumbnail)): ?>
                    <div class="background-video has-overlay">
                        <video src="<?php echo esc_url($background_video['url']); ?>" poster="<?php echo esc_url($video_thumbnail['sizes']['2048x2048']); ?>" autoplay muted loop playsinline></video>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>