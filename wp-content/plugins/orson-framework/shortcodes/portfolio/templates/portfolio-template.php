<?php
$portfolio_item_classes = array_merge($portfolio_item_class, $cate_fitter);
$portfolio_link = get_post_meta(get_the_ID(), 'portfolio-link', true);
$portfolio_open_single_page = get_post_meta(get_the_ID(), 'portfolio-open-single-page', true);
if(!isset( $portfolio_open_single_page ) || $portfolio_open_single_page == '') {
	$portfolio_open_single_page = '1';
}
if(empty( $portfolio_link ) || $portfolio_open_single_page == '1') {
	$portfolio_link = get_the_permalink();
}
?>
<div class="<?php echo join(' ', $portfolio_item_classes); ?>">
	<div
		class="content-portfolio-item content-effect<?php if ($overlay_style == 'portfolio-overlay-none'): ?>  hover-wrap<?php endif; ?>">
		<?php if (!empty($image_src)): ?>
			<div
				class="portfolio-avatar effect-avatar<?php if ($overlay_style == 'portfolio-overlay-none'): ?> hover-content<?php endif; ?>">
				<a <?php if ($overlay_style == 'portfolio-overlay-none'): ?> class="hover-image"<?php endif; ?>
					href="<?php echo esc_url( $portfolio_link ) ?>" title="<?php the_title(); ?>">
					<img src="<?php echo esc_url($image_src) ?>" alt="<?php the_title(); ?>"
						 title="<?php the_title(); ?>">
				</a>
			</div>
		<?php endif;?>
		<div class="portfolio-info effect-info">
			<div class="content-portfolio-info effect-inner">
				<?php if($overlay_style != 'portfolio-overlay-none'): ?>
				<div class="block-center">
					<div class="block-center-inner">
				<?php endif; ?>
						<?php if ($hover_effect != 'default-effect' && $overlay_style == 'portfolio-overlay-title-category-icon'): ?>
							<a href="javascript:;" class="view-gallery" data-post-id="<?php the_ID(); ?>"
							   title="<?php the_title(); ?>">
								<i class="fa fa-search <?php echo esc_attr($icon_color_scheme); ?>"></i></a>
						<?php endif; ?>
						<a href="<?php echo esc_url( $portfolio_link ) ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
						<?php if (!empty($cate_names)): ?>
							<p class="portfolio-category"><?php echo join(', ', $cate_names); ?></p>
						<?php endif;
				if($overlay_style != 'portfolio-overlay-none'): ?>
					</div>
				</div>
				<?php endif;
				if ($hover_effect == 'default-effect' && $overlay_style == 'portfolio-overlay-title-category-icon'):?>
					<a href="javascript:;" class="view-gallery" data-post-id="<?php the_ID(); ?>"
					   title="<?php the_title(); ?>">
						<i class="fa fa-search <?php echo esc_attr($icon_color_scheme); ?>"></i></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>