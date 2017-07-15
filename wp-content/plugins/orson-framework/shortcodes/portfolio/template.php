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
 * @var $color_scheme
 * @var $data_source
 * @var $category
 * @var $portfolio_names
 * @var $show_category
 * @var $category_display
 * @var $columns
 * @var $items
 * @var $show_pagging
 * @var $item_per_page
 * @var $dots
 * @var $arrows
 * @var $arrows_position
 * @var $arrows_style
 * @var $column_padding
 * @var $image_size
 * @var $overlay_style
 * @var $icon_color_scheme
 * @var $hover_effect
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $css
 * @var $el_class
 * @var $current_page
 * @var $ajax
 * @var $post_not_in
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Portfolio
 */
$title = $title_style = $title_size = $title_align = $title_scheme = $layout_style = $color_scheme = $data_source = $category = $portfolio_names = $show_category = $category_display = $columns = $items = $show_pagging = $item_per_page = $dots = $arrows = $arrows_position = $arrows_style = $column_padding = $image_size = $overlay_style = $icon_color_scheme = $hover_effect = $css_animation = $animation_duration = $animation_delay = $css = $el_class = $current_page = $ajax = $post_not_in = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$wrapper_attributes = array();
$wrapper_styles = array();
$content_class = array($overlay_style, 'clearfix');
$content_attributes = array();
$filter_class = array('portfolio-filter-group');
$filter_owl_attributes = array();
$owl_attributes = array();
$wrapper_classes = array(
	'g5plus-portfolio',
	$layout_style,
	$color_scheme,
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
$item_load = $items;
$portfolio_item_class = array('portfolio-item', 'text-left');

if($layout_style == 'portfolio-slider') {
	$item_padding = 0;
	if($column_padding=='20px') {
		$item_padding = 20;
	}
	$owl_attributes = array(
		'"autoHeight": true',
		'"dots": ' . ($dots ? 'true' : 'false'),
		'"nav": ' . ($arrows ? 'true' : 'false'),
		'"responsive": {"0" : {"items" : 1, "margin": 0}, "480" : {"items" : '. (($columns >= 2) ? '2' : $columns) .', "margin": '. (($columns >= 2) ? $item_padding : '0').'}, "768" : {"items" : '. (($columns >= 3) ? '3' : $columns) .', "margin": '. $item_padding .'}, "1200" : {"items" : '. $columns .', "margin": '. $item_padding .'}}'
	);
	if ($arrows) {
		$content_class[] = 'owl-nav-'. $arrows_position;
		if (!empty($arrows_style)) {
			$content_class[] = 'owl-nav-' . $arrows_style;
		}
	}
	$show_pagging = '';
	$content_class[] = 'owl-carousel';
	$content_attributes[] = "data-owl-config='{". implode(', ', $owl_attributes) ."}'";
	if($show_category == 'left' || $show_category == 'center') {
		$filter_owl_attributes[] = "data-overlay_style='". $overlay_style ."'";
		$filter_owl_attributes[] = "data-hover_effect='" . $hover_effect . "'";
		$filter_owl_attributes[] = "data-columns='". $columns ."'";
		$filter_owl_attributes[] = "data-icon_color_scheme='". $icon_color_scheme ."'";
		$filter_owl_attributes[] = "data-image_size='". $image_size ."'";
		$filter_owl_attributes[] = "data-padding='". $column_padding ."'";
	}
	$filter_class[] = 'portfolio-filter-carousel';
} else {
	$content_class[] = 'portfolio-content';
	$class_col = 'col-md-' . (12 / $columns) . ' col-sm-6 col-xs-6';
	$portfolio_item_class[] = $class_col;
	if($column_padding=='') {
		$content_class[] = 'row-no-padding';
	} else {
		$content_class[] = 'row';
		if($overlay_style != 'portfolio-overlay-none') {
			$portfolio_item_class[] = 'mg-bottom-20';
		}
	}
	$filter_class[] = 'portfolio-filter';
}
$category_archive = '';
if($show_category == 'left' || $show_category == 'center') {
	$filter_class[] = 'portfolio-category-'.$show_category.$category_display;
	$content_class[] = 'portfolio-category';
	if ($ajax == "3") {
		$category_archive = $category;
		$category = '';
	}
}
if($show_pagging != '') {
	$content_class[] = 'portfolio-loadmore';
}
if(($ajax == "1" || $show_pagging != '') && ($item_per_page < $items) || $items == -1) {
	$item_load = $item_per_page;
}
if($ajax == "2") $item_load=-1;

if ($overlay_style != 'portfolio-overlay-none') {
	$content_class[] = $hover_effect;
	$content_class[] = 'effect-wrap';
}
$args = array(
	'post__not_in' => array($post_not_in),
	'posts_per_page' => $item_load,
	'paged' => $current_page,
	'post_type' => G5PLUS_PORTFOLIO_POST_TYPE,
	'orderby' => 'date',
	'order' => 'ASC',
	'post_status' => 'publish'
);
if ($category != '') {
	$args['tax_query'] = array(
		array(
			'taxonomy' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY,
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
	$min_suffix = G5Plus_Framework_Global::get_option('enable_minifile_css',0) == 1 ? '.min' : '';
	wp_enqueue_style(G5PLUS_FRAMEWORK_PREFIX . 'orson-portfolio-css', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/portfolio/assets/css/portfolio' . $min_suffix . '.css'), array(), false);
}
$min_suffix_js = G5Plus_Framework_Global::get_option('enable_minifile_js',0) == 1 ? '.min' : '';
wp_enqueue_script(G5PLUS_FRAMEWORK_PREFIX . 'orson-portfolio', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME . '/shortcodes/portfolio/assets/js/portfolio' . $min_suffix_js . '.js'), false, true);
wp_localize_script(G5PLUS_FRAMEWORK_PREFIX . 'orson-portfolio', 'g5plus_portfolio_meta', array(
	'ajax_url' => admin_url('admin-ajax.php?activate-multi=true')
));
$container_class = '';
if ($post_not_in == '') {
	$container_class = 'container portfolio-container';
}?>

<div class="<?php echo esc_attr($css_class); ?>" <?php echo implode(' ', $wrapper_attributes); ?>>
	<div <?php if ($container_class != '') ?>class="<?php echo esc_attr($container_class); ?>">
		<?php $this->the_title($title,$title_style,$title_size,$title_align,$title_scheme);
		if ($show_category == 'left' || $show_category == 'center') {
			$filter_id = rand(); ?>
			<div
				data-filter_id="<?php echo esc_attr( $filter_id ); ?>" <?php echo implode( ' ', $filter_owl_attributes ); ?>
				class="hidden-sm <?php echo implode(' ', $filter_class); ?><?php if ($category_archive != ''): ?> filter-archive"
				data-active=".<?php echo esc_attr($category_archive); ?><?php endif; ?>">
				<?php if($category_display=='-tab'): ?>
					<a data-filter="*" class="filter-tab filter-active" style="cursor: not-allowed">
						<?php esc_html_e('ALL PROJECTS', 'g5plus-orson') ?>
						<i class="fa fa-plus"></i></a>
				<?php else: ?>
					<a data-filter="*" class="btn btn-sm" style="cursor: not-allowed">
						<?php esc_html_e('ALL PROJECTS', 'g5plus-orson') ?>
						<i class="fa fa-plus"></i></a>
				<?php endif;
				if($category != '') {
					$categories = explode(',', $category);
					foreach ($categories as $cat) {
						if($category_display=='-tab'): ?>
							<a class="filter-tab" data-filter=".<?php echo $cat ?>">
								<?php echo strtoupper(get_term_by('slug', $cat, G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY)->name); ?>
								<i class="fa fa-plus"></i></a>
						<?php else: ?>
							<a class="btn btn-sm btn-light" data-filter=".<?php echo $cat ?>">
								<?php echo strtoupper(get_term_by('slug', $cat, G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY)->name); ?>
								<i class="fa fa-plus"></i></a>
						<?php endif;
					}
				} else {
					$categories = get_categories(array( 'taxonomy' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY,'hide_empty' => false,'orderby' => 'ASC'));
					if (is_array($categories)) {
						foreach ($categories as $cat) {
							$filter_id = rand();
							if($category_display=='-tab'): ?>
								<a class="filter-tab" data-filter=".<?php echo $cat->slug ?>">
									<?php echo strtoupper($cat->name) ?>
									<i class="fa fa-plus"></i></a>
							<?php else: ?>
								<a class="btn btn-sm btn-light" data-filter=".<?php echo $cat->slug ?>">
									<?php echo strtoupper($cat->name) ?>
									<i class="fa fa-plus"></i></a>
							<?php endif;
						}
					}
				} ?>
			</div>
			<select class="active-sm <?php echo implode(' ', $filter_class); ?>">
				<option value="*"><?php esc_html_e('ALL PROJECTS', 'g5plus-orson') ?></option>
				<?php if ($category != '') {
					$categories = explode(',', $category);
					foreach ($categories as $cat) {
						?>
						<option
							value=".<?php echo $cat ?>"><?php echo strtoupper(get_term_by('slug', $cat, G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY)->name); ?></option>
					<?php
					}
				} else {
					$categories = get_categories(array('taxonomy' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY,'hide_empty' => false, 'orderby' => 'ASC'));
					if (is_array($categories)) {
						foreach ($categories as $cat) {
							?>
							<option value=".<?php echo $cat->slug ?>"><?php echo strtoupper($cat->name) ?></option>
						<?php
						}
					}
				}?>
			</select>
		<?php }?>
	</div>
	<div class="<?php echo esc_attr($content_class); ?>" <?php echo implode(' ', $content_attributes); ?>>
		<?php if ($data->have_posts()) :
			while ($data->have_posts()): $data->the_post();
				$attach_id = get_post_thumbnail_id();
				$category1 = get_the_terms( get_the_ID(), G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY );
				$cate_fitter = array();
				$cate_names = array();
				if($category1) {
					foreach($category1 as $str) {
						$cate_fitter[] = $str->slug;
						$cate_names[] = $str->name;
					}
				}
				$image_src = g5plus_get_image_src($attach_id,$image_size);
				$image_src_arr = wp_get_attachment_image_src( $attach_id, 'full' );
				if ($image_src_arr) {
					$image_src_full = $image_src_arr[0];
				}
				G5plus_FrameWork::g5plus_get_template('shortcodes/portfolio/templates/portfolio-template',
					array('overlay_style' => $overlay_style, 'icon_color_scheme' => $icon_color_scheme, 'image_src' => $image_src, 'portfolio_item_class' => $portfolio_item_class, 'cate_fitter' => $cate_fitter, 'cate_names' => $cate_names, 'image_src_full' => $image_src_full, 'hover_effect' => $hover_effect));
			endwhile;
		else: ?>
			<div class="item-not-found"><?php esc_html_e('No item found','g5plus-orson'); ?></div><?php
		endif; ?>
	</div>
	<?php if($show_pagging == 'load-more' && (($item_per_page * $current_page < $items) ||($items == -1 && ($item_per_page * $current_page < $total_item)))) :?>
		<div class="clearfix text-center">
			<button data-current_page="<?php echo (esc_attr($current_page) + 1) ?>"
					data-columns="<?php echo esc_attr($columns)?>"
					data-category="<?php echo esc_attr($category) ?>"
					data-item_per_page="<?php echo esc_attr($item_per_page)?>"
					data-overlay_style="<?php echo esc_attr($overlay_style)?>"
					data-icon_color_scheme="<?php echo esc_attr($icon_color_scheme)?>"
					data-image_size="<?php echo esc_attr($image_size)?>"
					data-padding="<?php echo esc_attr($column_padding)?>"
					data-loading-text="<span class='fa fa-spinner fa-spin'></span> <?php esc_html_e('Loading...','g5plus-orson'); ?>"
					class="portfolio-load-more btn btn-md">
				<?php esc_html_e('LOAD MORE','g5plus-orson'); ?>
			</button>
		</div>
	<?php endif;  ?>
</div>
<?php
wp_reset_postdata();