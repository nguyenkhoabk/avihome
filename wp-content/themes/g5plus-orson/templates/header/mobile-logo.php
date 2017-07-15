<?php
	$logo = &G5Plus_Global::get_logo_var();
	$logo_class = array('logo-mobile');
	$data_retina = '';
	if ($logo['mobile_logo_retina'] && ($logo['mobile_logo_retina'] != $logo['mobile_logo'])) {
		$data_retina = sprintf(' data-no-retina="%s" data-retina="%s"', esc_url($logo['mobile_logo']), esc_url($logo['mobile_logo_retina']));
	}
	$logo_title = esc_attr( get_bloginfo( 'name', 'display' ) ) . '-' . get_bloginfo( 'description', 'display' );
?>
<div class="logo-mobile-wrapper">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr($logo_title); ?>">
		<img src="<?php echo esc_url($logo['mobile_logo']); ?>"<?php echo sprintf('%s', $data_retina); ?> alt="<?php echo esc_attr($logo_title); ?>"/>
	</a>
</div>