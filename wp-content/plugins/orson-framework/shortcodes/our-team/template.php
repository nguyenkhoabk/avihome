<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $title_style
 * @var $title_size
 * @var $title_align
 * @var $title_scheme
 * @var $layout_style
 * @var $show_tab
 * @var $category
 * @var $item_amount
 * @var $columns
 * @var $page_paging
 * @var $post_per_page
 * @var $is_slider
 * @var $dots
 * @var $arrows
 * @var $arrows_position
 * @var $arrows_style
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $css
 * @var $el_class
 * @var $current_page
 * @var $ajax
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Our_Team
 */
$title = $title_style = $title_size = $title_align = $title_scheme = $layout_style = $show_tab = $category = $item_amount = $columns = $page_paging = $post_per_page = $is_slider = $dots = $arrows = $arrows_position = $arrows_style = $css_animation = $animation_duration = $animation_delay = $css = $el_class = $current_page = $ajax = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);

extract($atts);

$wrapper_attributes = array();
$wrapper_styles = array();
$content_class = array();
$content_attributes = array();
$filter_owl_attributes = array();
$owl_attributes = array();
$filter_class = array('ourteam-filter-group');

$wrapper_classes = array(
	'g5plus-ourteam',
	'heading-' . $title_style,
	$layout_style,
	'clearfix',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation($css_animation)
);

$animation_style = $this->getStyleAnimation($animation_duration, $animation_delay);
if (sizeof($animation_style) > 0) {
	$wrapper_styles = $animation_style;
}
if ($wrapper_styles) {
	$wrapper_attributes[] = 'style="' . implode('; ', $wrapper_styles) . '"';
}

$item_load = $item_amount;
$ourteam_item_class = array('ourteam-item', 'text-center');
if($is_slider) {
	$owl_attributes = array(
		'"autoHeight": true',
		'"dots": ' . ($dots ? 'true' : 'false'),
		'"nav": ' . ($arrows ? 'true' : 'false'),
		'"responsive": {"0" : {"items" : 1, "margin": 0}, "481" : {"items" : '. (($columns >= 2) ? '2' : $columns) .', "margin": '. (($columns >= 2) ? '20' : '0') .'}, "768" : {"items" : '. (($columns >= 3) ? '3' : $columns) .', "margin": 20}, "1200" : {"items" : '. $columns .', "margin": 20}}'
	);
	if ($arrows) {
		$content_class[] = 'owl-nav-'. $arrows_position;
		if (!empty($arrows_style)) {
			$content_class[] = 'owl-nav' . $arrows_style;
		}
	}
	$page_paging = '';
	$content_class[] = 'owl-carousel';
	$content_attributes[] = "data-owl-config='{". implode(', ', $owl_attributes) ."}'";
	if($show_tab || $show_tab == 'true') {
		$filter_owl_attributes[] = "data-layout_style='". $layout_style ."'";
		$filter_owl_attributes[] = "data-columns='". $columns ."'";
		$filter_owl_attributes[] = "data-item_amounts='". $item_amount ."'";
	}
	$filter_class[] ='ourteam-filter-carousel';
	$item_load = $post_per_page = -1;
} else {
	$content_class[] = 'row';
	$content_class[] = 'ourteam-content';
	$col_sm = ($columns == 2)? 'col-sm-6': 'col-sm-4';
	$class_col = 'col-md-' . (12 / $columns) . ' '.$col_sm.' col-xs-6';
	$ourteam_item_class[] = $class_col;
	$ourteam_item_class[] = 'mg-bottom-20';
	$filter_class[] ='ourteam-filter';
}
if($show_tab || $show_tab == 'true') {
	$content_class[] = 'ourteam-tab';
	$category_archive = '';
	if ($ajax == 2) {
		$category_archive = $category;
		$category = '';
	}
}
if(($ajax == 1 || $page_paging != '') && ($post_per_page < $item_amount) || $item_amount == -1) {
	$item_load = $post_per_page;
}
$args = array(
	'posts_per_page' => $item_load,
	'paged' => $current_page,
	'post_type' => G5PLUS_OURTEAM_POST_TYPE,
	'orderby' => 'date',
	'order' => 'ASC',
	'post_status' => 'publish'
);
if ($category != '') {
	$args['tax_query'] = array(
		array(
			'taxonomy' => G5PLUS_OURTEAM_CATEGORY_TAXONOMY,
			'field' => 'slug',
			'terms' => explode(',', $category),
			'operator' => 'IN'
		)
	);
}
$data = new WP_Query($args);
$total_item = $data->found_posts;
$content_class = implode(' ', $content_class);
$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

