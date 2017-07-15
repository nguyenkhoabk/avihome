<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/19/2015
 * Time: 3:59 PM
 */
/*---------------------------------------------------
/* SEARCH AJAX
/*---------------------------------------------------*/
if (!function_exists('g5plus_result_search_callback')) {
	function g5plus_result_search_callback()
	{
		$posts_per_page = G5Plus_Global::get_option('search_popup_result_amount', 8);
		if (!$posts_per_page) {
			$posts_per_page = 8;
		}
		$search_popup_post_type = G5Plus_Global::get_option('search_popup_post_type', array());
		$post_type = array();
		foreach ($search_popup_post_type as $key => $value) {
			if ($value == 1) {
				$post_type[] = $key;
			}
		}

		$keyword = $_REQUEST['keyword'];

		$search_query = array(
			's'              => $keyword,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_status'    => 'publish',
			'posts_per_page' => $posts_per_page + 1,
		);
		if ($post_type) {
			$search_query['post_type'] = $post_type;
		}
		$search = new WP_Query($search_query);
		$count = 0;
		ob_start();
		?>
		<ul>
			<?php if ($search && count($search->posts) > 0):; ?>
				<?php foreach ($search->posts as $post): ?>
					<?php if ($count < $posts_per_page): ?>
						<li<?php echo $count == 0 ? ' class="selected"' : ''; ?>><a
								href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a>
							<span class="date"><i
									class="fa fa-calendar"></i> <?php echo get_the_date('', $post); ?></span></li>
					<?php endif; ?>
					<?php $count++; ?>
				<?php endforeach; ?>
			<?php else:; ?>
				<li class="nothing"><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'g5plus-orson'); ?></li>
			<?php endif; ?>
		</ul>
		<?php if ($count == $posts_per_page + 1): ?>
		<div class="view-more">
			<a href="<?php echo esc_url(home_url('/') . '?s=' . $keyword); ?>"><?php esc_html_e('View More', 'g5plus-orson'); ?></a>
		</div>
	<?php endif; ?>
		<?php
		echo ob_get_clean();
		die(); // this is required to return a proper result
	}

	add_action('wp_ajax_nopriv_result_search', 'g5plus_result_search_callback');
	add_action('wp_ajax_result_search', 'g5plus_result_search_callback');

}

if (!function_exists('g5plus_result_search_product_callback')) {
	function g5plus_result_search_product_callback()
	{
		$posts_per_page = G5Plus_Global::get_option('search_box_result_amount', 3);

		$keyword = $_REQUEST['keyword'];
		$cate_id = isset($_REQUEST['cate_id']) ? $_REQUEST['cate_id'] : '-1';

		$search_query = array(
			's'              => $keyword,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'post_status'    => 'publish',
			'post_type'      => array('product'),
			'posts_per_page' => $posts_per_page + 1,
		);
		if (isset($cate_id) && ($cate_id != -1)) {
			$search_query ['tax_query'] = array(array(
				'taxonomy'         => 'product_cat',
				'terms'            => array($cate_id),
				'include_children' => true,
			));
		}

		$search = new WP_Query($search_query);
		$count = 0;
		ob_start();
		?>
		<ul>
			<?php if ($search && count($search->posts) > 0): ?>
				<?php foreach ($search->posts as $post): ?>
					<?php $product = new WC_Product($post->ID);; ?>
					<?php if ($count < $posts_per_page): ?>
						<li<?php echo $count == 0 ? ' class="selected"' : ''; ?>>
							<a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
								<?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
								<span class="product-title"><?php echo esc_html($post->post_title); ?></span>
							</a>
							<div class="product-price"><?php echo wp_kses_post($product->get_price_html()); ?></div>
						</li>
					<?php endif; ?>
					<?php $count++; ?>
				<?php endforeach; ?>
			<?php else:; ?>
				<li class="nothing"><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'g5plus-orson'); ?></li>
			<?php endif; ?>
		</ul>
		<?php if ($count == $posts_per_page + 1): ?>
			<?php
			$category = get_term_by('id', $cate_id, 'product_cat', 'ARRAY_A');
			$cate_slug = isset($category['slug']) ? '&amp;product_cate=' . $category['slug'] : '';
			?>
			<div class="view-more">
				<a href="<?php echo esc_url(home_url('/') . '?s=' . $keyword . $cate_slug.'&amp;post_type=product'); ?>"><?php esc_html_e('View More', 'g5plus-orson'); ?></a>
			</div>
		<?php endif; ?>
		<?php
		echo ob_get_clean();
		die(); // this is required to return a proper result
	}

	add_action('wp_ajax_nopriv_result_search_product', 'g5plus_result_search_product_callback');
	add_action('wp_ajax_result_search_product', 'g5plus_result_search_product_callback');
}

