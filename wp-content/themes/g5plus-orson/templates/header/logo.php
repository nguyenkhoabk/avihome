<?php
	$logo = &G5Plus_Global::get_logo_var();
	$header = &G5Plus_Global::get_header_var();
	$header_logo_sticky_layout = array('header-1', 'header-3');
	$logo_class = array('logo-header');
	if (in_array($header['header_layout'], $header_logo_sticky_layout) && ($logo['sticky_logo']) && ($logo['logo'] != $logo['sticky_logo'])) {
		$logo_class[] = 'has-logo-sticky';
	}
	$data_retina = '';
	if ($logo['logo_retina'] && ($logo['logo_retina'] != $logo['logo'])) {
		$data_retina = sprintf(' data-retina="%s"', esc_url($logo['logo_retina']));
	}

	$data_sticky_retina = '';
	if ($logo['sticky_logo_retina'] && ($logo['sticky_logo_retina'] != $logo['sticky_logo'])) {
		$data_sticky_retina = sprintf(' data-retina="%s"', esc_url($logo['sticky_logo_retina']));
	}

	$logo_title = esc_attr( get_bloginfo( 'name', 'display' ) ) . '-' . get_bloginfo( 'description', 'display' );
?>
<div class="<?php echo join(' ', $logo_class); ?>">
	<a class="no-sticky" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr($logo_title); ?>">
		<img src="<?php echo esc_url($logo['logo']); ?>"<?php echo sprintf('%s', $data_retina); ?> alt="<?php echo esc_attr($logo_title); ?>"/>
	</a>
	<?php if (in_array($header['header_layout'], $header_logo_sticky_layout) && ($logo['sticky_logo']) && ($logo['sticky_logo'] != $logo['logo'])): ?>
		<a class="logo-sticky" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr($logo_title); ?>">
			<img src="<?php echo esc_url($logo['sticky_logo']); ?>"<?php echo sprintf('%s', $data_sticky_retina); ?> alt="<?php echo esc_attr($logo_title); ?>"/>
		</a>
	<?php endif;?>
</div>