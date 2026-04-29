<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/block-video.jpg" class="acf_pre" style="width: 100%;">
<?php else:
    $classes = 'block-video';
    $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
    $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
    $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
    $container = (isset($block['settings_container']) ? $block['settings_container'] : 'sm');
    $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
    $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

    $title = get_field('block_title');
    $video_type = get_field('block_video_type');
    $embed_video = get_field('block_embed_video');
    $upload_video = get_field('block_upload_video');
    $video_thumbnail = get_field('block_video_thumbnail');

    if (!empty($embed_video) || !empty($upload_video)): ?>
        <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
            <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
                <?php if (!empty($title)): ?>
                    <div class="container-sm">
                        <div class="inner-block-head">
                            <div class="wysiwyg-content text-center <?php echo get_text_colour($background); ?>">
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
    <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>