/*---------------------------------------------------
/* DEV LESS TO CSS
/*---------------------------------------------------*/
if (!function_exists('g5plus_dev_less_to_css')) {
	function g5plus_dev_less_to_css()
	{
		/**
		 * Make sure we set the correct MIME type
		 */
		header('Content-Type: text/css');

		echo g5plus_get_less_to_css();


		$path_scan = G5PLUS_THEME_DIR . 'theme-plugins/orson-framework/shortcodes/';
		$path_to_assets = '/assets/css/';
		$root_files = scandir($path_scan);
		$css_variable = g5plus_custom_css_variable();

		if (!class_exists('Less_Parser')) {
			require_once G5PLUS_THEME_DIR . 'g5plus-framework/less/Less.php';
		}
		foreach ($root_files as $entry) {
			if (($entry === '.') || ($entry === '..')) {
				continue;
			}
			if (is_dir($path_scan . $entry)) {
				// Process assets/file
				if (file_exists("$path_scan$entry$path_to_assets")) {
					$less_arr = scandir("$path_scan$entry$path_to_assets");
					foreach ($less_arr as $less_file) {
						if (($less_file === '.') || ($less_file === '..')) {
							continue;
						}
						if (is_dir("$path_scan$entry$path_to_assets$less_file")) {
							continue;
						}
						$less_file_exp = explode('.', $less_file);
						$file_ex = array_pop($less_file_exp);
						if ('less' === $file_ex) {
							$parser = new Less_Parser(array('compress' => true));
							$parser->parse($css_variable);
							$parser->parseFile(G5PLUS_THEME_DIR . 'assets/less/variable.less');
							$parser->parseFile("$path_scan$entry$path_to_assets$less_file");
							echo $parser->getCss();
						}
					}
				}
			}
		}
		die();
	}

	add_action('wp_ajax_g5plus_dev_less_to_css', 'g5plus_dev_less_to_css');
	add_action('wp_ajax_nopriv_g5plus_dev_less_to_css', 'g5plus_dev_less_to_css');
}

/*---------------------------------------------------
/* DEV LESS TO CSS RTL
/*---------------------------------------------------*/
if (!function_exists('g5plus_dev_less_to_css_rtl')) {
	function g5plus_dev_less_to_css_rtl()
	{
		/**
		 * Make sure we set the correct MIME type
		 */
		header('Content-Type: text/css');
		echo g5plus_get_less_to_css_rtl();
		die();
	}
	add_action('wp_ajax_g5plus_dev_less_to_css_rtl', 'g5plus_dev_less_to_css_rtl');
	add_action('wp_ajax_nopriv_g5plus_dev_less_to_css_rtl', 'g5plus_dev_less_to_css_rtl');
}

/*---------------------------------------------------
/* DEV LESS TO CSS TTA
/*---------------------------------------------------*/
if (!function_exists('g5plus_dev_less_to_css_tta')) {
	function g5plus_dev_less_to_css_tta()
	{
		/**
		 * Make sure we set the correct MIME type
		 */
		header('Content-Type: text/css');
		echo g5plus_get_less_to_css_tta();
		die();
	}
	add_action('wp_ajax_g5plus_dev_less_to_css_tta', 'g5plus_dev_less_to_css_tta');
	add_action('wp_ajax_nopriv_g5plus_dev_less_to_css_tta', 'g5plus_dev_less_to_css_tta');
}



/*---------------------------------------------------
/* Product Quick View
/*---------------------------------------------------*/
if (!function_exists('g5plus_product_quick_view_callback')) {
	function g5plus_product_quick_view_callback()
	{
		$product_id = $_REQUEST['id'];
		global $post, $product, $woocommerce;
		$post = get_post($product_id);
		setup_postdata($post);
		$product = wc_get_product($product_id);
		wc_get_template_part('content-product-quick-view');
		wp_reset_postdata();
		die();
	}

	add_action('wp_ajax_nopriv_product_quick_view', 'g5plus_product_quick_view_callback');
	add_action('wp_ajax_product_quick_view', 'g5plus_product_quick_view_callback');
}

/*---------------------------------------------------
/* Blog Comment Like
/*---------------------------------------------------*/
if (!function_exists('g5plus_blog_comment_like_callback')) {
	function g5plus_blog_comment_like_callback()
	{
		$id = $_REQUEST['id'];
		$like_count = get_comment_meta($id, 'g5plus-like', true) == '' ? 0 : get_comment_meta($id, 'g5plus-like', true);
		$like_count += 1;
		update_comment_meta($id, 'g5plus-like', $like_count);
		echo json_encode($like_count);
		die();
	}

	add_action('wp_ajax_nopriv_blog_comment_like', 'g5plus_blog_comment_like_callback');
	add_action('wp_ajax_blog_comment_like', 'g5plus_blog_comment_like_callback');
}



