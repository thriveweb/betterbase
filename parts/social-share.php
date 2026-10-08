<?php
$share_url = get_permalink();
$share_title = get_the_title();
$share_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');

if (empty($share_url)) {
    return;
}
?>
<div class="social-icons share-icons flex-layout flex-align-center">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode($share_url); ?>&quote=<?php echo rawurlencode($share_title); ?>" target="_blank" rel="noopener noreferrer" title="Share on Facebook">
        <?php betterbase_include_asset('icon-facebook.svg'); ?>
    </a>
    <a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode($share_url); ?>&text=<?php echo rawurlencode($share_title); ?>" target="_blank" rel="noopener noreferrer" title="Share on Twitter">
        <?php betterbase_include_asset('icon-twitter.svg'); ?>
    </a>
    <?php if (!empty($share_image)): ?>
        <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo rawurlencode($share_url); ?>&media=<?php echo rawurlencode($share_image); ?>&description=<?php echo rawurlencode($share_title); ?>" target="_blank" rel="noopener noreferrer" title="Share on Pinterest">
            <?php betterbase_include_asset('icon-pinterest.svg'); ?>
        </a>
    <?php endif; ?>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo rawurlencode($share_url); ?>" target="_blank" rel="noopener noreferrer" title="Share on LinkedIn">
        <?php betterbase_include_asset('icon-linkedin.svg'); ?>
    </a>
    <div class="copy-to-clipboard" data-url="<?php echo esc_url($share_url); ?>">
        <span class="tooltip">Copy to clipboard</span>
        <?php betterbase_include_asset('icon-link.svg'); ?>
    </div>
</div>
