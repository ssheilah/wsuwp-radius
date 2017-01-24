<?php

class WSUWP_Radius {
	/**
	 * @var WSUWP_Radius
	 */
	private static $instance;

	/**
	 * Maintain and return the one instance. Initiate hooks when
	 * called the first time.
	 *
	 * @since 0.0.1
	 *
	 * @return \WSUWP_Radius
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new WSUWP_Radius();
			self::$instance->setup_hooks();
		}
		return self::$instance;
	}

	/**
	 * Setup hooks to include.
	 *
	 * @since 0.0.1
	*/
	public function setup_hooks() {

		add_shortcode( 'radius-form', 'radius_form_shortcode' );
		add_action( 'wp_enqueue_scripts', array( $this, 'wsuf_radius_enqueue_scripts' ), 99 );

		// [radius-form]
		function radius_form_shortcode( $atts ) {
			$a = shortcode_atts( array(
				'id' => 'https://wsu.edu',
				'height' => '100vh',
			), $atts );
			return "<iframe scrolling='no' src='{$a['id']}' style='width:100%; height:{$a['height']};'></iframe>";
		}
	}
}
