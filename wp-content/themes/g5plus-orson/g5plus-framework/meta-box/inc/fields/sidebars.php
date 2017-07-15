<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

// Make sure "select" field is loaded
require_once RWMB_FIELDS_DIR . 'select.php';

if ( !class_exists( 'RWMB_Sidebars_Field' ) )
{
	class RWMB_Sidebars_field extends RWMB_Select_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			parent::admin_enqueue_scripts();
			wp_enqueue_style( 'rwmb-select2', RWMB_CSS_URL . 'select2/select2.css', array(), '4.0.1' );
			wp_enqueue_style( 'rwmb-select-advanced', RWMB_CSS_URL . 'select-advanced.css', array(), RWMB_VER );

			wp_register_script( 'rwmb-select2', RWMB_JS_URL . 'select2/select2.min.js', array(), '4.0.1', true );
			wp_enqueue_script( 'rwmb-select', RWMB_JS_URL . 'select.js', array(), RWMB_VER, true );
			wp_enqueue_script( 'rwmb-select-advanced', RWMB_JS_URL . 'select-advanced.js', array( 'rwmb-select2', 'rwmb-select' ), RWMB_VER, true );
		}

		public static function normalize( $field )
		{
			$field = wp_parse_args( $field, array(
				'js_options'  => array(),
				'placeholder' => esc_html__('Select a sidebar','g5plus-orson'),
			) );

			$field = parent::normalize( $field );

			$field['js_options'] = wp_parse_args( $field['js_options'], array(
				'allowClear'  => true,
				'width'       => 'none',
				'placeholder' => $field['placeholder'],
			) );

			$field['options'] = array();
			$field['options'][] = array('value' => '-2', 'label' => esc_html__('--None--','g5plus-orson'));
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				$field['options'][] = array(
					'value' => $sidebar['id'],
					'label' => ucwords( $sidebar['name'] )
				);
			}
			return $field;
		}

		/**
		 * Walk options
		 *
		 * @param mixed $meta
		 * @param array $field
		 * @param mixed $options
		 * @param mixed $db_fields
		 *
		 * @return string
		 */
		public static function walk( $options, $db_fields, $meta, $field )
		{
			$attributes = call_user_func( array( RW_Meta_Box::get_class_name( $field ), 'get_attributes' ), $field, $meta );
			$walker     = new RWMB_Select_Walker( $db_fields, $field, $meta );
			$output     = sprintf(
				'<select %s>',
				self::render_attributes( $attributes )
			);

			$output .= '<option></option>';
			$output .= $walker->walk( $options, $field['flatten'] ? - 1 : 0 );
			$output .= '</select>';
			$output .= self::get_select_all_html( $field );
			return $output;
		}

		/**
		 * Get the attributes for a field
		 *
		 * @param array $field
		 * @param mixed $value
		 * @return array
		 */
		public static function get_attributes( $field, $value = null )
		{
			$attributes = parent::get_attributes( $field, $value );
			$attributes = wp_parse_args( $attributes, array(
				'data-options' => wp_json_encode( $field['js_options'] ),
			) );

			return $attributes;
		}
	}
}
