<?php
/**
 * The template for displaying navigation on single post
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$single_navigation_enable = G5Plus_Global::get_option('single_navigation_enable');
if (!$single_navigation_enable) return;
?>
<nav class="post-navigation" role="navigation">
	<div class="nav-links">
		<?php
		previous_post_link('<div class="nav-previous">%link</div>', _x('<i class="post-navigation-icon fa fa-chevron-left"></i> <div class="post-navigation-content"><div class="post-navigation-label">Previous Post</div> <div class="post-navigation-title">%title </div> </div> ', 'Previous post link', 'g5plus-orson'));
		next_post_link('<div class="nav-next">%link</div>', _x('<i class="post-navigation-icon fa fa-chevron-right"></i> <div class="post-navigation-content"><div class="post-navigation-label">Next Post</div> <div class="post-navigation-title">%title</div></div> ', 'Next post link', 'g5plus-orson'));
		?>
	</div>
	<!-- .nav-links -->
</nav><!-- .navigation -->
