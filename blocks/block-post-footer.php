<?php if (isset($block['data']['has_preview']) && $block['data']['has_preview']): ?>
    <img src="<?php echo get_template_directory_uri(); ?>/blocks/preview/block-post-footer.jpg" class="acf_pre" style="width: 100%;">
<?php else:
    $classes = 'block-post-footer';
    $classes .= (isset($block['className']) ? ' '.$block['className'] : '');
    $anchor = (isset($block['anchor']) ? $block['anchor'] : '');
    $background = (isset($block['settings_background_colour']) ? $block['settings_background_colour'] : 'none');
    $container = (isset($block['settings_container']) ? $block['settings_container'] : 'md');
    $padding_top = (isset($block['settings_padding_top']) ? $block['settings_padding_top'] : '40');
    $padding_bottom = (isset($block['settings_padding_bottom']) ? $block['settings_padding_bottom'] : '40'); 
    
    $post_ID = get_the_ID();
    $post_prev = get_next_post();
    $post_next = get_previous_post();
    
    $add_social_media = get_field('add_social_media', 'options'); ?>

    <div class="betterbase-theme <?php echo $classes; ?>" <?php echo ($anchor ? 'id="'.$anchor.'"' : ''); ?>>
        <div class="block-setting-padding block-setting-background-colour" style="--block-padding-top: <?php echo $padding_top; ?>px; --block-padding-bottom: <?php echo $padding_bottom; ?>px; --block-background-colour: var(--<?php echo $background; ?>);">
            <div class="container-<?php echo $container; ?> <?php echo get_text_colour($background); ?>">
                <div class="post-pagination flex-layout flex-align-center flex-justify-between flex-gap">
                    <div class="prev-post">
                        <?php if (!empty($post_prev)): ?>
                            <a href="<?php echo get_permalink($post_prev->ID); ?>" title="Previous post">
                                <?php include_asset('icon-arrow-left.svg'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php include(get_template_directory().'/parts/social-share.php'); ?>
                    <div class="next-post">
                        <?php if (!empty($post_next)): ?>
                            <a href="<?php echo get_permalink($post_next->ID); ?>" title="Next post">
                                <?php include_asset('icon-arrow-right.svg'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>