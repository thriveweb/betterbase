<?php if (isset($block['data']['preview_image']) && $block['data']['preview_image']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/<?php echo $block['data']['preview_image']; ?>" style="width: 100%; height: auto; display: block;">
<?php else:
    $block_name = 'block-video';
    $block_classes = ['betterbase-theme', $block_name, $block['className'] ?? null];
    $block_anchor = $block['anchor'] ?? '';
    $block_css = $block['css'] ?? '';
    $padding_top = $block['settings_padding_top'] ?? '80';
    $padding_bottom = $block['settings_padding_bottom'] ?? '80';
    $background_colour = $block['settings_background_colour'] ?? 'none';
    $container = $block['settings_container'] ?? 'sm';
    $setting_classes = ['block-setting-padding', 'block-setting-background-color'];
    $setting_styles = ['--block-background-color: var(--'.$background_colour.')', '--block-padding-top: '.$padding_top.'px', '--block-padding-bottom: '.$padding_bottom.'px'];

    $title = get_field('block_title');
    $video_type = get_field('block_video_type');
    $embed_video = get_field('block_embed_video');
    $upload_video = get_field('block_upload_video');
    $video_thumbnail = get_field('block_video_thumbnail');

    if (!empty($embed_video) || !empty($upload_video)): ?>
        <div class="<?php echo implode(' ', array_filter($block_classes)); ?>" <?php echo ($block_anchor ? 'id="'.esc_attr($block_anchor).'"' : ''); ?> <?php echo ($block_css ? 'style="'.esc_attr($block_css).'"' : ''); ?>>
            <div class="<?php echo implode(' ', $setting_classes); ?>" style="<?php echo implode('; ', $setting_styles); ?>">
                <?php if (!empty($title)): ?>
                    <div class="container-sm">
                        <div class="inner-block-head">
                            <div class="wysiwyg-content text-center <?php echo get_text_colour($background_colour); ?>">
                                <h3><?php echo $title; ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="container-<?php echo $container; ?>">
                    <?php if ($video_type === 'embed' && !empty($embed_video)): ?>
                        <div class="responsive-embed">
                            <?php echo $embed_video; ?>
                        </div>
                    <?php elseif ($video_type === 'upload' && !empty($upload_video)): ?>
                        <div class="video-wrapper is-paused">
                            <div class="toggle-pause-play">
                                <?php include_asset('icon-play.svg'); ?>
                            </div>
                            <video width="100%" playsinline poster="<?php echo ($video_thumbnail ? $video_thumbnail['sizes']['large'] : ''); ?>">
                                <source src="<?php echo $upload_video['url']; ?>" type="video/mp4">
                            </video>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: get_empty_block_message(); endif; ?>
<?php endif; ?>