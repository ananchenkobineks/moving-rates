<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RTS_Admin1 {

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {

		add_menu_page(
			__( 'Interactive Rates', 'int-rates' ),
			__( 'Interactive Rates', 'int-rates' ),
			'manage_options', 'int_rts',
			array( $this, 'rates_management_page' ),
			'dashicons-welcome-widgets-menus', 30
		);

		$edit = add_submenu_page( 'int_rts',
			__( 'Interactive Rates List', 'int-rates' ),
			__( 'Rates List', 'int-rates' ),
			'manage_options', 'int_rts',
			array( $this, 'rates_management_page' )
		);

		add_action( 'load-' . $edit, array( $this, 'load_rates_form' ) );

		$addnew = add_submenu_page(
			'int_rts',
			__( 'Add New Rates', 'int-rates' ),
			__( 'Add New', 'int-rates' ),
			'manage_options', 'int_rts-new',
			array( $this, 'add_new_rate' )
		);

		add_action( 'load-' . $addnew, array( $this, 'load_rates_form' ) );
	}	

	public function rates_management_page() {

		if( $post = RTS_Post::get_current() ) {

			$post_id = $post->ID;

			require_once RTS_ABSPATH . '/admin/includes/tabs.php';
			require_once RTS_ABSPATH . '/admin/views/html-admin-edit-rate.php';	
			return;
		}

		$list_table = new RTS_List_Table();
		$list_table->prepare_items();

		?>
		<div class="wrap">

			<h1 class="wp-heading-inline"><?php
				echo esc_html( __( 'Rates List', 'int-rates' ) );
			?></h1>

			<?php echo sprintf( '<a href="%1$s" class="add-new-h2">%2$s</a>',
							esc_url( menu_page_url( 'int_rts-new', false ) ),
							esc_html( __( 'Add New', 'int-rates' ) ) 
						);
			?>

			<hr class="wp-header-end">

			<form method="get" action="">
				<input type="hidden" name="page" value="<?php echo esc_attr( $_REQUEST['page'] ); ?>" />
				<?php $list_table->display(); ?>
			</form>

		</div>
		<?php
	}

	public function add_new_rate() {

		$post_id = -1;

		require_once RTS_ABSPATH . '/admin/includes/tabs.php';
		require_once RTS_ABSPATH . '/admin/views/html-admin-edit-rate.php';
	}

	public function load_rates_form() {
		global $plugin_page;

		if( isset($_REQUEST['action']) ) {

			if( $_REQUEST['action'] == 'save' && wp_verify_nonce($_POST['_wpnonce'], 'save-int-rate') ) {

				$id = isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : '-1';

				$args = $_REQUEST;
				$args['id'] = $id;

				$args['title'] = isset( $_POST['post_title'] ) ? $_POST['post_title'] : null;

				$rates_post_id = RTS_Post::save( $args );

				$url = admin_url( 'admin.php?page=int_rts&post=' . $rates_post_id );
				$redirect_to = add_query_arg( array( 'action' => 'edit' ), $url );
				wp_safe_redirect( $redirect_to );
				exit;

			} elseif( $_REQUEST['action'] == 'edit' && wp_verify_nonce($_POST['_wpnonce'], 'save-int-rate') ) {

				$id = isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : '-1';

				$args = $_REQUEST;
				$args['id'] = $id;

				$args['title'] = isset( $_POST['post_title'] ) ? $_POST['post_title'] : null;

				RTS_Post::update( $args );

				$url = admin_url( 'admin.php?page=int_rts&post=' . $id );
				$redirect_to = add_query_arg( array( 'action' => 'edit' ), $url );
				wp_safe_redirect( $redirect_to );
				exit;

			} elseif( $_GET['action'] == 'delete' ) {

				foreach ( $_GET['post'] as $post_id ) {
					wp_delete_post( $post_id, true );
				}

				$redirect_to = menu_page_url( 'int_rts', false );
				wp_safe_redirect( $redirect_to );
				exit;
			}

		}

		$_GET['post'] = isset( $_GET['post'] ) ? $_GET['post'] : '';

		$post = null;

		if ( 'int_rts-new' == $plugin_page ) {
			$post = true;
		} elseif ( ! empty( $_GET['post'] ) ) {
			$post = RTS_Post::get_post( $_GET['post'] );
		}

		if( !$post ) {

			require_once RTS_ABSPATH . '/admin/includes/class-rts-list-table.php';

			$current_screen = get_current_screen();

			add_filter( 'manage_' . $current_screen->id . '_columns',
				array( 'RTS_List_Table', 'define_columns' ) );

			add_screen_option( 'per_page', array(
				'default' => 20,
				'option' => 'rts_list_per_page' ) );
		}
	}

}

new RTS_Admin1();