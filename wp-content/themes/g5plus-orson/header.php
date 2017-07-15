<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
do_action('g5plus_before_header');
$header = &G5Plus_Global::get_header_var();
$header_layout = $header['header_layout'];
$header_responsive = $header['header_responsive_breakpoint'];
?>
<!DOCTYPE html>
<!-- Open Html -->
<html <?php language_attributes(); ?>>
	<!-- Open Head -->
	<head>
		<?php wp_head(); ?>
	</head>
	<!-- Close Head -->
	<body <?php body_class(); ?> data-responsive="<?php echo esc_attr($header_responsive)?>" data-header="<?php echo esc_attr($header_layout) ?>">

		<?php
			/**
			 * @hooked - g5plus_site_loading - 5
			 **/
			do_action('g5plus_before_page_wrapper');
		?>
		<!-- Open Wrapper -->
		<div id="wrapper">

		<?php
		/**
		 * @hooked - g5plus_before_page_wrapper_content - 10
		 * @hooked - g5plus_page_header - 15
		 **/
		do_action('g5plus_before_page_wrapper_content');
		?>

			<!-- Open Wrapper Content -->
			<div id="wrapper-content" class="clearfix">

			<?php
			/**
			 * @hooked - g5plus_output_content_wrapper - 1
			 **/
			do_action('g5plus_main_wrapper_content_start');
			?>
