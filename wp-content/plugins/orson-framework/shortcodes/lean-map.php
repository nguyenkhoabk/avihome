<?php
function g5plus_lean_map() {
	$lean_maps = array(
		'g5plus_button',
		'g5plus_heading',
		'g5plus_widget_posts',
		'g5plus_posts',
		'g5plus_products',
		'g5plus_product_deals',
		'g5plus_product_sidebar',
		'g5plus_product_categories',
		'g5plus_product_categories_box',
		'g5plus_widget_product_categories',
		'g5plus_product_category_box',
		'g5plus_widget_nav_menu',
		'g5plus_widget_info_box',
		'g5plus_cta',
		'g5plus_blockquote',
		'g5plus_blog',
		'g5plus_lists',
		'g5plus_icon_box',
		'g5plus_banner',
        'g5plus_testimonials',
		'g5plus_pricing_tables',
		'g5plus_partner_carousel',
		'g5plus_our_team',
		'g5plus_counter',
		'g5plus_portfolio',
		'g5plus_widget_text_block',
		'g5plus_slider_container',
		'g5plus_feature_box',
		'g5plus_social_icons',
		'g5plus_countdown',
		'g5plus_sale_box',
		'g5plus_video',
		'g5plus_google_map'
	);
	foreach ($lean_maps as $key){
		$directory = preg_replace('/^g5plus_/', '', $key);
		vc_lean_map( $key, null, PLUGIN_G5PLUS_FRAMEWORK_DIR . 'shortcodes/' . str_replace('_', '-', $directory) . '/config.php' );
	}
}
add_action('vc_before_mapping', 'g5plus_lean_map');