<?php
$header = &G5Plus_Global::get_header_var();
$header_class = array('header-wrapper', 'nav-accent-color', 'clearfix');
$header_above_class = array('header-row', 'header-above-wrapper');

$sticky_wrapper = array();
$sticky_region_class = array('header-row', 'header-nav-wrapper');
if ($header['header_sticky']) {
	$sticky_wrapper[] = 'sticky-wrapper';
	$sticky_region_class[] = 'sticky-region';
}
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
				</div>
			</div>
		</div>
	</div>
</div>