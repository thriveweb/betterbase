<?php get_header(); ?>

<div class="page-error">
    <div class="block-404">
        <div class="block-setting-padding block-setting-background-color" style="--block-padding-top: 120px; --block-padding-bottom: 120px; --block-background-color: var(--light-grey);">
            <div class="container-sm">
                <div class="wysiwyg-content text-align-center">
                    <h1>404 Not Found</h1>
                    <p>Oops! We can't find what you're looking for.</p>
                    <div class="group-button flex-justify-center">
                        <a class="button" href="<?php echo esc_url(home_url('/')); ?>" title="Go home">Go home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
