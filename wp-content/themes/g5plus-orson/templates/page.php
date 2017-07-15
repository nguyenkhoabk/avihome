<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
// Start the loop.
while ( have_posts() ) : the_post();
	// Include the page content template.
	g5plus_get_template('content-page');
	// End of the loop.
endwhile;