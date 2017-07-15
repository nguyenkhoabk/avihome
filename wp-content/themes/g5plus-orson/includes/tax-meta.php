<?php
//include the main class file
if (is_admin()){
    /*
     * prefix of meta keys, optional
     */
    $prefix = G5PLUS_METABOX_PREFIX;
    /*
     * configure your meta box
     */
    $config_page_title = array(
        'id' => 'page_title_meta_box',          // meta box id, unique per meta box
        'title' => esc_html__('Page Title','g5plus-orson') ,          // meta box title
        'pages' => array('category','product_cat'),        // taxonomy name, accept categories, post_tag and custom taxonomies
        'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
        'fields' => array(),            // list of meta fields (can be added by field arrays)
        'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
        'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
    );

	/*
     * Initiate your meta box
     */
	$page_title_meta =  new Tax_Meta_Class($config_page_title);
	/*
	 * Add fields to your meta box
	 */
	$page_title_meta->addRadio(
		$prefix.'page_title_enable',
		g5plus_get_toggle(1),
		array(
			'name' => esc_html__('Show/Hide Page Title?','g5plus-orson'),
			'std' => -1
		)
	);

	//Image field
	$page_title_meta->addImage(
		$prefix.'page_title_bg_image',
		array(
			'name'=> esc_html__('Page Title Background Image','g5plus-orson')
		)
	);


	$config_banner = array(
		'id' => 'banner_meta_box',          // meta box id, unique per meta box
		'title' => esc_html__('Banner','g5plus-orson') ,          // meta box title
		'pages' => array('product_cat'),        // taxonomy name, accept categories, post_tag and custom taxonomies
		'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
		'fields' => array(),            // list of meta fields (can be added by field arrays)
		'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);

	$banner_meta = new Tax_Meta_Class($config_banner);

	$banner_meta->addRadio(
		$prefix.'archive_product_banner_layout',
		g5plus_get_archive_product_banner_layout(1),
		array(
			'name' => esc_html__( 'Banner Layout', 'g5plus-orson' ),
			'std' => '-1'
		)
	);

	$banner_meta->addRadio(
		$prefix.'archive_product_banner_type',
		g5plus_get_archive_product_banner_type(1),
		array(
			'name' => esc_html__( 'Banner Type', 'g5plus-orson' ),
			'std' => '-1'
		)
	);

	$banner_meta->addImage(
		$prefix.'archive_product_banner_image',
		array(
			'name'  => esc_html__('Banner Image','g5plus-orson'),
			'desc'  => esc_html__ ( 'Only useful when the banner type is Image', 'g5plus-orson' ),
		)
	);

	$banner_meta->addTextarea(
		$prefix.'archive_product_banner_video',
		array(
			'name'=>  esc_html__('Banner Video','g5plus-orson'),
			'style' => 'height:100px;',
			'desc' => esc_html__('Only useful when the banner type is Video. Video url (oembed) or embed code','g5plus-orson')
		)
	);

	$banner_meta->addSelect(
		$prefix.'archive_product_banner_rev_slider',
		g5plus_get_rev_slider(),
		array(
			'name' => esc_html__('Revolution Slider','g5plus-orson'),
			'std' => '-1',
			'desc' => esc_html__('Only useful when the banner type is Revolution Slider.','g5plus-orson')
		)
	);





	/*
	* Don't Forget to Close up the meta box decleration
	*/
	//Finish Meta Box Decleration

	$page_title_meta->Finish();
	$banner_meta->Finish();


}
