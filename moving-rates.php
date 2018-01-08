<?php
/**
 * Plugin Name: Interactive Rates
 * Description: Interactive widget for determining the movement of the rates
 * Author: Jack Ananchenko
 * Text Domain: int-rates
 * Version: 1.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists('Interactive_Rates') ) :

final class Interactive_Rates {

    protected static $_instance = null;

    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function define_constants() {

        $this->define( 'RTS_PLUGIN_FILE', __FILE__ );
        $this->define( 'RTS_ABSPATH', untrailingslashit( dirname( RTS_PLUGIN_FILE ) ) );
        $this->define( 'RTS_TEMPLATE', dirname( RTS_PLUGIN_FILE ) . '/templates' );
        $this->define( 'RTS_PLUGIN_DIR_URL', plugin_dir_url( RTS_PLUGIN_FILE ) );
    }

    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    private function is_request( $type ) {
        switch ( $type ) {
            case 'admin' :
                return is_admin();
            case 'frontend' :
                return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
        }
    }

     private function init_hooks() {
        add_action( 'init', array( 'RTS_Post', 'register' ) );
    }

    private function includes() {

        include_once( RTS_ABSPATH . '/includes/class-rts-shortcode.php' );

        include_once( RTS_ABSPATH . '/includes/class-rts-post-type.php' );
        include_once( RTS_ABSPATH . '/includes/class-rts-scripts.php' );

        if ( $this->is_request( 'admin' ) ) {
            include_once( RTS_ABSPATH . '/admin/class-rts-admin.php' );
		}
    }
    
}

endif;

Interactive_Rates::instance();