<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/18/2015
 * Time: 2:07 PM
 */
class G5Plus_Widget_Image extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-image';
        $this->widget_description =  esc_html__( "Display your latest tweets", 'g5plus-orson' );
        $this->widget_id          = 'g5plus-image';
        $this->widget_name        = esc_html__( 'G5Plus: Image', 'g5plus-orson' );
        $this->settings           = array(
            'title'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Title', 'g5plus-orson' )
            ),
            'image' => array(
                'type'  => 'image',
                'std'   => '',
                'label' => esc_html__( 'Image', 'g5plus-orson' )
            ),
			'hover_effect' => array(
				'label'   => esc_html__('Hover Effect', 'g5plus-orson'),
				'type'    => 'select',
				'std'     => '',
				'options' => array(
					''               => esc_html__('None', 'g5plus-orson'),
					'suprema-effect' => esc_html__('Suprema', 'g5plus-orson'),
					'layla-effect'   => esc_html__('Layla', 'g5plus-orson'),
					'bubba-effect'   => esc_html__('Bubba', 'g5plus-orson'),
					'jazz-effect'    => esc_html__('Jazz', 'g5plus-orson'),
				)
			),
            'link' => array(
	            'type'  => 'text',
	            'std'   => '',
	            'label' => esc_html__( 'Link', 'g5plus-orson' )
            ),
            'alt' => array(
	            'type'  => 'text',
	            'std'   => '',
	            'label' => esc_html__( 'Alt', 'g5plus-orson' )
            )
        );
        parent::__construct();
    }
    function widget($args, $instance) {
        extract( $args, EXTR_SKIP );
        $title = (!empty( $instance['title'] ) ) ? $instance['title'] : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $image = (!empty( $instance['image'] ) ) ? $instance['image'] : '';
		$hover_effect = (!empty($instance['hover_effect'])) ? $instance['hover_effect'] : '';
		$link = (!empty($instance['link'])) ? $instance['link'] : '#';
	    $alt = (!empty( $instance['alt'] ) ) ? $instance['alt'] : '';

	    echo wp_kses_post($args['before_widget']);
	    if ($title) {
		    echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
	    }
	    ?>
		<?php if ($image): ?>
			<div class="g5plus-banner <?php echo esc_attr($hover_effect); ?>">
				<a href="<?php echo esc_url($link); ?>"></a>
				<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>"/>
			</div>
	    <?php endif;?>
		<?php
	    echo wp_kses_post($args['after_widget']);
    }
}