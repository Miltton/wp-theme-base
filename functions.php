<?php
	define( 'THEME_DIR', get_template_directory_uri() );
	define( 'IMAGES', THEME_DIR . '/_/images' );

	/* Shh.. Don't tell them that we haven't updated WP */
	remove_action( 'wp_head', 'wp_generator' );

	/* Scripts and styles */
	add_action( 'wp_enqueue_scripts', 'wpbasetheme_register_scripts_and_styles' );
	function wpbasetheme_register_scripts_and_styles() {
		wp_register_script( 'theme-functions', THEME_DIR . '/_/js/functions.js', array('jquery'), 1.0, true );
		wp_register_style( 'theme-stylesheet', THEME_DIR . '/_/css/base.css', array(), 1.0, 'screen');

		wp_enqueue_script( 'theme-functions' );
		wp_enqueue_style( 'theme-stylesheet' );
	}
?>