if (!(defined('G5PLUS_SCRIPT_DEBUG') && G5PLUS_SCRIPT_DEBUG)) {
	$min_suffix_css = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX. 'our-team', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/our-team/assets/css/ourteam' . $min_suffix_css . '.css'), array(), false);
}
$min_suffix_js = G5Plus_Framework_Global::get_option('enable_minifile_js',0) == 1 ? '.min' : '';
wp_enqueue_script(G5PLUS_FRAMEWORK_PREFIX . 'our-team', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/our-team/assets/js/ourteam' . $min_suffix_js . '.js'), array(), false, true);
wp_localize_script(G5PLUS_FRAMEWORK_PREFIX . 'our-team', 'g5plus_ourteam_meta', array(
	'ajax_url' => admin_url('admin-ajax.php?activate-multi=true')
));?>

<div class="<?php echo esc_attr($css_class); ?>" <?php echo implode(' ', $wrapper_attributes); ?>><?php
	$this->the_title($title,$title_style,$title_size,$title_align,$title_scheme);
	if ($show_tab || $show_tab == 'true') {
		$filter_id = rand(); ?>
		<select class="active-sm ourteam-filter-group">
			<option value="*"><?php esc_html_e('SHOW ALL', 'g5plus-orson') ?></option>
			<?php if ($category != '') {
				$categories = explode(',', $category);
				foreach ($categories as $cat) { ?>
					<option
						value=".<?php echo $cat ?>"><?php echo strtoupper(get_term_by('slug', $cat, G5PLUS_OURTEAM_CATEGORY_TAXONOMY)->name); ?></option>
				<?php }
			} else {
				$categories = get_categories(array('taxonomy' => G5PLUS_OURTEAM_CATEGORY_TAXONOMY,'hide_empty' => false,'orderby' => 'ASC'));
				if (is_array($categories)) {
					foreach ($categories as $cat) { ?>
						<option value=".<?php echo $cat->slug ?>"><?php echo strtoupper($cat->name) ?></option>
					<?php }
				}
			}?>
		</select>
		<div <?php echo implode(' ', $filter_owl_attributes); ?> data-filter_id="<?php echo esc_attr($filter_id); ?>"
				class="hidden-sm <?php echo implode(' ', $filter_class); ?> <?php if ($category_archive != ''): ?> filter-archive"
				data-active=".<?php echo esc_attr($category_archive); ?><?php endif; ?>">
			<a data-filter="*" class="btn btn-sm" style="cursor: not-allowed">
				<?php esc_html_e('SHOW ALL', 'g5plus-orson') ?>
				<i class="fa fa-plus"></i></a>
			<?php if($category != '') {
				$categories = explode(',', $category);
				foreach ($categories as $cat) {
					?>
					<a class="btn btn-sm btn-light" data-filter=".<?php echo $cat ?>">
						<?php echo strtoupper(get_term_by('slug', $cat, G5PLUS_OURTEAM_CATEGORY_TAXONOMY)->name); ?>
						<i class="fa fa-plus"></i></a>
				<?php }
			} else {
				$categories = get_categories(array('taxonomy' => G5PLUS_OURTEAM_CATEGORY_TAXONOMY,'hide_empty' => false,'orderby' => 'ASC'));
				if (is_array($categories)) {
					foreach ($categories as $cat) {
						?>
						<a class="btn btn-sm btn-light" data-filter=".<?php echo $cat->slug ?>">
							<?php echo strtoupper($cat->name) ?>
							<i class="fa fa-plus"></i></a>
					<?php }
				}
			} ?>
		</div>
	<?php }
	?>
	<div class="<?php echo esc_attr($content_class); ?>" <?php echo implode(' ', $content_attributes); ?>>
		<?php if ($data->have_posts()) :
			while ($data->have_posts()): $data->the_post();
				$job = get_post_meta(get_the_ID(), 'job', true);
				$excerpt = get_the_excerpt();
				$attach_id = get_post_thumbnail_id();
				$category1 = get_the_terms( get_the_ID(), G5PLUS_OURTEAM_CATEGORY_TAXONOMY );
				$cate_fitter = array();
				if($category1) {
					foreach($category1 as $str) {
						$cate_fitter[] = $str->slug;
					}
				}
				$image_src = g5plus_get_image_src($attach_id,'ourteam-image');
				G5plus_FrameWork::g5plus_get_template('shortcodes/our-team/templates/layout-'.$layout_style,
					array('job' => $job, 'excerpt' => $excerpt, 'image_src' => $image_src, 'ourteam_item_class' => $ourteam_item_class, 'cate_fitter'=>$cate_fitter));
			endwhile;
		else: ?>
			<div class="item-not-found"><?php esc_html_e('No item found','g5plus-orson'); ?></div><?php
		endif;
		?>
	</div>
	<?php if($page_paging == 'load-more' && (($post_per_page * $current_page < $item_amount) ||($item_amount == -1 && ($post_per_page * $current_page < $total_item)))) :?>
		<div class="clearfix text-center">
			<button data-current_page="<?php echo (esc_attr($current_page) + 1) ?>"
			   data-columns="<?php echo esc_attr($columns)?>"
			   data-category="<?php echo esc_attr($category) ?>"
			   data-post_per_page="<?php echo esc_attr($post_per_page)?>"
			   data-layout_style="<?php echo esc_attr($layout_style)?>"
			   data-loading-text="<span class='fa fa-spinner fa-spin'></span> <?php esc_html_e('Loading...','g5plus-orson'); ?>"
			   class="ot-load-more btn btn-sm">
					<?php esc_html_e('LOAD MORE','g5plus-orson'); ?>
			</button>
		</div>
	<?php endif;  ?>
</div>
<?php
wp_reset_postdata();
