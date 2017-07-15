<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/13/2016
 * Time: 8:35 AM
 */
class G5Plus_Widget_Info_Box extends G5Plus_Widget_Acf{
	public function __construct(){
		$this->widget_cssclass = 'widget-info-box';
		$this->widget_description = esc_html__("Display Info Box", 'g5plus-orson');
		$this->widget_id = 'g5plus-info-box';
		$this->widget_name = esc_html__('G5Plus: Info Box', 'g5plus-orson');
		$this->settings = array(
			'id' => 'g5plus_info_box',
			'type' => 'rows',
			'title' => esc_html__('Info Box', 'g5plus-orson'),
			'subtitle' => esc_html__('Unlimited Info box with drag and drop sortings.', 'g5plus-orson'),
			'fields' => array(
				array(
					'name' => 'title',
					'title' => esc_html__('Title', 'g5plus-orson'),
					'type' => 'text',
					'is_title_block' => 1
				),
				array(
					'name' => 'icon',
					'title' => esc_html__('Icon', 'g5plus-orson'),
					'type' => 'icon'
				),
				array(
					'name' => 'description',
					'title' => 'Description',
					'type' => 'text-area'
				),
				array(
					'name' => 'link',
					'title' => esc_html__('Link', 'g5plus-orson'),
					'type' => 'text'
				),
				array(
					'name' => 'read_more',
					'title' => esc_html__('Read more text', 'g5plus-orson'),
					'type' => 'text'
				)
			),
			'extra' => array(
				array(
					'name' => 'title',
					'title' => esc_html__('Title', 'g5plus-orson'),
					'type' => 'text',
				),
				array(
					'name' => 'style',
					'title' => esc_html__('Style', 'g5plus-orson'),
					'type' => 'select',
					'options' => array(
						'classic' => esc_html__('Icon Classic', 'g5plus-orson'),
						'round' => esc_html__('Icon Round', 'g5plus-orson')
					),
					'std' => 'classic'
				)
			)
		);
		parent::__construct();
	}
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$extra = array_key_exists('extra', $instance) ? $instance['extra'] : array();
		$title = array_key_exists('title', $extra) ? $extra['title'] : '';
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		$style = array_key_exists('style', $extra) ? $extra['style'] : '';
		$info_boxes = array_key_exists('fields',$instance) ? $instance['fields'] : array() ;

		echo wp_kses_post($args['before_widget']);
		if (!empty($title)) {
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
		}
		?>
		<ul class="if-<?php echo esc_attr($style); ?>">
			<?php foreach ($info_boxes as $info_box) : ?>
				<?php
					$link = ( ! empty( $info_box['link'] ) ) ? $info_box['link'] : '#';

					$title_html = '<h3><a title="' . esc_attr($info_box['title']) . '" href="'. esc_url($link) .'">'. esc_html($info_box['title']) .'</a></h3>';
					$read_more_html = '';
					if (!empty($info_box['read_more'])) {
						$read_more_html = ' ... <a class="text-color-accent" title="'. esc_attr($info_box['read_more']) .'" href="'. esc_url($link) .'">'. esc_html($info_box['read_more']) .'</a>';
					}
				?>
				<li>
					<div class="if-icon">
						<i class="<?php echo esc_attr($info_box['icon']); ?>"></i>
					</div>
					<div class="if-content">
						<?php echo wp_kses_post($title_html); ?>
						<p>
							<?php echo wp_kses_post($info_box['description']); ?>
							<?php echo wp_kses_post($read_more_html); ?>
						</p>
					</div>
				</li>
			<?php endforeach;?>
		</ul>
		<?php
		echo wp_kses_post($args['after_widget']);
	}
}