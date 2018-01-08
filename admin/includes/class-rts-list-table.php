<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class RTS_List_Table extends WP_List_Table {

	public static function define_columns() {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __( 'Title', 'int-rates' ),
			'shortcode' => __( 'Shortcode', 'int-rates' ),
			'author' => __( 'Author', 'int-rates' ),
			'date' => __( 'Date', 'int-rates' ),
		);

		return $columns;
	}

	public function __construct() {
		parent::__construct( array(
			'singular' => 'post',
			'plural' => 'posts',
			'ajax' => false,
		) );
	}

	public function prepare_items() {
		$current_screen = get_current_screen();
		$per_page = $this->get_items_per_page( 'rts_list_per_page' );

		$this->_column_headers = $this->get_column_info();

		$args = array(
			'posts_per_page' => $per_page,
			'orderby' => 'title',
			'order' => 'ASC',
			'offset' => ( $this->get_pagenum() - 1 ) * $per_page,
		);

		$this->items = RTS_Post::find( $args );

		$total_items = count( $this->items );
		$total_pages = ceil( $total_items / $per_page );

		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => $total_pages,
			'per_page' => $per_page
		) );
	}

	public function get_columns() {
		return get_column_headers( get_current_screen() );
	}

	function get_bulk_actions() {
		$actions = array(
			'delete' => __( 'Delete', 'int-rates' ),
		);

		return $actions;
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />',
			$this->_args['singular'],
			$item->ID );
	}

	public function column_title( $item ) {

		$url = admin_url( 'admin.php?page=int_rts&post=' . absint( $item->ID ) );
		$edit_link = add_query_arg( array( 'action' => 'edit' ), $url );

		$output = sprintf(
			'<a class="row-title" href="%1$s" title="%2$s">%3$s</a>',
			esc_url( $edit_link ),
			esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;', 'int-rates' ),
				$item->post_title ) ),
			esc_html( $item->post_title )
		);

		return $output;
	}

	public function column_shortcode( $item ) {

		$output = '';

		$shortcode = '[interactive-rates id="' . $item->ID . '"]';

		$output .= "\n" . '<span class="shortcode"><input type="text"'
			. ' onfocus="this.select();" readonly="readonly"'
			. ' value="'. esc_attr( $shortcode ) .'"'
			. ' class="large-text code" /></span>';

		return trim( $output );
	}

	function column_author( $item ) {

		$author = get_userdata( $item->post_author );

		if ( false === $author ) {
			return;
		}

		return esc_html( $author->display_name );
	}

	function column_date( $item ) {
		$t_time = mysql2date( __( 'Y/m/d g:i:s A', 'int-rates' ),
			$item->post_date, true );
		$m_time = $item->post_date;
		$time = mysql2date( 'G', $item->post_date )
			- get_option( 'gmt_offset' ) * 3600;

		$time_diff = time() - $time;

		if ( $time_diff > 0 && $time_diff < 24*60*60 ) {
			$h_time = sprintf(
				__( '%s ago', 'int-rates' ), human_time_diff( $time ) );
		} else {
			$h_time = mysql2date( __( 'Y/m/d', 'int-rates' ), $m_time );
		}

		return '<abbr title="' . $t_time . '">' . $h_time . '</abbr>';
	}

}
