<?php
/**
 * Header Mobile Navigation
 */
$header = &G5Plus_Global::get_header_var();
$page_menu_mobile = g5plus_get_rwmb_meta('page_menu_mobile');
if ($page_menu_mobile === false) {
	$page_menu_mobile = g5plus_get_rwmb_meta('page_menu');
}

$theme_location = 'primary';
if (has_nav_menu( 'mobile' )) {
	$theme_location = 'mobile';
}

$header_mobile_class = array('header-mobile-nav');
$header_mobile_class[] = esc_attr($header['mobile_header_menu_drop']);
?>
<div class="<?php echo join(' ', $header_mobile_class) ?>">
	<?php echo apply_filters('g5plus_before_menu_mobile_filter',''); ?>
	<?php
	$arg_menu = array(
		'container' => 'header-mobile-nav-inner',
		'theme_location' => 'primary',
		'menu_class' => 'nav-menu-mobile',
		'is_mobile_menu' => true,
	);
	if (!$page_menu_mobile) {
		$arg_menu['menu'] = $page_menu_mobile;
	}
	wp_nav_menu( $arg_menu );
	?>
	<?php echo apply_filters('g5plus_after_menu_mobile_filter',''); ?>
</div>