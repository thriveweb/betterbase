<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/block-post-header.jpg" class="acf_pre" style="width: 100%;">
<?php else:
    $classes = 'block-post-header';
    $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
    $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
    $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
    $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
    $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '40');
    $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '40');

    $post_ID = get_the_ID();
    $post_title = get_the_title($post_ID);
    $post_categories = get_the_category($post_ID);
    $post_date = get_the_date('d F Y', $post_ID); ?>

    <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
        <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?>">
                <div class="wysiwyg-content <?php echo get_text_colour($background); ?>">
                    <?php if (!empty($post_categories)): ?>
                        <div class="group-tags">
                            <?php foreach ($post_categories as $term): ?>
                                <span><?php echo $term->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <h1 class="h2"><?php echo ($post_title ? $post_title : 'Add blog title here...'); ?></h1>
                    <?php if (!empty($post_date)): ?>
                        <p><?php echo $post_date; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>