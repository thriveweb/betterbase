<?php get_header(); ?>

<div class="page-error">
    <div class="padding-lg">
        <div class="container-sm">
            <div class="wysiwyg-content text-align-center">
                <h1>404 Not Found</h1>
                <p>Oops! We can't find what you're looking for.</p>
                <div class="group-button flex-justify-center">
                    <a class="button" href="<?php echo esc_url(home_url('/')); ?>" title="Go back">Go back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
