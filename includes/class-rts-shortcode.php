<?php

if ( ! defined( 'ABSPATH' ) ) { 
	exit;
}

class RTS_Shortcode {

	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Init shortcode.
	 */
	public function init() {

		add_shortcode( 'interactive-rates', array( $this, 'output' ) );
	}

	public function output( $atts ) {

		if( !empty( $atts['id'] ) ) {

			$data = get_post_meta( $atts['id'] );

			$_weekdays = unserialize($data['_weekdays'][0]);
			$_weekends = unserialize($data['_weekends'][0]);

			$rate_list = new stdClass();
	
			$sizes = array('small', 'medium', 'large');

			foreach ($sizes as $size) {

				if( $size == 'small' ) {
					$n1 = 1;
				} elseif( $size == 'medium' ) {
					$n1 = 2;
				} elseif( $size == 'large' ) {
					$n1 = 3;
				}
				$n2 = $n1 + 3;

				$rate_list->{$size} = new stdClass();

				$rate_list->{$size}->day_type_1 = array(
					array(
						'service-type' => $_weekdays[ $n1 ]['results-for'],
						'house-size' => $_weekdays[ $n1 ]['house-size'],
						'house-size-title' => $_weekdays[ $n1 ]['house-size-title'],
						'house-sf' => $_weekdays[ $n1 ]['house-sf'],
						"cost-label" => "/hr",
						'additional-movers' => $_weekdays[ $n1 ]['additional-movers'],
						'truck' => $_weekdays[ $n1 ]['truck'],
						'highlights' => explode( "\r\n", trim($_weekdays[ $n1 ]['details']) ),
						'movers' => $_weekdays[ $n1 ]['movers'],
						'cost' => $_weekdays[ $n1 ]['cost']
					),
					array(
						'service-type' => $_weekdays[ $n2 ]['results-for'],
						'house-size' => $_weekdays[ $n2 ]['house-size'],
						'house-size-title' => $_weekdays[ $n2 ]['house-size-title'],
						'house-sf' => $_weekdays[ $n2 ]['house-sf'],
						"cost-label" => "/hr",
						'additional-movers' => $_weekdays[ $n2 ]['additional-movers'],
						'truck' => $_weekdays[ $n2 ]['truck'],
						'highlights' => explode( "\r\n", trim($_weekdays[ $n2 ]['details']) ),
						'movers' => $_weekdays[ $n2 ]['movers'],
						'cost' => $_weekdays[ $n2 ]['cost']
					)
				);

				$rate_list->{$size}->day_type_2 = array(
					array(
						'service-type' => $_weekends[ $n1 ]['results-for'],
						'house-size' => $_weekends[ $n1 ]['house-size'],
						'house-size-title' => $_weekends[ $n1 ]['house-size-title'],
						'house-sf' => $_weekends[ $n1 ]['house-sf'],
						"cost-label" => "/hr",
						'additional-movers' => $_weekends[ $n1 ]['additional-movers'],
						'truck' => $_weekends[ $n1 ]['truck'],
						'highlights' => explode( "\r\n", trim($_weekends[ $n1 ]['details']) ),
						'movers' => $_weekends[ $n1 ]['movers'],
						'cost' => $_weekends[ $n1 ]['cost']
					),
					array(
						'service-type' => $_weekends[ $n2 ]['results-for'],
						'house-size' => $_weekends[ $n2 ]['house-size'],
						'house-size-title' => $_weekends[ $n2 ]['house-size-title'],
						'house-sf' => $_weekends[ $n2 ]['house-sf'],
						"cost-label" => "/hr",
						'additional-movers' => $_weekends[ $n2 ]['additional-movers'],
						'truck' => $_weekends[ $n2 ]['truck'],
						'highlights' => explode( "\r\n", trim($_weekends[ $n2 ]['details']) ),
						'movers' => $_weekends[ $n2 ]['movers'],
						'cost' => $_weekends[ $n2 ]['cost']
					)
				);

			}

			require( RTS_TEMPLATE . '/interactive-rates.php' );
		}
		
	}

}

new RTS_Shortcode();