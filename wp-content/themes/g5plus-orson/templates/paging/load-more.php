<?php
/**
 * The template for displaying paging style load more
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$wp_query = &G5Plus_Global::get_wp_query();
$link = get_next_posts_page_link($wp_query->max_num_pages);
if (empty($link)) return;
?>
<div class="paging-navigation clearfix text-center">
	<button data-href="<?php echo esc_url($link); ?>" type="button"  data-loading-text="<span class='fa fa-spinner fa-spin'></span> <?php esc_html_e('Loading...','g5plus-orson'); ?>" class="blog-load-more">
		<?php esc_html_e('Load More','g5plus-orson'); ?>
	</button>
</div>

