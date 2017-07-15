<div class="social-profile-share <?php if (!empty($social_share_class)) echo esc_attr($social_share_class); ?>">
	<span class="share-label portfolio-label">Share</span>
	<ul>
		<li>
			<a onclick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo esc_attr(urlencode(get_permalink())); ?>','sharer', 'toolbar=0,status=0,width=620,height=280');"
			   href="javascript:;">
				<i class="fa fa-facebook"></i>
			</a>
		</li>
		<li>
			<a onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_attr(urlencode(get_the_title())); ?> <?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;"
			   href="javascript:;">
				<i class="fa fa-twitter"></i>
			</a>
		</li>
		<li>
			<a href="javascript:;"
			   onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;">
				<i class="fa fa-google-plus"></i>
			</a>
		</li>
		<li>
			<a onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
			echo has_post_thumbnail() ? esc_attr($arrImages[0]) : ""; ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;"
			   href="javascript:;">
				<i class="fa fa-pinterest"></i>
			</a>
		</li>
	</ul>
</div>