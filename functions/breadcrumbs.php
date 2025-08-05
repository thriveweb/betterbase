<?php

/*-----------------------------------------------------------------------
   Custom breadcrumbs
-----------------------------------------------------------------------*/

function get_breadcrumbs() {
   global $post;

   if (!is_front_page()): // Skip showing on the front page ?>

      <div class="site-breadcrumbs">
         <div class="container-lg flex-layout">

         <h6><a href="<?php echo get_option('home'); ?>" title="Home">Home</a></h6>
         <h6>/</h6>

         <?php if (is_home()): // If the current page is assigned as page for posts ?>

            <h6><?php echo get_the_title(get_option('page_for_posts')); ?></h6>

         <?php elseif (is_search()): // If the current page is search results ?>

            <h6>Search results for: <?php echo get_search_query(); ?></h6>

         <?php elseif (is_active_woocommerce() && (is_product_category() || is_product_tag())): // If current page is a product category or tag ?>

            <h6><a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>" title="<?php echo get_the_title(get_option('woocommerce_shop_page_id')); ?>"><?php echo get_the_title(get_option('woocommerce_shop_page_id')); ?></a></h6>
            <h6>/</h6>
            <h6><?php echo get_queried_object()->name; ?></h6>

         <?php elseif (is_archive()): // If the current page is a post type or category archive ?>

            <?php if (is_category()): ?>

               <h6><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" title="<?php echo get_the_title(get_option('page_for_posts')); ?>"><?php echo get_the_title(get_option('page_for_posts')); ?></a></h6>
               <h6>/</h6>

               <?php if (!empty(get_queried_object()->parent)): ?>
                  <h6><a href="<?php echo get_permalink(get_term_link(get_queried_object()->term_id)); ?>" title="<?php echo get_term(get_queried_object()->parent)->name; ?>"><?php echo get_term(get_queried_object()->parent)->name; ?></a></h6>
                  <h6>/</h6>
               <?php endif; ?>

               <h6><?php echo get_queried_object()->name; ?></h6>

            <?php else: ?>

               <h6><?php echo post_type_archive_title('', false); ?></h6>

            <?php endif; ?>

         <?php elseif (is_active_woocommerce() && is_product()): // If the current page is a single product
            $product_category = get_the_terms($post->id, 'product_cat'); ?>

            <h6><a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>" title="<?php echo get_the_title(get_option('woocommerce_shop_page_id')); ?>"><?php echo get_the_title(get_option('woocommerce_shop_page_id')); ?></a></h6>
            <h6>/</h6>

            <?php if (is_active_woocommerce() && !empty($product_category)): // If the current product is assigneed a product category ?>

               <h6><a href="<?php echo get_term_link($product_category[0]->term_id); ?>" title="<?php echo $product_category[0]->name; ?>"><?php echo $product_category[0]->name; ?></a></h6>
               <h6>/</h6>

            <?php endif; ?>

            <h6><?php echo get_the_title(); ?></h6>

         <?php elseif (is_single()): // If the current page is a single post

            $post_category = get_the_terms($post->id, 'category'); ?>

            <h6><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" title="<?php echo get_the_title(get_option('page_for_posts')); ?>"><?php echo get_the_title(get_option('page_for_posts')); ?></a></h6>
            <h6>/</h6>

            <?php if (!empty($post_category)): // If the current post is assigneed a category ?>

               <h6><a href="<?php echo get_term_link($post_category[0]->term_id); ?>" title="<?php echo $post_category[0]->name; ?>"><?php echo $post_category[0]->name; ?></a></h6>
               <h6>/</h6>

            <?php endif; ?>

            <h6><?php echo get_the_title(); ?></h6>
         
         <?php elseif (is_page()): // If the current page is a static page ?>

            <?php if (get_post_ancestors($post)): // Check if current page has parents ?>

               <?php foreach (array_reverse(get_post_ancestors($post)) as $parent): ?>
                  <h6><a href="<?php echo get_permalink($parent); ?>" title="<?php echo get_the_title($parent); ?>"><?php echo get_the_title($parent); ?></a></h6>
                  <h6>/</h6>
               <?php endforeach; ?>
               
            <?php endif; ?>

            <h6><?php echo get_the_title(); ?></h6>

         <?php elseif (is_404()): ?>

            <h6>404: Not Found</h6>

         <?php endif; ?>

         </div>
      </div>

   <?php endif;
}
