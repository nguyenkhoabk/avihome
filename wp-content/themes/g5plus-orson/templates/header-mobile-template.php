<?php
/**
 * Header Mobile
 */
$header = &G5Plus_Global::get_header_var();
$header_class = array('header-mobile');
$header_class[] = $header['mobile_header_layout'];
//$header_class[] = $header['mobile_header_menu_drop'];
?>
<header class="<?php echo join(' ', $header_class); ?>">
	<?php g5plus_get_template('header/mobile-top-bar'); ?>
	<?php g5plus_get_template('header/mobile-header'); ?>
	<?php if ($header['mobile_header_layout'] === 'header-mobile-4'): ?>
		<div class="mobile-header-search-box">
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
</header>