<?php
/**
 * The template for displaying Catalog Filter
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<div class="product-item-wrap product-small-item-wrap">
	<div class="product-small-images">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo $product->get_image(); ?>
		</a>
	</div>
	<div class="product-small-content">
		<h3 class="product-title">
			<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
				<?php echo $product->get_title(); ?>
			</a>
		</h3>
		<?php echo $product->get_rating_html(); ?>
		<p class="price">
			<?php echo $product->get_price_html(); ?>
		</p>
	</div>
</div>
