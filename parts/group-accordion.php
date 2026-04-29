<?php if (!empty($add_accordion)): ?>
    <div class="listing-accordion" itemscope itemtype="https://schema.org/FAQPage">
        <?php foreach ($add_accordion as $accordion): ?>
            <div class="entry-accordion" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                <div class="inner-entry-title trigger-accordion" itemprop="name">
                    <h5><?php echo $accordion['title']; ?></h5>
                    <?php include_asset('icon-plus.svg'); ?>
                </div>
                <div class="inner-entry-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="wysiwyg-content" itemprop="text">
                        <?php echo $accordion['content']; ?>
                        <?php $add_button = $accordion['button_group']['add_button'];
                        include(get_template_directory().'/parts/group-button.php'); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
