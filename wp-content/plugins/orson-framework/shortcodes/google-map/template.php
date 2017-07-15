<?php
/**
 * Created by PhpStorm.
 * User: Kaga
 * Date: 9/6/2016
 * Time: 7:57 AM
 */
/**
 * Shortcode attributes
 * @var $atts
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Google_Map
 */
$api_url = $markers = $lat = $lng = $title = $icon = $description = $map_height = $map_color = $el_class = $css_animation = $duration = $delay = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
wp_enqueue_script('orson-google-api', $api_url, array(), false, true);
$map_id = 'map-' . uniqid();

$wrapper_attributes = array();
$wrapper_styles = array();

$wrapper_classes = array(
	'g5plus-google-map',
	$this->getExtraClass($el_class),
	$this->getCSSAnimation($css_animation),
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}
if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode('; ', $wrapper_styles) . '"';
}
$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

?>
<div id="<?php echo $map_id ?>" class="<?php echo esc_attr($css_class) ?>" style="height:<?php echo esc_attr($map_height) ?>"
	<?php echo implode(' ', $wrapper_attributes); ?>>
</div>
<script>
	jQuery(document).ready(function () {
		var bounds = new google.maps.LatLngBounds();
		var mapStyle = [{
			"featureType": "administrative",
			"elementType": "labels.text.fill",
			"stylers": [{"color": "#444444"}]
		}, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, {
			"featureType": "poi",
			"elementType": "all",
			"stylers": [{"visibility": "off"}]
		}, {
			"featureType": "road",
			"elementType": "all",
			"stylers": [{"saturation": -100}, {"lightness": 45}]
		}, {
			"featureType": "road.highway",
			"elementType": "all",
			"stylers": [{"visibility": "simplified"}]
		}, {
			"featureType": "road.arterial",
			"elementType": "labels.icon",
			"stylers": [{"visibility": "off"}]
		}, {
			"featureType": "transit",
			"elementType": "all",
			"stylers": [{"visibility": "off"}]
		}, {
			"featureType": "water",
			"elementType": "all",
			"stylers": [{"color": '<?php echo esc_attr($map_color) ?>'}, {"visibility": "on"}]
		}];
		var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
		var isDraggable = w > 1024 ? true : false;
		var mapOptions = {
			mapTypeId: 'roadmap',
			styles: mapStyle,
			draggable: isDraggable,
			scrollwheel: false
		};
		var map = new google.maps.Map(document.getElementById("<?php echo $map_id ?>"), mapOptions);
		var markers = [
			<?php
			$markers = (array)vc_param_group_parse_atts($markers);
			$list_marker = '';
			foreach ($markers as $data) {
				$title = isset($data['title']) ? $data['title'] : '';
				$description = isset($data['description']) ? $data['description'] : '';
				$lat = isset($data['lat']) ? $data['lat'] : '';
				$lng = isset($data['lng']) ? $data['lng'] : '';
				$icon = isset($data['icon']) ? $data['icon'] : '';
				$icon_url = '';
				if ($icon != '') {
					$icon = wp_get_attachment_image_src($icon, 'full');
					$icon_url = $icon[0];
				}
				$list_marker .= '["' . $title . '","' . $description . '", ' . $lat . ',' . $lng . ',"' . $icon_url . '"],';
			}
			$list_marker = substr($list_marker, 0, -1);
			echo $list_marker;?>];
		var infoWindow = new google.maps.InfoWindow(), marker, i;
		for (i = 0; i < markers.length; i++) {
			var position = new google.maps.LatLng(markers[i][2], markers[i][3]);
			bounds.extend(position);
			marker = new google.maps.Marker({
				position: position,
				map: map,
				title: markers[i][0],
				icon: markers[i][4],
				animation: google.maps.Animation.DROP
			});
			google.maps.event.addListener(marker, 'click', (function (marker, i) {
				return function () {
					infoWindow.setContent('<h6>' + markers[i][0] + '</h6><div>' + markers[i][1] + '</div>');
					infoWindow.open(map, marker);
					if (marker.getAnimation() !== null) {
						marker.setAnimation(null);
					} else {
						marker.setAnimation(google.maps.Animation.BOUNCE);
					}
				}
			})(marker, i));
			map.fitBounds(bounds);
		}
		var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
			this.setZoom(map.getZoom() - 1);
			if (this.getZoom() > 15) {
				this.setZoom(15);
			}
			google.maps.event.removeListener(boundsListener);
		});
	});
</script>