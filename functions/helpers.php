<?php

/*-----------------------------------------------------------------------
    PHP Console log
-----------------------------------------------------------------------*/

function betterbase_console_log($data) {
    if (!defined('WP_DEBUG') || !WP_DEBUG) {
        return;
    }

    echo '<script>';
    echo 'console.log("PHP", ' . wp_json_encode($data) . ');';
    echo '</script>';
}

/*-----------------------------------------------------------------------
    Check and include asset if it exists
-----------------------------------------------------------------------*/

function betterbase_include_asset($src) {
    if (strpos($src, '/assets/img/') === false) {
        $src = '/assets/img/' . $src;
    }

    $file_path = get_template_directory() . $src;

    if (file_exists($file_path)) {
        include $file_path;
    }
}

/*-----------------------------------------------------------------------
    Check if WooCommerce is active
-----------------------------------------------------------------------*/

function betterbase_is_active_woocommerce() {
    return class_exists('WooCommerce');
}

/*-----------------------------------------------------------------------
    Change text color class based on background color
-----------------------------------------------------------------------*/

function betterbase_get_text_color($background_color) {
    return betterbase_is_dark_color($background_color) ? 'text-color-white' : 'text-default';
}

/*-----------------------------------------------------------------------
    Search excerpt with first keyword highlight
-----------------------------------------------------------------------*/

function betterbase_get_post_searchable_text($post_id) {
    $post = get_post($post_id);

    if (!$post) {
        return '';
    }

    $parts = array(get_the_title($post_id));
    $blocks = parse_blocks($post->post_content);

    $collect = function ($blocks) use (&$collect, &$parts) {
        foreach ($blocks as $block) {
            if (!empty($block['attrs']['data']) && is_array($block['attrs']['data'])) {
                foreach ($block['attrs']['data'] as $key => $value) {
                    if ($key === '' || (is_string($key) && $key[0] === '_')) {
                        continue;
                    }

                    if (is_string($value) && $value !== '') {
                        $parts[] = wp_strip_all_tags($value);
                    }
                }
            }

            if (!empty($block['innerHTML'])) {
                $html = wp_strip_all_tags($block['innerHTML']);

                if ($html !== '') {
                    $parts[] = $html;
                }
            }

            if (!empty($block['innerBlocks'])) {
                $collect($block['innerBlocks']);
            }
        }
    };

    $collect($blocks);

    if (count($parts) <= 1) {
        $parts[] = wp_strip_all_tags($post->post_content);
        $parts[] = wp_strip_all_tags((string) get_the_excerpt($post_id));
    }

    $text = html_entity_decode(implode(' ', $parts), ENT_QUOTES, 'UTF-8');
    $text = preg_replace('/\s+/u', ' ', trim($text));

    return $text;
}

function betterbase_get_search_excerpt($post_id, $search_query, $radius = 100) {
    $text = betterbase_get_post_searchable_text($post_id);
    $query = trim((string) $search_query);

    if ($text === '') {
        return '';
    }

    if ($query === '' || !function_exists('mb_stripos')) {
        return esc_html(wp_trim_words($text, 28, '…'));
    }

    $pos = mb_stripos($text, $query);

    if ($pos === false) {
        return esc_html(wp_trim_words($text, 28, '…'));
    }

    $match_length = mb_strlen($query);
    $before_start = max(0, $pos - $radius);
    $before = mb_substr($text, $before_start, $pos - $before_start);
    $match = mb_substr($text, $pos, $match_length);
    $after = mb_substr($text, $pos + $match_length, $radius);

    $excerpt = ($before_start > 0 ? '…' : '') . esc_html($before);
    $excerpt .= '<mark>' . esc_html($match) . '</mark>';
    $excerpt .= esc_html($after);
    $excerpt .= (mb_strlen($text) > $pos + $match_length + $radius ? '…' : '');

    return $excerpt;
}

/*-----------------------------------------------------------------------
    Return Instagram username and URL
-----------------------------------------------------------------------*/

function betterbase_get_instagram($social_media_array) {
    if (empty($social_media_array) || !is_array($social_media_array)) {
        return array('url' => '', 'username' => '');
    }

    foreach ($social_media_array as $media) {
        if (($media['platform']['value'] ?? '') !== 'instagram' || empty($media['url'])) {
            continue;
        }

        $url = $media['url'];
        $path = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');
        $username = strtok($path, '/');

        if (!$username || in_array($username, array('p', 'reel', 'stories', 'explore'), true)) {
            continue;
        }

        return array(
            'url' => esc_url($url),
            'username' => sanitize_text_field($username),
        );
    }

    return array('url' => '', 'username' => '');
}

/*-----------------------------------------------------------------------
    Custom numeric pagination
-----------------------------------------------------------------------*/

