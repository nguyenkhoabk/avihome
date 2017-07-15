<div class="portfolio-two-columns" id="content">
	<?php if (has_post_thumbnail() || count($meta_values) > 0) : ?>
		<div class="row">
			<div class="col-md-6 col-sm-12 sm-mg-bottom-30 portfolio-images">
				<img alt="portfolio" src="<?php echo esc_url($imgThumbs) ?>"/>
				<?php foreach ($meta_values as $image) {
					$urls = g5plus_get_image_src($image, 'portfolio-single-sm');?>
					<img alt="portfolio" src="<?php echo esc_url($urls) ?>"/>
				<?php } ?>
			</div>
			<div class="col-md-6 col-sm-12 portfolio-content-wrap">
				<div class="portfolio-info">
					<h2 class="g5plus-heading widget-title style_01 text-left dark">
						<span><?php esc_html_e('PROJECT DESCRIPTION', 'g5plus-orson') ?></span></h2>
					<?php the_content() ?>
					<div class="portfolio-meta">
						<?php if(isset( $established_date) && !empty( $established_date )): ?>
							<?php
							$date = date_i18n( get_option( 'date_format' ), strtotime( $established_date ) );
							?>
							<div class="portfolio-date">
								<span class="date-label portfolio-label"><?php esc_html_e('Date:','g5plus-orson'); ?></span>
								<span class="date-value portfolio-value"><?php echo esc_attr( $date ); ?></span>
							</div>
						<?php endif; ?>
						<div class="portfolio-client">
							<span class="client-label portfolio-label"><?php esc_html_e('Client:','g5plus-orson'); ?></span>
							<?php if (!empty($client)):
								if (!empty($client_size)): ?>
									<a href="<?php echo esc_attr($client_size); ?>" title="<?php echo esc_attr($client) ?>">
								<?php endif; ?>
								<span class="client-value portfolio-value"><?php echo esc_attr($client) ?></span>
								<?php if (!empty($client_size)): ?></a><?php endif;
							endif; ?>
						</div>
						<div class="portfolio-cate">
							<span class="cate-label portfolio-label"><?php esc_html_e('Category:','g5plus-orson'); ?></span>
							<?php if (!empty($cate)): ?>
								<?php for ($i = 0; $i < count($cate); $i++) { ?>
									<a href="<?php echo esc_attr($cate_link[$i]); ?>"
									   title="<?php echo esc_attr($cate[$i]); ?>">
										<span class="cate-value portfolio-value"><?php echo esc_attr($cate[$i]); ?></span>
									</a>
									<?php if ($i < count($cate) - 1): ?>,<?php endif; ?>
								<?php } ?>
							<?php endif; ?>
						</div>
						<?php if(count( $meta ) > 0 ):
							foreach ($meta as $values) {?>
								<div class="meta-<?php echo array_search( $values, $meta ); ?>">
									<span class="meta-label portfolio-label"><?php echo esc_html( $values[0] ); ?>:</span>
									<span class="meta-value portfolio-value"><?php echo esc_html( $values[1] ); ?></span>
								</div>
							<?php }
						endif; ?>
					</div>
					<div class="portfolio-activities clearfix">
						<?php if (!empty($portfolio_link)): ?>
							<a href="<?php echo esc_attr($portfolio_link); ?>" class="btn btn-md pull-left"><?php esc_html_e('Live Preview','g5plus-orson'); ?></a>
						<?php endif;
						G5plus_FrameWork::g5plus_get_template('shortcodes/portfolio/templates/single/social-share', array('social_share_class' => 'pull-right')); ?>
					</div>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="portfolio-content-wrap">
			<div class="portfolio-info">
				<h2 class="g5plus-heading widget-title style_01 text-left dark">
					<span><?php esc_html_e('PROJECT DESCRIPTION', 'g5plus-orson') ?></span></h2>
				<?php the_content() ?>
				<div class="portfolio-date">
					<span class="date-label portfolio-label">Date:</span>
					<span class="date-value portfolio-value"><?php the_date(); ?></span>
				</div>
				<div class="portfolio-client">
					<span class="client-label portfolio-label">Client:</span>
					<?php if (!empty($client)):
						if (!empty($client_size)): ?>
							<a href="<?php echo esc_attr($client_size); ?>" title="<?php echo esc_attr($client) ?>">
						<?php endif; ?>
						<span class="client-value portfolio-value"><?php echo esc_attr($client) ?></span>
						<?php if (!empty($client_size)): ?></a><?php endif;
					endif; ?>
				</div>
				<div class="portfolio-cate">
					<span class="cate-label portfolio-label">Category:</span>
					<?php if (!empty($cate)) ?><span
						class="cate-value portfolio-value"><?php echo esc_attr($cate) ?></span>
				</div>
				<div class="portfolio-activities clearfix">
					<?php if (!empty($portfolio_link)): ?>
						<a href="<?php echo esc_attr($portfolio_link); ?>" class="btn btn-md pull-left">Live Preview</a>
					<?php endif;
					G5plus_FrameWork::g5plus_get_template('shortcodes/portfolio/templates/single/social-share', array('social_share_class' => 'pull-right')); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
