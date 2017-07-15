<?php
/**
 * The template for displaying social share
 *
 * @package WordPress
 * @subpackage Orson
 * @since Orson 1.0
 */
$g5plus_options = &G5Plus_Global::get_options();
$sharing_facebook = isset($g5plus_options['social_sharing']['facebook']) ? $g5plus_options['social_sharing']['facebook'] : 0;
$sharing_twitter = isset($g5plus_options['social_sharing']['twitter']) ? $g5plus_options['social_sharing']['twitter'] : 0;
$sharing_google = isset($g5plus_options['social_sharing']['google']) ? $g5plus_options['social_sharing']['google'] : 0;
$sharing_linkedin = isset($g5plus_options['social_sharing']['linkedin']) ? $g5plus_options['social_sharing']['linkedin'] : 0;
$sharing_tumblr = isset($g5plus_options['social_sharing']['tumblr']) ? $g5plus_options['social_sharing']['tumblr'] : 0;
$sharing_pinterest = isset($g5plus_options['social_sharing']['pinterest']) ? $g5plus_options['social_sharing']['pinterest'] : 0;
if(!$sharing_facebook && !$sharing_twitter && !$sharing_google && !$sharing_linkedin && !$sharing_tumblr && !$sharing_pinterest) return;
?>
<div class="social-share">
	<label class="label"><?php esc_html_e('Share This Post','g5plus-orson'); ?></label>
	<?php if ($sharing_facebook == 1) : ?>
		<a onclick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo esc_attr(urlencode(get_permalink()));?>','sharer', 'toolbar=0,status=0,width=620,height=280');"  href="javascript:;">
			<i class="fa fa-facebook"></i>
		</a>
	<?php endif; ?>

	<?php if ($sharing_twitter == 1) :  ?>
		<a onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_attr(urlencode(get_the_title())); ?> <?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;"  href="javascript:;">
			<i class="fa fa-twitter"></i>
		</a>
	<?php endif; ?>

	<?php if ($sharing_google == 1) :  ?>
		<a  href="javascript:;" onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;">
			<i class="fa fa-google-plus"></i>
		</a>
	<?php endif; ?>

	<?php if ($sharing_linkedin == 1):?>
		<a  onclick="popUp=window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;title=<?php echo esc_attr(urlencode(get_the_title())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
			<i class="fa fa-linkedin"></i>
		</a>
	<?php endif; ?>

	<?php if ($sharing_tumblr == 1) :  ?>
		<a onclick="popUp=window.open('http://www.tumblr.com/share/link?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;name=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_excerpt())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
			<i class="fa fa-tumblr"></i>
		</a>

	<?php endif; ?>

	<?php if ($sharing_pinterest == 1) :  ?>
		<a onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo has_post_thumbnail() ? esc_attr($arrImages[0])  : "" ; ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
			<i class="fa fa-pinterest"></i>
		</a>
	<?php endif; ?>
</div>
