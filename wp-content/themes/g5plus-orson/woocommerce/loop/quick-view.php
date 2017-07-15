<?php
/**
 * Template display quickview
 *
 * @package WordPress
 * @subpackage Orson
 * @since orson 1.0
 */
$product_quick_view = G5Plus_Global::get_option('product_quick_view_enable');
if (!$product_quick_view) return;
?>
<a data-toggle="tooltip" data-placement="top" title="<?php esc_html_e('Quick view', 'g5plus-orson') ?>" class="product-quick-view no-animation" data-product_id="<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>

