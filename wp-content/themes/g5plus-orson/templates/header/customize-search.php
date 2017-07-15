<?php
/**
 * @var $customize_location
 */
$customize = &G5Plus_Global::get_header_customize_var();
$classes = array(
	'header-customize-item',
	'item-search'
);
if ($customize['header_customize_' . $customize_location . '_search'] == 'box-small') {
	$classes[] = 'search-form-small';
}
?>
<div class="<?php echo join(' ', $classes); ?>">
	<?php g5plus_get_template('header/customize-search-' . $customize['header_customize_' . $customize_location . '_search']); ?>
</div>