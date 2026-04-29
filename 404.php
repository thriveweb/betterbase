<?php get_header(); ?>

<div class="page-error">
    <div class="betterbase-theme block-404">
        <div class="block-setting-padding" style="--block-padding-top: 200px; --block-padding-bottom: 200px;">
            <div class="container-sm">
                <div class="wysiwyg-content text-center">
                    <h1>404 Not Found</h1>
                    <p>Oops! We can't find what you're looking for.</p>
                    <div class="button-group flex-justify-center">
                        <a class="button" href="<?php echo get_bloginfo('url'); ?>" title="Go back">Go back</a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer();