<?php 

/**
 * Enqueue scripts and styles
 */

function codelibry_name_scripts() {
	wp_enqueue_style( 'codelibry-main-css', get_stylesheet_uri() . '/assets/css/codelibry.main.css' );
}
add_action( 'wp_enqueue_scripts', 'codelibry_name_scripts' );