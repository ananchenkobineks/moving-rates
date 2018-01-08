<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RTS_Scripts {

	public static function init() {

		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'admin_load_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'front_load_scripts' ) );
	}

	public function admin_load_scripts() {

		$page = get_current_screen()->id;

		if( ($page == 'toplevel_page_int_rts' && !empty($_GET['post'])) ||
			 $page == 'interactive-rates_page_int_rts-new' ) {

	        wp_enqueue_script('jquery');
	 
	        wp_enqueue_script('thickbox');
	        wp_enqueue_style('thickbox');
	 
	        wp_enqueue_script('media-upload');
		}


		wp_register_script( 'rts-admin-js', self::get_asset_url( 'assets/js/rts-admin.js' ), array( 'jquery' ), "", true );
		wp_register_script( 'jquery-ui', self::get_asset_url( 'assets/js/jquery-ui.min.js' ), array( 'jquery' ), "", true );

		wp_enqueue_script( 'rts-admin-js' );
		wp_enqueue_script( 'jquery-ui' );

		wp_register_style( 'rts-admin-css', self::get_asset_url( 'assets/css/rts-admin.css' ), array(), '', 'all' );
		wp_enqueue_style( 'rts-admin-css' );
	}

	public function front_load_scripts() {

		wp_register_script( 'jquery-ui', self::get_asset_url( 'assets/js/jquery-ui.min.js' ), array( 'jquery' ), "", true );
		wp_register_script( 'rates-widget', self::get_asset_url( 'assets/js/rates-widget.js' ), array( 'jquery' ), "", true );

		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'rates-widget' );

		wp_localize_script( 'rates-widget', 'obj', array( 'assets' => RTS_PLUGIN_DIR_URL.'assets/' ) );

		wp_register_style( 'jquery-ui', self::get_asset_url( 'assets/css/jquery-ui.min.css' ), array(), '', 'all' );
		wp_register_style( 'rates-front-style', self::get_asset_url( 'assets/css/front-style.css' ), array(), '', 'all' );
		wp_enqueue_style( 'jquery-ui' );
		wp_enqueue_style( 'rates-front-style' );
	}

	private static function get_asset_url( $path ) {
		return plugins_url( $path, RTS_PLUGIN_FILE );
	}
}

RTS_Scripts::init();