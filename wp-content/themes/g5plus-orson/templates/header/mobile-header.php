<?php
/**
 * Header Mobile Template Layout
 */
$header = &G5Plus_Global::get_header_var();
$stiky_wrapper = array('header-mobile-wrapper');
$stiky_region = array('header-mobile-inner');
if ($header['mobile_header_stick']) {
	$stiky_wrapper[] = 'sticky-wrapper';
	$stiky_region[] = 'sticky-region';
}
if ($header['mobile_header_search_box'] && $header['mobile_header_shopping_cart']) {
	$stiky_wrapper[] = 'both-mobile-icon';
}
?>
<div class="<?php echo join(' ', $stiky_wrapper); ?>">
	<div class="<?php echo join(' ', $stiky_region); ?>">
		<div class="container header-mobile-container">
			<div class="header-mobile-container-inner clearfix">
				<?php g5plus_get_template('header/mobile-logo'); ?>
				<div class="toggle-icon-wrapper toggle-mobile-menu"
				     data-drop-type="<?php echo esc_attr($header['mobile_header_menu_drop']); ?>">
					<div class="toggle-icon"><span></span></div>
				</div>
				<?php if ($header['mobile_header_shopping_cart']): ?>
					<?php g5plus_get_template('header/customize-shopping-cart'); ?>
				<?php endif; ?>
				<?php if ($header['mobile_header_search_box'] && ($header['mobile_header_layout'] !== 'header-mobile-4')): ?>
					<div class="mobile-search-button">
						<?php g5plus_get_template('header/customize-search-button'); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php g5plus_get_template('header/mobile-navigation'); ?>
		</div>
	</div>
</div>