<?php
if (empty($add_button) || !is_array($add_button)) {
    return;
}
?>
<div class="group-button flex-justify-<?php echo esc_attr(!empty($button_alignment) ? $button_alignment : 'start'); ?>">
    <?php foreach ($add_button as $button): ?>
        <?php if (!empty($button['link']['url']) && !empty($button['link']['title'])): ?>
            <?php
            $button_color = !empty($button['color']) ? $button['color'] : 'default';
            $button_style = !empty($button['style']) ? $button['style'] : 'filled';
            ?>
            <a class="button button-<?php echo esc_attr($button_color); ?> button-<?php echo esc_attr($button_style); ?>"
                href="<?php echo esc_url($button['link']['url']); ?>"
                target="<?php echo esc_attr($button['link']['target'] ?: '_self'); ?>"
                title="<?php echo esc_attr($button['link']['title']); ?>">
                <?php echo esc_html($button['link']['title']); ?>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
