<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $title
 * @var $values
 * @var $units
 * @var $bgcolor
 * @var $custombgcolor
 * @var $customtxtcolor
 * @var $height
 * @var $margin
 * @var $rounded
 * @var $options
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Progress_Bar
 */
$output = $layout_style = $title = $values = $units = $bgcolor = $css = $custombgcolor = $customtxtcolor  = $options = $el_class = '';
$height='1';
$margin='50';
$rounded='0';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts = $this->convertAttributesToNewProgressBar( $atts );

extract( $atts );
wp_enqueue_script( 'waypoints' );

$el_class = $this->getExtraClass( $el_class );

$bar_options = array();
$options = explode( ',', $options );
if ( in_array( 'animated', $options ) ) {
	$bar_options[] = 'animated';
}
if ( in_array( 'striped', $options ) ) {
	$bar_options[] = 'striped';
}

if ( 'custom' === $bgcolor && '' !== $custombgcolor ) {
	$custombgcolor = ' style="' . vc_get_css_color( 'background-color', $custombgcolor ) . '"';
	if ( '' !== $customtxtcolor ) {
		$customtxtcolor = ' style="' . vc_get_css_color( 'color', $customtxtcolor ) . '"';
	}
	$bgcolor = '';
} else {
	$custombgcolor = '';
	$customtxtcolor = '';
	$bgcolor = 'vc_progress-bar-color-' . esc_attr( $bgcolor );
	$el_class .= ' ' . $bgcolor;
}

$class_to_filter = 'vc_progress_bar wpb_content_element ' .esc_attr($layout_style);
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '">';

$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_progress_bar_heading' ) );

$values = (array) vc_param_group_parse_atts( $values );
$max_value = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
	$new_line['bgcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custombgcolor;
	$new_line['txtcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $customtxtcolor;
	$new_line['vc_single_bar'] = isset($new_line['vc_single_bar']) ? $new_line['vc_single_bar'] : '';
	$new_line['vc_label'] = isset($new_line['vc_label']) ? $new_line['vc_label'] : '';
	$new_line['vc_bar'] = isset($new_line['vc_bar']) ? $new_line['vc_bar'] : '';
	if ( isset( $data['customcolor'] ) && ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) ) {
		$new_line['bgcolor'] = ' style="background-color: ' . esc_attr( $data['customcolor'] ) . ';"';
	}
	if ( isset( $data['customtxtcolor'] ) && ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) ) {
		$new_line['txtcolor'] = ' style="color: ' . esc_attr( $data['customtxtcolor'] ) . ';"';
	}

	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	if($margin!='')
	{
		if($layout_style=='style_01'){
			$new_line['vc_single_bar'] .='margin-bottom: ' . ($margin - 23). 'px;';
		}
		else{
			$new_line['vc_single_bar'] .='margin-bottom: ' . $margin. 'px;';
		}
	}
	if($height!='')
	{
		$new_line['vc_label'] .= 'height: ' . $height . 'px; line-height: ' . $height . 'px;';
	}
	if($rounded!='')
	{
		$new_line['vc_single_bar'] .='-webkit-border-radius: ' . $rounded . 'px;-moz-border-radius: ' . $rounded . 'px;border-radius: ' . $rounded . 'px;';
		$new_line['vc_bar'] .='-webkit-border-radius: ' . $rounded . 'px;-moz-border-radius: ' . $rounded . 'px;border-radius: ' . $rounded . 'px;';
	}
	$graph_lines_data[] = $new_line;
}
$bar_width=100 / count($values);
foreach ( $graph_lines_data as $line ) {
	if($layout_style=='style_01'){
		if(!empty($line['label'])){
			$output .= '<span class="progress-bar-title ">' . $line['label'] . '</span>';
		}
		$output .= '<div class="vc_general vc_single_bar' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
				' vc_progress-bar-color-' . $line['color'] : '' )
			. '" style="'. $line['vc_single_bar'].'">';
		$unit = ('' !== $units) ? ' <span class="vc_label_units "'.(( isset($line['valuetxtcolor'])) ? $line['valuetxtcolor'] : '').'><span class="counter" data-counter-config={time:700} >' . $line['value'] .'</span>'. $units . '</span>' : '';
		$output .= '<small class="vc_label" style="' . $line['vc_label'] . '"></small>';
		if ( $max_value > 100.00 ) {
			$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		} else {
			$percentage_value = $line['value'];
		}
		$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . ' style="' . $line['vc_bar'] . '">'. $unit .'</span>';
		$output .= '</div>';
	}
	elseif($layout_style=='v-progress-bar'){
		$unit = ( '' !== $atts['units'] ) ? ' <span class="vc_label_units"'.(( isset($line['valuetxtcolor'])) ? $line['valuetxtcolor'] : '').'>' . $line['value'] . $atts['units'] . '</span>' : '';
		$output .= '<div class="vc_general vc_single_bar' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
				' vc_progress-bar-color-' . $line['color'] : '' )
			. '" style="width:'.$bar_width.'%;'.(( isset($line['bgbarcolor'])) ? $line['bgbarcolor'] : '').'">';
		if ( $max_value > 100.00 ) {
			$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		} else {
			$percentage_value = $line['value'];
		}
		$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . '></span>';
		$output .= '<small class="vc_label"' . $line['txtcolor'] . '>' . $line['label'] . $unit . '</small>';
		$output .= '</div>';
	}
	else{
		$unit = ( '' !== $units ) ? ' <span class="vc_label_units">' . $line['value'] . $units . '</span>' : '';
		$output .= '<div class="vc_general vc_single_bar' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
				' vc_progress-bar-color-' . $line['color'] : '' )
			. '" style="'. $line['vc_single_bar'].'">';
		$output .= '<small class="vc_label" style="' . $line['vc_label'] . '">' . $line['label'] . $unit . '</small>';
		if ( $max_value > 100.00 ) {
			$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		} else {
			$percentage_value = $line['value'];
		}
		$output .= '<span class="vc_bar ' . esc_attr( implode( ' ', $bar_options ) ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . ' style="' . $line['vc_bar'] . '"></span>';
		$output .= '</div>';
	}
}

$output .= '</div>';

echo $output;
