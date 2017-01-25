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
		// [radius-form]
		function radius_form_shortcode( $atts ) {
			$a = shortcode_atts( array(
				'url' => 'https://wsu.edu',
				'height' => '20vh',
				'title' => 'no title',
			), $atts );
			if ( preg_match( '/^https\:\/\/wsuonline\.hobsonsradius\.com\/ssc\/eform\/[A-Za-z_0-9]{9,19}\.ssc$/', $a['url'] ) ) {
				return "<iframe scrolling='no' title='{$a['title']}'; src='{$a['url']}' style='width:100%; height:{$a['height']};'></iframe>";
			} else {
				return '<p>not radius</p>';
			}
		}
	}
}
