<?php
if (betterbase_block_preview($block)) {
    return;
}
extract(betterbase_block_settings($block));

$title = get_field('title');
$video_type = get_field('video_type');
$embed_video = get_field('embed_video');
$upload_video = get_field('upload_video');
$video_thumbnail = get_field('video_thumbnail');

if (!empty($embed_video) || !empty($upload_video)): ?>
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
                    <?php if ($video_type === 'embed' && !empty($embed_video)): ?>
                        <div class="responsive-embed">
                            <?php
                            echo wp_kses($embed_video, array(
                                'iframe' => array(
                                    'src'             => true,
                                    'width'           => true,
                                    'height'          => true,
                                    'frameborder'     => true,
                                    'allow'           => true,
                                    'allowfullscreen' => true,
                                    'loading'         => true,
                                    'title'           => true,
                                    'referrerpolicy'  => true,
                                    'style'           => true,
                                    'class'           => true,
                                ),
                            )); ?>
                        </div>
                    <?php elseif ($video_type === 'upload' && !empty($upload_video)): ?>
                        <div class="video-wrapper is-paused">
                            <div class="toggle-pause-play">
                                <?php betterbase_include_asset('icon-play.svg'); ?>
                            </div>
                            <video width="100%" playsinline poster="<?php echo esc_url($video_thumbnail['sizes']['large'] ?? ''); ?>">
                                <source src="<?php echo esc_url($upload_video['url']); ?>" type="video/mp4">
                            </video>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php else: betterbase_block_empty(); endif; ?>
