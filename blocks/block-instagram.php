<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/block-instagram.jpg" class="acf_pre" style="width: 100%;">
<?php else:
    $classes = 'block-instagram';
    $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
    $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
    $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
    $container = (isset($block['settings_container']) ? $block['settings_container'] : 'xl');
    $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '80');
    $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '80');

    $add_social_media = get_field('add_social_media', 'options');
    $instagram = get_instagram($add_social_media); ?>

    <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
        <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-sm">
                <div class="inner-block-head">
                    <div class="wysiwyg-content text-center <?php echo get_text_colour($background); ?>">
                        <h4>
                            Follow us 
                            <?php if (!empty($instagram['url']) && !empty($instagram['username'])): ?>
                                <a href="<?php echo $instagram['url']; ?>" target="_blank" title="Follow us on Instagram">@<?php echo $instagram['username']; ?></a>
                            <?php endif; ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="container-<?php echo $container; ?>">
                <p class="text-center <?php echo get_text_colour($background); ?>">[instagram-feed]</p> <?php /* Replace with shortcode */ ?>
            </div>
        </div>
    </div>

<?php endif; ?>