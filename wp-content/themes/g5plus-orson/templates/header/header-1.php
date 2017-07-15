<?php
$header = &G5Plus_Global::get_header_var();
$header_class = array('header-wrapper', 'clearfix');
if ($header['header_container_layout'] != 'container') {
	$header_class[] = $header['header_container_layout'];
}
if ($header['header_border_bottom'] != 'none') {
	$header_class[] = $header['header_border_bottom'];
}

if ($header['header_float']) {
	$header_class[] = 'float-header';
}

$sticky_wrapper = array();
if ($header['header_sticky']) {
	$sticky_wrapper[] = 'sticky-wrapper';
	$header_class[] = 'sticky-region';
}
$page_menu = g5plus_get_rwmb_meta('page_menu');
?>
<div class="<?php echo join(' ', $sticky_wrapper); ?>">
	<div class="<?php echo join(' ', $header_class); ?>">
		<div class="container">
			<div class="header-above-inner container-inner clearfix">
				<?php g5plus_get_template('header/logo'); ?>
				<?php if (has_nav_menu('primary')) : ?>
					<nav class="primary-menu">
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