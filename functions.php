<?php
require_once('functions/colors.php');
require_once('functions/helpers.php');
require_once('functions/default.php');
require_once('functions/media.php');
require_once('functions/theme.php');
require_once('functions/enqueue.php');
require_once('functions/post-types.php');
require_once('functions/acf-blocks.php');

if (betterbase_is_active_woocommerce()) {
    require_once('functions/woocommerce.php');
}