function betterbase_get_pagination($range = 2, $query = null) {
    if (!$query) {
        global $wp_query;
        $query = $wp_query;
    }

    $max_page = (int) $query->max_num_pages;
    if ($max_page <= 1) {
        return;
    }

    $paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

    echo '<nav class="archive-pagination flex-layout flex-align-center flex-justify-center" aria-label="Pagination">';

    if ($paged > ($range + 1)) {
        echo '<a href="' . esc_url(get_pagenum_link(1)) . '">1</a>';
        if ($paged > ($range + 2)) {
            echo '<span>···</span>';
        }
    }

    for ($i = max(1, $paged - $range); $i <= min($max_page, $paged + $range); $i++) {
        if ($i === $paged) {
            echo '<span class="is-current" aria-current="page">' . esc_html($i) . '</span>';
        } else {
            echo '<a href="' . esc_url(get_pagenum_link($i)) . '">' . esc_html($i) . '</a>';
        }
    }

    if ($paged < ($max_page - $range)) {
        if ($paged < ($max_page - $range - 1)) {
            echo '<span>···</span>';
        }
        echo '<a href="' . esc_url(get_pagenum_link($max_page)) . '">' . esc_html($max_page) . '</a>';
    }

    echo '</nav>';
}

/*-----------------------------------------------------------------------
    Custom breadcrumbs
-----------------------------------------------------------------------*/

function betterbase_get_breadcrumbs() {
    if (is_front_page()) {
        return;
    }

    global $post;
    $crumbs = array(array('label' => 'Home', 'url' => home_url('/')));

    if (is_home()) {
        $crumbs[] = array('label' => get_the_title(get_option('page_for_posts')));

    } elseif (is_search()) {
        $crumbs[] = array('label' => 'Search');

    } elseif (is_404()) {
        $crumbs[] = array('label' => '404: Not Found');

    } elseif (is_category() || is_tag() || is_tax() || (betterbase_is_active_woocommerce() && (is_product_category() || is_product_tag()))) {
        if (betterbase_is_active_woocommerce() && (is_product_category() || is_product_tag())) {
            $shop_ID = (int) get_option('woocommerce_shop_page_id');
            if ($shop_ID) {
                $crumbs[] = array('label' => get_the_title($shop_ID), 'url' => get_permalink($shop_ID));
            }
        } elseif (is_category()) {
            $blog_ID = (int) get_option('page_for_posts');
            if ($blog_ID) {
                $crumbs[] = array('label' => get_the_title($blog_ID), 'url' => get_permalink($blog_ID));
            }
        }

        $term = get_queried_object();
        if (!empty($term->parent)) {
            $parent = get_term($term->parent, $term->taxonomy);
            if ($parent && !is_wp_error($parent)) {
                $crumbs[] = array('label' => $parent->name, 'url' => get_term_link($parent));
            }
        }
        if (!empty($term->name)) {
            $crumbs[] = array('label' => $term->name);
        }

    } elseif (is_post_type_archive() || is_author() || is_date()) {
        $crumbs[] = array('label' => wp_strip_all_tags(get_the_archive_title()));

    } elseif (is_singular()) {
        if (betterbase_is_active_woocommerce() && is_product()) {
            $shop_ID = (int) get_option('woocommerce_shop_page_id');
            if ($shop_ID) {
                $crumbs[] = array('label' => get_the_title($shop_ID), 'url' => get_permalink($shop_ID));
            }
            $terms = get_the_terms($post->ID, 'product_cat');
        } elseif (is_singular('post')) {
            $blog_ID = (int) get_option('page_for_posts');
            if ($blog_ID) {
                $crumbs[] = array('label' => get_the_title($blog_ID), 'url' => get_permalink($blog_ID));
            }
            $terms = get_the_terms($post->ID, 'category');
        } elseif (is_page()) {
            foreach (array_reverse(get_post_ancestors($post->ID)) as $parent_ID) {
                $crumbs[] = array('label' => get_the_title($parent_ID), 'url' => get_permalink($parent_ID));
            }
            $terms = false;
        } else {
            $type = get_post_type_object(get_post_type());
            if ($type && $type->has_archive) {
                $crumbs[] = array('label' => $type->labels->name, 'url' => get_post_type_archive_link($type->name));
            }
            $terms = false;
        }

        if (!empty($terms) && !is_wp_error($terms)) {
            $crumbs[] = array('label' => $terms[0]->name, 'url' => get_term_link($terms[0]));
        }

        $crumbs[] = array('label' => get_the_title());
    }

    if (count($crumbs) < 2) {
        return;
    } ?>

    <nav class="site-breadcrumbs" aria-label="Breadcrumb">
        <div class="container-lg flex-layout flex-align-center">
            <?php foreach ($crumbs as $i => $crumb): ?>
                <?php if ($i > 0): ?>
                    <span class="separator"><?php betterbase_include_asset('icon-chevron-right.svg'); ?></span>
                <?php endif; ?>
                <span>
                    <?php if ($i < count($crumbs) - 1 && !empty($crumb['url'])): ?>
                        <a href="<?php echo esc_url($crumb['url']); ?>" title="<?php echo esc_attr($crumb['label']); ?>"><?php echo esc_html($crumb['label']); ?></a>
                    <?php else: ?>
                        <?php echo esc_html($crumb['label']); ?>
                    <?php endif; ?>
                </span>
            <?php endforeach; ?>
        </div>
    </nav>
<?php }
