<?php
global $ourteam_metabox;
global $meta;
$ourteam_item_classes = array_merge($ourteam_item_class, $cate_fitter);
?>
<div class="<?php echo join(' ', $ourteam_item_classes); ?>">
	<div class="content-ourteam-item">
		<div class="top-content-ourteam-item">
			<div class="ourteam-avatar">
				<?php if (!empty($image_src)): ?>
					<div class="avatar">
						<img src="<?php echo esc_url($image_src) ?>" alt="<?php the_title(); ?>"
							 title="<?php the_title(); ?>">
					</div>
				<?php endif;?>
				<div class="social-ourteam"><?php
					$meta = get_post_meta(get_the_id(), $ourteam_metabox->get_the_id(), true);
					if(is_array($meta)) {?>
						<ul>
						<?php foreach ($meta['ourteam'] as $col) {
							$socialName = isset($col['socialName']) ? $col['socialName'] : '';
							$socialLink = isset($col['socialLink']) ? $col['socialLink'] : '';
							$socialIcon = isset($col['socialIcon']) ? $col['socialIcon'] : '';
							?>
							<li><a href="<?php echo esc_url($socialLink) ?>"
								   title="<?php echo esc_attr($socialName) ?>"><i
										class="<?php echo esc_attr($socialIcon) ?>"></i></a>
							</li>
						<?php }?>
						</ul><?php  }?>
				</div>
			</div>
			<h3 class="title"><?php the_title() ?></h3>
			<?php if($job!='') ?><span class="ourteam-job"><?php echo esc_html($job); ?></span>
		</div>
		<div class="ourteam-info">
			<?php if($excerpt!='') ?><p><?php echo esc_html($excerpt); ?></p>
		</div>
	</div>
</div>