<?php if (!empty($add_accordion)): ?>
   <div class="listing-accordion" itemscope itemtype="https://schema.org/FAQPage">
      <?php foreach ($add_accordion as $accordion): ?>
         <div class="entry-accordion" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <h5 class="trigger-accordion flex-justify-between" itemprop="name">
               <?php echo $accordion['title']; ?>
               <?php include_asset('/assets/img/icon-plus.svg'); ?>
            </h5>
            <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
               <div class="wysiwyg-content" itemprop="text">
                  <br><?php echo $accordion['content']; ?>
                  <?php $add_button = $accordion['add_button'];
                  include(get_template_directory().'/parts/group-button.php'); ?>
               </div>
            </div>
         </div>
      <?php endforeach; ?>
   </div>
<?php endif; ?>
