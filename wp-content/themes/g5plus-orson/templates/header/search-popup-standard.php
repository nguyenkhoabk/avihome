<?php
/**
 * Search Form Popup
 */
?>
<div id="search_popup_wrapper" class="dialog">
	<div class="dialog__overlay"></div>
	<div class="dialog__content">
		<div class="morph-shape">
			<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 520 280"
			     preserveAspectRatio="none">
				<rect x="3" y="3" fill="none" width="516" height="276"/>
			</svg>
		</div>
		<div class="dialog-inner">
			<h2><?php esc_html_e('Enter your keyword','g5plus-orson'); ?></h2>
			<form  method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-popup-inner">
				<input type="text" name="s" placeholder="<?php esc_html_e('Type and hit enter...','g5plus-orson'); ?>">
				<button type="submit"><?php esc_html_e('Search','g5plus-orson'); ?></button>
			</form>
			<div><a class="action prevent-default" data-dialog-close="close" href="#"><i
						class="pe-7s-close-circle transition03"></i></a></div>
		</div>
	</div>
</div>