<?php if (!empty($add_social_media) && is_array($add_social_media)): ?>
    <div class="social-icons flex-layout flex-align-center">
        <?php foreach ($add_social_media as $media): ?>
            <?php
            if (empty($media['url']) || empty($media['platform']['value'])) {
                continue;
            }
            $platform_label = $media['platform']['label'] ?? $media['platform']['value'];
            $platform_icon = sanitize_file_name($media['platform']['value']);
            ?>
            <a href="<?php echo esc_url($media['url']); ?>" target="_blank" rel="noopener noreferrer" title="<?php echo esc_attr('Find us on ' . $platform_label); ?>">
                <?php betterbase_include_asset('icon-' . $platform_icon . '.svg'); ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
