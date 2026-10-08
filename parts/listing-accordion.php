<?php
if (empty($add_accordion) || !is_array($add_accordion)) {
    return;
}
?>
<div class="listing-accordion"<?php echo !empty($enable_schema) ? ' itemscope itemtype="https://schema.org/FAQPage"' : ''; ?>>
    <?php foreach ($add_accordion as $index => $accordion): ?>
        <?php if (empty($accordion['title'])) { continue; } ?>
        <?php $panel_id = 'accordion-panel-' . (int) $index; ?>
        <div class="entry-accordion"<?php echo !empty($enable_schema) ? ' itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"' : ''; ?>>
            <div class="inner-entry-title trigger-accordion" role="button" tabindex="0" aria-expanded="false" aria-controls="<?php echo esc_attr($panel_id); ?>"<?php echo !empty($enable_schema) ? ' itemprop="name"' : ''; ?>>
                <h5><?php echo esc_html($accordion['title']); ?></h5>
                <?php betterbase_include_asset('icon-plus.svg'); ?>
            </div>
            <div id="<?php echo esc_attr($panel_id); ?>" class="inner-entry-content" role="region" aria-hidden="true"<?php echo !empty($enable_schema) ? ' itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer"' : ''; ?>>
                <div class="wysiwyg-content"<?php echo !empty($enable_schema) ? ' itemprop="text"' : ''; ?>>
                    <?php echo wp_kses_post($accordion['content'] ?? ''); ?>
                    <?php
                    $add_button = $accordion['add_button'] ?? null;
                    $button_alignment = $accordion['button_alignment'] ?? '';
                    include get_template_directory() . '/parts/group-button.php';
                    ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
