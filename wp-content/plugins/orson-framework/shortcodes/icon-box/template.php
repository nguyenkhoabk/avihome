<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout
 * @var $height
 * @var $align
 * @var $size
 * @var $title
 * @var $description
 * @var $description_size
 * @var $icon_type
 * @var $icon_font
 * @var $icon_image
 * @var $icon_color
 * @var $icon_align
 * @var $icon_vertical
 * @var $icon_style
 * @var $link
 * @var $read_more
 * @var $color_scheme
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Icon_Box
 */

$layout = $height = $align = $size = $title = $description = $description_size = $icon_type = $icon_font = $icon_image = $icon_color = $icon_align = $icon_vertical = $icon_style = $link = $read_more = $color_scheme = $css_animation = $animation_duration = $animation_delay = $el_class = $css = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$wrapper_attributes = array();
$wrapper_styles = array();

$inverted = false;
$layout = str_replace( '_outline', '', $layout, $inverted );

$wrapper_classes = array(
	'g5plus-icon-box',
	'ib-layout-' . $layout,
	( $inverted ) ? 'ib-layout-inverted' : '',
	'clearfix',
	$this->getExtraClass($el_class),
	$this->getCSSAnimation($css_animation)
);

if (in_array($layout,array('default','classic','round','square','modern')) && $size != 'md') {
	$wrapper_classes[] = 'ib-size-' . $size;
}


if (in_array($layout,array('default','classic','round','square')) && !empty($align)) {
	$wrapper_classes[] = 'ib-align-' . $align;
}

if (in_array($layout,array('default','classic','round','square','flat')) && !empty($color_scheme)) {
	$wrapper_classes[] = 'ib-scheme-' . $color_scheme;
}

if (in_array($layout,array('default','classic','round','square'))) {
	$wrapper_classes[] = 'ib-icon-align-' . $icon_align;
	if (in_array($icon_align,array('left','right'))) {
		$wrapper_classes[] = 'ib-icon-vertical-'. $icon_vertical;
	}
}

if (in_array($layout,array('round','square'))) {
	$wrapper_classes[] = 'ib-border';
}

if (in_array($layout,array('round','square'))) {
	$wrapper_classes[] = 'ib-background';
}

if (!in_array($icon_style,array('classic')) && $icon_type == 'icon') {
	$wrapper_classes[] = 'ib-effect';
}

if (in_array($layout,array('default','classic','round','round_outline','square','square_outline')) && !empty($description_size)) {
	$wrapper_classes[] = 'ib-des-size-' . $description_size;
}

// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}
if ($layout == 'modern' && !empty($height)) {
	$wrapper_styles[] = 'height:' . $height . 'px;';
}

//parse link
$link_attributes = array();
$link = ( '||' === $link ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'];
} else {
	$a_href = '#';
}

$link_attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
if (!empty($a_title)) {
	$link_attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
}
if ( ! empty( $a_target ) ) {
	$link_attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
}


$read_more_html = '';
if (!empty($read_more)) {
	$read_more_attributes = $link_attributes;
	if (empty($a_title)) {
		$read_more_attributes[] = 'title="' . esc_attr( trim( $read_more ) ) . '"';
	}
	if ($layout != 'modern') {
		$read_more_attributes[] = 'class="text-color-accent"';
	}

	if ($layout == 'modern') {
		$read_more_attributes[] = 'class="btn btn-gray"';
	}

	$read_more_html = '<a '. implode(' ', $read_more_attributes) .'>'. esc_html($read_more) .'</a>';
	if ($layout != 'modern') {
		$read_more_html = '... ' . $read_more_html;
	}
}

$title_html = '';
$title_attributes = $link_attributes;
if ($a_href != '#') {
	if (empty($a_title)) {
		$title_attributes[] = 'title="' . esc_attr( trim( $title ) ) . '"';
	}
	$title_attributes[] = 'class="ib-title"';
	$title_html = '<a '. implode(' ', $title_attributes) .'>'. $title .'</a>';
} else {
	$title_html = '<h3 class="ib-title">' . $title . '</h3>';
}



