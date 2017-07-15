<?php
/**
 * The template for displaying Product Quick Views Image
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;
$index = 0;
$product_images = array();
$image_ids = array();

if (has_post_thumbnail()) {
	$product_images[$index] = array(
		'image_id' => get_post_thumbnail_id()
	);
	$image_ids[$index] = get_post_thumbnail_id();
	$index++;
}

// Additional Images
$attachment_ids = $product->get_gallery_attachment_ids();
if ($attachment_ids) {
	foreach ($attachment_ids as $attachment_id) {
		if (in_array($attachment_id, $image_ids)) continue;
		$product_images[$index] = array(
			'image_id' => $attachment_id
		);
		$image_ids[$index] = $attachment_id;
		$index++;
	}
}

// product variable type
if ($product->product_type == 'variable') {
	$available_variations = $product->get_available_variations();
	$selected_attributes = $product->get_variation_default_attributes();

	if (isset($available_variations)) {
		foreach ($available_variations as $available_variation) {
			$variation_id = $available_variation['variation_id'];
			if (has_post_thumbnail($variation_id)) {
				$variation_image_id = get_post_thumbnail_id($variation_id);

				if (in_array($variation_image_id, $image_ids)) {
					$index_of = array_search($variation_image_id, $image_ids);
					if (isset($product_images[$index_of]['variation_id'])) {
						$product_images[$index_of]['variation_id'] .= $variation_id . '|';
					} else {
						$product_images[$index_of]['variation_id'] = '|' . $variation_id . '|';
					}
					continue;
				}

				$product_images[$index] = array(
					'image_id' => $variation_image_id,
					'variation_id' => '|' . $variation_id . '|'
				);
				$image_ids[$index] = $variation_image_id;
				$index++;
			}
		}
	}
}

$galleryId = rand();
?>
<div id="quick-view-product-image" class="single-product-image-inner">
	<div class="single-product-image-main-wrap">
		<div class="single-product-image-main owl-carousel manual">
			<?php
			foreach($product_images as $key => $value) {
				$index = $key;
				$image_id = $value['image_id'];
				$variation_id = isset($value['variation_id']) ? $value['variation_id'] : '' ;
				$image_title 	= esc_attr( get_the_title( $image_id ) );
				$image_caption = '';
				$image_obj = get_post( $image_id );
				if (isset($image_obj) && isset($image_obj->post_excerpt)) {
					$image_caption 	= $image_obj->post_excerpt;
				}
				$image_link  	= wp_get_attachment_url( $image_id );
				$image_thumb = wp_get_attachment_image_src($image_id);
				$image_thumb_link = '';
				if (sizeof($image_thumb) > 0) {
					$image_thumb_link = $image_thumb['0'];
				}
				$image       	= wp_get_attachment_image( $image_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
				) );
				echo '<div>';
				if (!empty($variation_id)) {
					echo apply_filters('woocommerce_single_product_image_html',
						sprintf('<a data-thumb-src="%s" href="%s" itemprop="image" 
						class="woocommerce-light-gallery" title="%s" data-rel="lightGallery" 
						data-gallery-id="%s" data-variation_id="%s" data-index="%s"><i class="fa fa-search"></i></a>%s',
							esc_url($image_thumb_link), esc_url($image_link), esc_attr($image_caption), $galleryId, $variation_id, $index, $image), $post->ID);
				} else {
					echo apply_filters('woocommerce_single_product_image_html',
						sprintf('<a data-thumb-src="%s" href="%s" itemprop="image" 
						class="woocommerce-light-gallery" title="%s" data-rel="lightGallery" 
						data-gallery-id="%s" data-index="%s"><i class="fa fa-search"></i></a>%s',
							esc_url($image_thumb_link), esc_url($image_link), esc_attr($image_caption), $galleryId, $index, $image), $post->ID);
				}
				echo '</div>';
			}
			?>

		</div>
		<?php
		/**
		 * g5plus_after_single_product_image_main hook.
		 *
		 * @hooked g5plus_woocommerce_template_loop_sale_count_down - 10
		 */
		do_action( 'g5plus_after_single_product_image_main' );
		?>
	</div>

	<div class="single-product-image-thumb mg-top-15 owl-carousel manual">
		<?php
			foreach($product_images as $key => $value) {
				$index = $key;
				$image_id = $value['image_id'];
				$variation_id = isset($value['variation_id']) ? $value['variation_id'] : '' ;
				$image_title 	= esc_attr( get_the_title( $image_id ) );
				$image_caption = '';
				$image_obj = get_post( $image_id );
				if (isset($image_obj) && isset($image_obj->post_excerpt)) {
					$image_caption 	= $image_obj->post_excerpt;
				}


				$image_link  	=  wp_get_attachment_url( $image_id );
				$image       	= wp_get_attachment_image( $image_id,  apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
				) );
				echo '<div class="product-image-thumb-item">';
				if (!empty($variation_id)) {
					echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-variation_id="%s" data-index="%s">%s</a>', esc_url($image_link), esc_attr($image_caption),$variation_id,$index,  $image ), $post->ID );
				} else {
					echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-index="%s">%s</a>', esc_url($image_link), esc_attr($image_caption),$index , $image), $post->ID );
				}
				echo '</div>';
			}
		?>
	</div>
</div>

