<?php
get_header();
if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css', 0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'orson-portfolio-single-css', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/portfolio/assets/css/portfolio-single' . $min_suffix . '.css'), array(), false);
}
// Start the loop.
while ( have_posts() ) : the_post();
	// Include the page content template.
	G5plus_FrameWork::g5plus_get_template('shortcodes/portfolio/templates/single/content-portfolio');
	// End of the loop.
endwhile;
get_footer();
