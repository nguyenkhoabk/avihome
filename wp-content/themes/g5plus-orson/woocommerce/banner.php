<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/17/2016
 * Time: 3:51 PM
 */
$banner_wrapper_classes = array(
	'catalog-banner'
);
$banner_layout = G5Plus_Global::get_option('archive_product_banner_layout');
$banner_type = G5Plus_Global::get_option('archive_product_banner_type');
// custom product category
$cat = get_queried_object();
if ($cat && property_exists( $cat, 'term_id' )) {
	$banner_layout_custom = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_layout');
	if (isset($banner_layout_custom) &&  ($banner_layout_custom != '') && ($banner_layout_custom != -1)) {
		$banner_layout = $banner_layout_custom;
	}

	$banner_type_custom = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_type');
	if (isset($banner_type_custom) &&  ($banner_type_custom != '') && ($banner_type_custom != -1)) {
		$banner_type = $banner_type_custom;
	}
}
if ($banner_layout == 'container') {
	$banner_wrapper_classes[] = 'mg-bottom-30';
}
if (empty($banner_type)) return;

if($banner_type == 'image'){
	$banner_image = G5Plus_Global::get_option('archive_product_banner_image');
	$banner_image_id = 0;
	$banner_image_url = '';
	if ($cat && property_exists( $cat, 'term_id' )) {
		if (isset($banner_type_custom) &&  ($banner_type_custom != '') && ($banner_type_custom != -1)) {
			$banner_image = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_image');
		}
	}
	if (isset($banner_image) && isset($banner_image['id']) && isset($banner_image['url'])) {
		$banner_image_id = $banner_image['id'];
		$banner_image_url = $banner_image['url'];
	}

	if ($banner_image_id > 0) {
		$banner_image_title 	= get_the_title( $banner_image_id );
		?>
			<div class="<?php echo esc_attr(implode(' ', $banner_wrapper_classes)); ?>">
				<img class="img-responsive catalog-banner-img" src="<?php echo esc_url($banner_image_url); ?>" alt="<?php echo esc_attr($banner_image_title); ?>">
			</div>
		<?php
	}
} elseif ($banner_type == 'video') {
	$banner_video = G5Plus_Global::get_option('archive_product_banner_video');
	if ($cat && property_exists( $cat, 'term_id' )) {
		if (isset($banner_type_custom) &&  ($banner_type_custom != '') && ($banner_type_custom != -1)) {
			$banner_video = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_video');
		}
	}

	if (!empty($banner_video)) {
		if(wp_oembed_get( $banner_video )) {
			$banner_video = wp_oembed_get($banner_video,array('wmode' => 'transparent'));
		}
		?>
			<div class="<?php echo esc_attr(implode(' ', $banner_wrapper_classes)); ?>">
				<div class="embed-responsive embed-responsive-16by9">
					<?php echo wp_kses_post($banner_video); ?>
				</div>
			</div>
		<?php
	}
} elseif (($banner_type == 'rev_slider') && (shortcode_exists('rev_slider'))) {
	$banner_rev_slider = G5Plus_Global::get_option('archive_product_banner_rev_slider');
	if ($cat && property_exists( $cat, 'term_id' )) {
		if (isset($banner_type_custom) &&  ($banner_type_custom != '') && ($banner_type_custom != -1)) {
			$banner_rev_slider = g5plus_get_tax_meta($cat->term_id,'archive_product_banner_rev_slider');
		}
	}

	if(($banner_rev_slider) && (RevSlider::isAliasExists($banner_rev_slider))){?>
		<div class="<?php echo esc_attr(implode(' ', $banner_wrapper_classes)); ?>">
			<?php echo do_shortcode('[rev_slider "'. $banner_rev_slider .'"]'); ?>
		</div>
	<?php
	}

}

