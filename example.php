<?php

// Level 1
add_filter( 'posts_where', 'my_posts_where', 10, 2 );
add_action( 'template_redirect', 'template_redirect', 10, 2 );

function my_posts_where( $sql, $wp_query ) {
	if ( $wp_query->is_main_query() && $wp_query->get( 'my_query_var' ) ) {
		$sql = ...;
	}

	return $sql;
}

function my_template_redirect() {
	global $wp_query;

	if ( $wp_query->is_main_query() && $wp_query->get( 'my_query_var' ) ) {
		wp_enqueue_script( ... );
	}
}


// Level 2
class My_View_Controller {

	function __construct() {
		add_filter( 'posts_where', array( $this, 'posts_where' ), 10, 2 );
		add_action( 'template_redirect', array( $this, 'template_redirect' ), 10, 2 );
	}

	function posts_where( $sql, $wp_query ) {
		if ( $wp_query->is_main_query() && $wp_query->get( 'my_query_var' ) ) {
			$sql = ...;
		}

		return $sql;
	}

	function template_redirect() {
		global $wp_query;

		if ( $wp_query->is_main_query() && $wp_query->get( 'my_query_var' ) ) {
			wp_enqueue_script( ... );
		}
	}
}


// Level 3
class My_View_Controller extends APP_View_Controller {

	function condition() {
		return get_query_var( 'my_query_var' );
	}

	function posts_where( $sql, $wp_query ) {
		$sql = ...;

		return $sql;
	}

	function template_redirect() {
		wp_enqueue_script( ... );
	}
}

new My_View_Controller;
