<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RTS_Post {

	const post_type = 'interactive_rates';

	private static $current = null;

	public static function get_current() {
		return self::$current;
	}
	
	public static function register() {

		register_post_type( self::post_type, array(
			'labels' => array(
				'name' => __( 'Interactive Rates', 'int-rates' ),
				'singular_name' => __( 'Interactive Rate', 'int-rates' )
			),
			'public' => false,
			'rewrite' => false,
			'query_var' => false
		) );
	}

	public static function save( $args ) {

		$post_id = wp_insert_post( array(
			'post_type' 	=> self::post_type,
			'post_status' 	=> 'publish',
			'post_title' 	=> $args['title'],
			'meta_input' 	=> array(
				'_rates_type' 			=> $args['rates-type'],
				'_weekdays' 			=> $args['weekdays'],
				'_weekends'				=> $args['weekends'],
				'_truck_img'			=> $args['_truck_img'],
				'_container_img'		=> $args['_container_img'],
				'_mover_img'			=> $args['_mover_img'],
				'_houses_background'	=> $args['_houses_background'],
				'_foreground'			=> $args['_foreground']
			)
		) );

		return $post_id;
	}

	public static function update( $args ) {

		wp_update_post( array(
			'ID' => (int) $args['id'],
			'post_status' => 'publish',
			'post_title' => $args['title'],
		) );

		update_post_meta( $args['id'], '_rates_type', $args['rates-type'] );
		update_post_meta( $args['id'], '_weekdays', $args['weekdays'] );
		update_post_meta( $args['id'], '_weekends', $args['weekends'] );

		update_post_meta( $args['id'], '_truck_img', $args['_truck_img'] );
		update_post_meta( $args['id'], '_container_img', $args['_container_img'] );
		update_post_meta( $args['id'], '_mover_img', $args['_mover_img'] );
		update_post_meta( $args['id'], '_houses_background', $args['_houses_background'] );
		update_post_meta( $args['id'], '_foreground', $args['_foreground'] );

		return true;
	}

	public static function get_post( $post_id ) {
		$post = get_post( $post_id );

		if ( ! $post || self::post_type != get_post_type( $post ) ) {
			return false;
		}

		return self::$current = $post;
	}

	public static function find( $args = '' ) {

		$defaults = array(
			'post_status' => 'any',
			'posts_per_page' => -1,
			'offset' => 0,
			'orderby' => 'ID',
			'order' => 'ASC',
		);

		$args = wp_parse_args( $args, $defaults );

		$args['post_type'] = self::post_type;

		$q = new WP_Query();
		$posts = $q->query( $args );

		$objs = array();

		foreach ( (array) $posts as $post ) {
			$objs[] = new WP_Post( $post );
		}

		return $objs;
	}

}