if ($layout == 'flat') {
	$icon_style = 'classic';
}
$icon_inverted = false;
$icon_style = str_replace('_outline','',$icon_style,$icon_inverted);

$icon_classes = array(
	'ib-icon',
	'ib-icon-' . $icon_style,
	($icon_inverted) ? 'ib-icon-inverted' : ''
);

if (!in_array($icon_style,array('classic')) && $icon_type == 'icon') {
	$icon_classes[] = 'ib-icon-effect';
}

$icon_attributes = array();
$icon_styles = array();
if (!empty($icon_color)) {
	if ($icon_inverted || ($icon_style == 'classic')) {
		$icon_styles[] = 'color:' . $icon_color;
	}

	if (in_array($icon_style,array('square','round'))) {
		if ($icon_inverted) {
			$icon_styles[] = 'border-color:' . $icon_color;
		} else {
			$icon_styles[] = 'background-color:' . $icon_color;
		}
	}
}

if ($icon_styles) {
	$icon_attributes[] = 'style="' . implode('; ', $icon_styles) . '"';
}
// icon html
$icon_html = '';
if ($icon_type == 'image') {
	if (!empty($icon_image)) {
		$icon_image_id = preg_replace( '/[^\d]/', '', $icon_image );
		$icon_image_src = wp_get_attachment_image_src( $icon_image_id, 'full' );
		if ( ! empty( $icon_image_src[0] ) ) {
			$icon_image_src = $icon_image_src[0];
			$icon_html = '<img alt="'. the_title_attribute(array('post' => $icon_image_id,'echo' => false )) .'" src="'. esc_url($icon_image_src) .'">';
		}

	}
} else {
	$icon_html = '<i '. implode(' ',$icon_attributes) .' class="'. esc_attr($icon_font).'"></i>';
}


if (($layout == 'flat') && ($icon_type == 'image') && (!empty($icon_image_src))) {
	$wrapper_styles[] = "background-image:url(". esc_url($icon_image_src) .")";
}

if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode('; ', $wrapper_styles) . '"';
}

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'icon-box', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/icon-box/assets/css/icon-box'.$min_suffix.'.css'), array(), false, 'all');
}



?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<?php if (in_array($layout,array('default','classic','round','square'))): ?>
	<div class="ib-inner">
		<?php if ($icon_align == 'left' || $icon_align == 'center') : ?>
			<div class="<?php echo implode(' ',$icon_classes); ?>">
				<?php echo wp_kses_post($icon_html); ?>
			</div>
		<?php endif; ?>
		<div class="ib-content">
			<?php echo wp_kses_post($title_html); ?>
			<p class="text-color-light">
				<?php echo wp_kses_post($description); ?>
				<?php echo wp_kses_post($read_more_html); ?>
			</p>
		</div>
		<?php if ($icon_align == 'right') : ?>
			<div class="<?php echo implode(' ',$icon_classes); ?>">
				<?php echo wp_kses_post($icon_html); ?>
			</div>
		<?php endif; ?>
	</div>
	<?php elseif ($layout == 'modern'): ?>
	<div class="ib-inner">
		<div class="block-center">
			<div class="block-center-inner">
				<div class="<?php echo implode(' ',$icon_classes); ?>">
					<?php echo wp_kses_post($icon_html); ?>
				</div>
				<?php echo wp_kses_post($title_html); ?>
			</div>
		</div>
	</div>
	<div class="ib-content">
		<div class="block-center">
			<div class="block-center-inner">
				<p>
					<?php echo wp_kses_post($description); ?>
				</p>
				<?php echo wp_kses_post($read_more_html); ?>
			</div>
		</div>
	</div>
	<?php else: ?>
		<?php if ($icon_type == 'icon'): ?>
			<div class="<?php echo implode(' ',$icon_classes); ?>">
				<?php echo wp_kses_post($icon_html); ?>
			</div>
		<?php endif; ?>
		<div class="block-center">
			<div class="block-center-inner">
				<?php echo wp_kses_post($title_html); ?>
				<p class="text-color-light">
					<?php echo wp_kses_post($description); ?>
					<?php echo wp_kses_post($read_more_html); ?>
				</p>
			</div>
		</div>
	<?php endif; ?>
</div>
