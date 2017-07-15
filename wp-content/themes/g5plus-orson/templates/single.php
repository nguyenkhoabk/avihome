<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
while ( have_posts() ) : the_post();
	// Include the page content template.
	g5plus_get_template('single/content');
	// End of the loop.
endwhile;
