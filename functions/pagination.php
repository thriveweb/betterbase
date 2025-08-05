<?php

/*-----------------------------------------------------------------------
   Custom numeric pagination
-----------------------------------------------------------------------*/

function get_pagination($range = 2) {
   global $paged, $wp_query;

   if (empty($max_page)) {
      $max_page = $wp_query->max_num_pages;
   }

   if ($max_page > 1) {
      echo '<div class="archive-pagination flex-layout flex-align-center flex-justify-center">';

      if (!$paged) {
         $paged = 1;
      }

      if ($paged > ($range + 1)) {
         echo '<a href="' . get_pagenum_link(1) . '" class="' . (1 == $paged ? 'current' : '') . '">1</a>';
         if ($paged > ($range + 2)) {
            echo '<span>···</span>';
         }
      }

      for ($i = max(1, $paged - $range); $i <= min($max_page, $paged + $range); $i++) {
         echo '<a href="' . get_pagenum_link($i) . '" class="' . ($i == $paged ? 'current' : '') . '">' . $i . '</a>';
      }

      if ($paged < ($max_page - $range)) {
         if ($paged < ($max_page - $range - 1)) {
            echo '<span>···</span>';
         }
         echo '<a href="' . get_pagenum_link($max_page) . '" class="' . ($max_page == $paged ? 'current' : '') . '">' . $max_page . '</a>';
      }

      echo '</div>';
   }
}
