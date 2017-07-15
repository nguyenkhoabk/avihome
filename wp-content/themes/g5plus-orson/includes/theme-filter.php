<?php
//////////////////////////////////////////////////////////////////
// Filter Comment Fields
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_comment_form_fields')) {
	function g5plus_comment_form_fields() {
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$commenter = wp_get_current_commenter();
		$html_req = ( $req ? " required='required'" : '' );
		$html5    = 'html5' === current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

		return  array(
			'author' => '<p class="comment-form-field comment-form-author">'.
				'<input placeholder="'. sprintf(esc_attr__('Your Name %s','g5plus-orson'),$req ? '*' : '') .'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
			'email'  => '<p class="comment-form-field comment-form-email">' .
				'<input placeholder="'. sprintf(esc_attr__('Email Address %s','g5plus-orson'),$req ? '*' : '') .'" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
			'url'    => '<p class="comment-form-field comment-form-url">' .
				'<input placeholder="'. esc_attr__('Website','g5plus-orson') .'" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);
	}
	add_filter('comment_form_default_fields','g5plus_comment_form_fields');
}

//////////////////////////////////////////////////////////////////
// Filter Comment Form Args Default
//////////////////////////////////////////////////////////////////
if (!function_exists('g5plus_comment_form_defaults')) {
	function g5plus_comment_form_defaults($defaults) {
		$args = array(
			'comment_field'        => '<p class="comment-form-field comment-form-comment"><textarea placeholder="'. esc_attr__('Your Comment *','g5plus-orson') .'" id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
			'title_reply_before' => '<h4 id="reply-title" class="widget-title mg-top-40"><span>',
			'title_reply_after'  => '</span></h4>',
			'label_submit'         => esc_html__('Post Comment','g5plus-orson'),
			'class_submit' => 'btn btn-sm'
		);
		$defaults = array_merge( $defaults, $args );
		return $defaults;
	}
	add_filter('comment_form_defaults','g5plus_comment_form_defaults');
}


/*---------------------------------------------------
/* SET ONE PAGE MENU
/*---------------------------------------------------*/
if (!function_exists('g5plus_main_menu_one_page_filter')) {
	function g5plus_main_menu_one_page_filter($args) {
		if (isset($args['theme_location']) && ($args['theme_location'] != 'primary') && ($args['theme_location'] != 'mobile')) {
			return $args;
		}
		$is_one_page = g5plus_get_rwmb_meta('is_one_page');
		if ($is_one_page == '1') {
			$args['menu_class'] .= ' menu-one-page';
		}
		return $args;
	}
	add_filter('wp_nav_menu_args','g5plus_main_menu_one_page_filter', 20);
}

/*---------------------------------------------------
/* ADD SEARCH FORM TO BEFORE X-MENU
/*---------------------------------------------------*/
if (!function_exists('g5plus_search_form_before_menu_mobile')) {
	function g5plus_search_form_before_menu_mobile($params) {
		ob_start();
		$header = &G5Plus_Global::get_header_var();
		if ($header['mobile_header_menu_drop'] === 'menu-drop-fly') {
			get_search_form();
		}
		$params .= ob_get_clean();
		return $params;
	}
	add_filter('g5plus_before_menu_mobile_filter','g5plus_search_form_before_menu_mobile', 10);
}
