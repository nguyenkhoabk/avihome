<?php
if (!function_exists('g5plus_add_search_popup')) {
	function g5plus_add_search_popup() {
		$search_popup_type = G5Plus_Global::get_option('search_popup_type','standard');
		g5plus_get_template('header/search-popup-' . $search_popup_type);
	}
	add_action('wp_footer','g5plus_add_search_popup');
}
$search_popup_type = G5Plus_Global::get_option('search_popup_type','standard');
?>
<a href="#" class="prevent-default search-<?php echo esc_attr($search_popup_type); ?>"><i class="fa fa-search"></i></a>