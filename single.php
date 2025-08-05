<?php get_header(); while (have_posts()): the_post();

$post_ID = get_queried_object_ID(); 
$post_type = get_post_type($post_ID);

$post_title = get_the_title($post_ID);
$post_date = get_the_date('d F Y', $post_ID);
$post_categories = get_the_category($post_ID);
$post_image = get_the_post_thumbnail_url($post_ID, 'large');

$prev_post = get_next_post();
$next_post = get_previous_post(); ?>

<div class="single-<?php echo $post_type; ?>">
   <div class="block-post-content">
      <div class="block-setting-padding" style="--block-padding-top: 80px; --block-padding-bottom: 80px;">
         <div class="container-sm grid-col-1">
            <div class="post-header wysiwyg-content">
               <?php if (!empty($post_date)): ?>
                  <h6><?php echo $post_date; ?></h6>
               <?php endif; ?>
               <h1><?php echo $post_title; ?></h1>
            </div>
            <div class="post-main wysiwyg-content">
               <?php if (!empty($post_image)): ?>
                  <img class="image-landscape" src="<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
               <?php endif; ?>
               <?php the_content(); ?>
            </div>
            <div class="post-footer flex-layout flex-align-center flex-justify-between flex-gap">
               <div class="prev-post">
                  <?php if (!empty($prev_post)): ?>
                     <a href="<?php echo get_permalink($prev_post->ID); ?>" title="Previous post"><?php include_asset('icon-arrow-left.svg'); ?></a>
                  <?php endif; ?>
               </div>
               <?php include(get_template_directory().'/parts/social-share.php'); ?>
               <div class="next-post">
                  <?php if (!empty($next_post)): ?>
                     <a href="<?php echo get_permalink($next_post->ID); ?>" title="Next post"><?php include_asset('icon-arrow-right.svg'); ?></a>
                  <?php endif; ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php endwhile; get_footer();

