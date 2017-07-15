<?php
/**
 * Return search form
 */
$categories = get_categories(array( 'taxonomy' => 'product_cat' ));
?>
<div class="search-product-wrapper search-ajax-content" data-search="ajax" data-ajax-action="result_search_product">
	<input type="text" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'g5plus-orson' ); ?>"/>
	<div class="categories">
		<span data-id="-1"><?php esc_html_e('Select Category','g5plus-orson') ?></span>
		<?php echo g5plus_categories_binder($categories, '0', 'search-category-dropdown drop-shadow',false,false,true); ?>
	</div>
	<button class="search-button" data-search-wrapper=".search-product-wrapper"><i class="fa fa-search"></i></button>
	<div class="search-ajax-result drop-shadow"></div>
</div>