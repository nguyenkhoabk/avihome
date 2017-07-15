<div class="portfolio-video-layout" id="content">
	<?php if (!empty($video)): ?>
		<div class="entry-thumb-wrap">
			<?php if (wp_oembed_get($video)) :
				if (!has_post_thumbnail()) : ?>
					<div class="embed-responsive embed-responsive-portfolio">
						<?php echo wp_oembed_get($video, array('wmode' => 'transparent')); ?>
					</div>
				<?php else: ?>
					<div class="entry-thumbnail portfolio-video">
						<img alt="portfolio" src="<?php echo esc_url($imgThumbs) ?>"/>
						<a class="view-video" href="javascript:" data-src="<?php echo esc_url($video); ?>">
							<i class="fa fa-play"></i>
						</a>
					</div>
				<?php endif;
			else : ?>
				<div class="embed-responsive embed-responsive-portfolio">
					<?php echo wp_kses_post($video) ?>
				</div>
			<?php endif; ?>
		</div>
	<?php
	else:
		if (has_post_thumbnail()) {
			?>
			<div class="portfolio-thumbnail">
				<img alt="portfolio" src="<?php echo esc_url($imgThumbs) ?>"/>
			</div>
		<?php
		}
	endif; ?>
	<div class="row portfolio-content-wrap">
		<div class="col-md-6 col-sm-12">
			<div class="portfolio-info">
				<h2 class="widget-title style_02">
					<span><?php esc_html_e('Project Description', 'g5plus-orson') ?></span></h2>
				<?php the_content() ?>
			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="portfolio-info-detail">
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
						<?php if(!empty($client)): ?>
							<?php if(!empty($client_size)): ?>
								<a href="<?php echo esc_attr($client_size); ?>" title="<?php echo esc_attr($client) ?>">
							<?php endif; ?>
							<span class="client-value portfolio-value"><?php echo esc_attr($client) ?></span>
							<?php if(!empty($client_size)): ?></a><?php endif; ?>
						<?php endif; ?>
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
					<?php if(!empty($portfolio_link)): ?>
						<a href="<?php echo esc_attr($portfolio_link); ?>" class="btn btn-md pull-left"><?php esc_html_e('Live Preview','g5plus-orson'); ?></a>
					<?php endif; ?>
					<?php G5plus_FrameWork::g5plus_get_template('shortcodes/portfolio/templates/single/social-share',array('social_share_class'=>'pull-right')); ?>
				</div>
			</div>
		</div>
	</div>
</div>