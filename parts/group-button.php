<?php if (!empty($add_button)): ?>
   <div class="button-group flex-justify-<?php echo (!empty($button_alignment) ? $button_alignment : 'start'); ?>">
      <?php foreach ($add_button as $button): ?>
         <?php if ($button['style'] === 'download' && !empty($button['label']) && !empty($button['file'])): ?>
            <a class="button button-<?php echo $button['colour']; ?>"
               href="<?php echo $button['file']['url']; ?>"
               title="<?php echo $button['label']; ?>"
               download>
               <?php include_asset('icon-download.svg'); ?>
               <?php echo $button['label']; ?>
            </a>
         <?php elseif ($button['style'] != 'download' && !empty($button['link']['url']) && !empty($button['link']['title'])): ?>
            <a class="button button-<?php echo $button['colour']; ?>"
               href="<?php echo $button['link']['url']; ?>"
               target="<?php echo $button['link']['target']; ?>"
               title="<?php echo $button['link']['title']; ?>">
               <?php echo $button['link']['title']; ?>
            </a>
         <?php endif; ?>
      <?php endforeach; ?>
   </div>
<?php endif; ?>
