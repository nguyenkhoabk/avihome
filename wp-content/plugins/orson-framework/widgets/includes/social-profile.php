<?php
//==============================================================================
// SOCIAL PROFILE WIDGET
//==============================================================================
if (!class_exists('G5Plus_Widget_Social_Profile')) {
	class G5Plus_Widget_Social_Profile extends G5Plus_Widget
	{
		public function __construct()
		{
			$this->widget_cssclass = 'widget-social-profile';
			$this->widget_description = esc_html__("Social profile widget", 'g5plus-orson');
			$this->widget_id = 'g5plus_social_profile';
			$this->widget_name = esc_html__('G5Plus - Social Profile', 'g5plus-orson');
			$this->settings = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__('Title', 'g5plus-orson')
				),
				'follow_text' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__('Follow Text', 'g5plus-orson')
				),
				'icons' => array(
					'type'    => 'multi-select',
					'label'   => esc_html__('Select social profiles', 'g5plus-orson'),
					'std'     => '',
					'options' => $this->get_profiles()
				),
				'style' => array(
					'type'    => 'select',
					'label'   => esc_html__('Style', 'g5plus-orson'),
					'std'     => 'classic',
					'options' => array(
						'classic' => esc_html__('Classic', 'g5plus-orson'),
						'circle'  => esc_html__('Circle', 'g5plus-orson'),
					)
				)
			);
			parent::__construct();
		}

		function widget($args, $instance)
		{
			if ( $this->get_cached_widget( $args ) ) {
				return;
			}
			extract($args, EXTR_SKIP);
			$title = (!empty($instance['title'])) ? $instance['title'] : '';
			$follow_text = (!empty($instance['follow_text'])) ? $instance['follow_text'] : '';
			$icons = (!empty($instance['icons'])) ? $instance['icons'] : '';
			$style = (!empty($instance['style'])) ? $instance['style'] : 'classic';
			$social_profiles = array();
			if (function_exists('g5plus_get_social_profiles')) {
				$profiles = g5plus_get_social_profiles();
				foreach ($profiles as $value) {
					$social_profiles[$value['id']] = array(
						'title' => $value['title'],
						'icon' => $value['icon'],
						'type' => $value['type']
					);
				}
			}
			$arr_icons = array();
			if (!empty($icons)) {
				$arr_icons = explode(',', $icons);
			}
			ob_start();
			echo wp_kses_post($args['before_widget']);
			if ($title) {
				echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
			}
			$class_wrap = array('social-profiles', esc_attr($style));
			if (count($arr_icons) > 0):
				?>
				<?php if ($follow_text): ?>
					<div class="social-profiles-title"><?php echo esc_html($follow_text) ?></div>
				<?php endif;?>
				<ul class="<?php echo join(' ', $class_wrap) ?>">
					<?php foreach ($arr_icons as $key):
						if (!isset($social_profiles[$key])) {
							continue;
						}
						$title = $social_profiles[$key]['title'];
						$icon = $social_profiles[$key]['icon'];
						$link = '#';
						if (class_exists('G5Plus_Global')) {
							$link = G5Plus_Global::get_option($key, '#');
						}

						$link = empty($link) ? '#' : $link;
						?>
						<li>
							<a title="<?php echo esc_attr($title) ?>"
							   href="<?php echo($social_profiles[$key]['type'] == 'email' ? esc_attr($link) : esc_url($link)); ?>"><i
									class="<?php echo esc_attr($icon); ?>"></i></a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php
			endif;
			echo wp_kses_post($args['after_widget']);

			$content =  ob_get_clean();
			echo wp_kses_post($content);
			$this->cache_widget( $args, $content );
		}

		private function get_profiles()
		{
			$ret = array();
			if (function_exists('g5plus_get_social_profiles')) {
				$profiles = g5plus_get_social_profiles();
				foreach ($profiles as $profile) {
					$ret[$profile['id']] = $profile['title'];
				}
			}

			return $ret;
		}
	}
}
