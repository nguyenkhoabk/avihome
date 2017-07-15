<?php
/**
 * The template used for displaying wrapper end
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$page_layouts = &G5Plus_Global::get_page_layout();
$has_sidebar = false;
if (is_active_sidebar($page_layouts['sidebar']) && ($page_layouts['sidebar_layout'] != 'none')) {
	$has_sidebar = true;
}
?>
</div><!-- End Layout Inner -->
<?php get_sidebar(); ?>
<?php if (($has_sidebar) && ($page_layouts['layout'] != 'full')): ?>
	</div><!-- End Row -->
<?php endif; ?>
<?php if ($page_layouts['layout'] != 'full'): ?>
	</div><!-- End Container -->
<?php endif;?>
</div><!--End Main -->
