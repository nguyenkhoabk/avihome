<?php
return array(
	'base' => 'g5plus_blog',
	'name' => esc_html__('Blog','g5plus-orson'),
	'icon' => 'fa fa-file-text',
	'category' => G5PLUS_FRAMEWORK_SHORTCODE_CATEGORY,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Layout', 'g5plus-orson'),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Large Image','g5plus-orson') => 'large-image',
				esc_html__('Medium Image','g5plus-orson') => 'medium-image',
				esc_html__('Masonry', 'g5plus-orson' ) => 'masonry',
			),
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'g5plus-orson'),
			'param_name' => 'columns',
			'value' => array('2' => 2 , '3' => 3),
			'dependency' => array('element' => 'layout', 'value' => 'masonry'),
		),

		array(
			'type' => 'number',
			'heading' => esc_html__('Number of posts', 'g5plus-orson' ),
			'description' => esc_html__('Enter number of posts to display.', 'g5plus-orson' ),
			'param_name' => 'max_items',
			'value' => -1,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Post Paging', 'g5plus-orson'),
			'param_name' => 'post_paging',
			'value' => array(
				esc_html__('Show all', 'g5plus-orson') => 'all',
				esc_html__('Navigation', 'g5plus-orson') => 'navigation',
				esc_html__('Load More', 'g5plus-orson') => 'load-more',
				esc_html__('Infinite Scroll', 'g5plus-orson') => 'infinite-scroll'
			),
			'std' => 'all',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array('element' => 'max_items','value' => '-1'),
		),

		array(
			"type" => "number",
			"heading" => esc_html__("Posts per page", 'g5plus-orson'),
			"param_name" => "posts_per_page",
			"value" => get_option('posts_per_page'),
			"description" => esc_html__('Number of items to show per page', 'g5plus-orson'),
			'dependency' => array('element' => 'post_paging','value' => array('navigation', 'load-more', 'infinite-scroll')),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'g5plus-orson'),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__('Date', 'g5plus-orson') => 'date',
				esc_html__('Order by post ID', 'g5plus-orson') => 'ID',
				esc_html__('Author', 'g5plus-orson') => 'author',
				esc_html__('Title', 'g5plus-orson') => 'title',
				esc_html__('Last modified date', 'g5plus-orson') => 'modified',
				esc_html__('Post/page parent ID', 'g5plus-orson') => 'parent',
				esc_html__('Number of comments', 'g5plus-orson') => 'comment_count',
				esc_html__('Menu order/Page Order', 'g5plus-orson') => 'menu_order',
				esc_html__('Meta value', 'g5plus-orson') => 'meta_value',
				esc_html__('Meta value number', 'g5plus-orson') => 'meta_value_num',
				esc_html__('Random order', 'g5plus-orson') => 'rand',
			),
			'description' => esc_html__('Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'g5plus-orson'),
			'group' => esc_html__('Data Settings', 'g5plus-orson'),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sorting', 'g5plus-orson'),
			'param_name' => 'order',
			'group' => esc_html__('Data Settings', 'g5plus-orson'),
			'value' => array(
				esc_html__('Descending', 'g5plus-orson') => 'DESC',
				esc_html__('Ascending', 'g5plus-orson') => 'ASC',
			),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'description' => esc_html__('Select sorting order.', 'g5plus-orson'),
		),

		array(
			'type' => 'textfield',
			'heading' => esc_html__('Meta key', 'g5plus-orson'),
			'param_name' => 'meta_key',
			'description' => esc_html__('Input meta key for grid ordering.', 'g5plus-orson'),
			'group' => esc_html__('Data Settings', 'g5plus-orson'),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'orderby',
				'value' => array('meta_value', 'meta_value_num'),
			),
		),
		g5plus_vc_map_add_narrow_category(),
		g5plus_vc_map_add_extra_class()
	)
);