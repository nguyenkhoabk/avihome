<?php
if (!class_exists('WooCommerce')) {
	return;
}
?>
<div class="header-customize-item item-shopping-cart fold-out hover woocommerce">
	<div class="widget_shopping_cart_content">
		<?php get_template_part('woocommerce/cart/mini-cart'); ?>
	</div>
</div>