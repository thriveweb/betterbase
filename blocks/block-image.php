<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/block-image.jpg" class="acf_pre" style="width: 100%;">
<?php else:
    $classes = 'block-image';
    $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
    $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
    $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'cream');
    $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
    $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '40');
    $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '40');

    $select_orientation = get_field('block_select_orientation');
    $image = get_field('block_image');

    if (!empty($image)): ?>
        <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
            <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
                <div class="container-<?php echo $container; ?>">
                    <img class="image-<?php echo ($select_orientation ? $select_orientation : 'landscape'); ?>" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                </div>
            </div>
        </div>
    <?php else: ?><p style="text-align: center;">No preview available.</p><?php endif; ?>
<?php endif; ?>