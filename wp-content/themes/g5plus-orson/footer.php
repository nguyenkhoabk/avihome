			<?php
			/**
			 * @hooked - g5plus_output_content_wrapper_end - 1
			 **/
			do_action('g5plus_main_wrapper_content_end');
			?>
			</div>
			<!-- Close Wrapper Content -->
			<?php
			$footer = &G5Plus_Global::get_footer_var();
			$main_footer_class = array('main-footer-wrapper');

			if ($footer['footer_parallax']) {
				$main_footer_class[] = 'enable-parallax';
			}

			if ($footer['collapse_footer']) {
				$main_footer_class[] = 'footer-collapse-able';
			}

			$custom_style =  '';
			$footer_bg_image = g5plus_get_meta_box_image('footer_bg_image');
			if ($footer_bg_image) {
				$custom_style = 'style="background-image: url(' . $footer_bg_image . ');"';
			}
			?>

			<?php if ($footer['footer_show_hide'] || $footer['bottom_bar_visible']): ?>
				<footer <?php echo wp_kses_post($custom_style); ?> class="<?php echo join(' ', $main_footer_class) ?>">
					<div id="wrapper-footer">
						<?php
						/**
						 * @hooked - g5plus_footer_template - 10
						 **/
						do_action('g5plus_main_wrapper_footer');
						?>
					</div>
					
			    </footer>
			<?php endif;?>
			</div>
		<!-- Close Wrapper -->

		<?php
		/**
		 * @hooked - g5plus_back_to_top - 5
		 **/
		do_action('g5plus_after_page_wrapper');
		?>
	<?php wp_footer(); ?>
	</body>
</html> <!-- end of site. what a ride! -->