<?php
$header = &G5Plus_Global::get_header_var();
$header_class = array('header-wrapper', 'nav-accent-color', 'header-accent-color', 'header-nav-hidden', 'clearfix');
$header_above_class = array('header-row', 'header-above-wrapper');

$sticky_wrapper = array();
$sticky_region_class = array('header-row', 'header-nav-wrapper');
if ($header['header_sticky']) {
	$sticky_wrapper[] = 'sticky-wrapper';
	$sticky_region_class[] = 'sticky-region';
}
$categories = get_categories(array( 'taxonomy' => 'product_cat' ));
$page_menu = g5plus_get_rwmb_meta('page_menu');
?>
<div class="<?php echo join(' ', $header_class); ?>">
	<div class="<?php echo join(' ', $header_above_class); ?>">
		<div class="container">
			<div class="header-above-inner clearfix">
				<?php g5plus_get_template('header/logo'); ?>
				<?php g5plus_get_template('header/header-customize', array('customize_location' => 'right'));; ?>
			</div>
		</div>
	</div>
	<div class="<?php echo join(' ', $sticky_wrapper); ?>">
		<div class="<?php echo join(' ', $sticky_region_class); ?>">
			<div class="container">
				<div class="container-inner">
					<div class="header-nav-inner clearfix">
						<div class="no-primary-menu">
							<div class="row">
								<div class="col-sm-3">
									<div class="product-text">
										<?php esc_html_e('Product Categories','g5plus-orson'); ?>
									</div>
								</div>
								<div class="col-sm-9">
									<div class="header-search">
										<div class="search-product-wrapper search-ajax-content" data-search="ajax" data-ajax-action="result_search_product">
											<input type="text" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'g5plus-orson' ); ?>"/>
											<div class="categories">
												<span data-id="-1"><?php esc_html_e('Select Category','g5plus-orson') ?></span>
												<?php echo g5plus_categories_binder($categories, '0', 'search-category-dropdown drop-shadow',false,false,true); ?>
											</div>
											<button class="search-button" data-search-wrapper=".search-product-wrapper"><i class="fa fa-search"></i></button>
											<div class="search-ajax-result drop-shadow"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if (has_nav_menu('primary')) : ?>
							<nav class="primary-menu header-row">
								<?php
								$arg_menu = array(
									'menu_id' => 'main-menu',
									'container' => '',
									'theme_location' => 'primary',
									'menu_class' => 'main-menu',
									'walker' => new XMenuWalker()
								);
								if (!empty($page_menu)) {
									$arg_menu['menu'] = $page_menu;
								}
								wp_nav_menu( $arg_menu );
								g5plus_get_template('header/header-customize', array('customize_location' => 'nav'));
								?>
							</nav>
						<?php endif;?>
						<div class="menu-switch">
							<i class="fa fa-bars"></i>
							<span><?php esc_html_e('Menu','g5plus-orson'); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>