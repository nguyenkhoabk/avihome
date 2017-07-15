<?php
if (!function_exists('gf_get_image_src')) {
	function gf_get_image_src($image_id, $size) {
		if (function_exists('g5plus_get_image_src')) {
			return g5plus_get_image_src($image_id, $size);
		}
		return '';
	}
}