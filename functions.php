<?php
	define( 'THEME_DIR', get_template_directory_uri() );
	define( 'IMAGES', THEME_DIR . '/_/images' );

	/* Shh.. Don't tell them that we haven't updated WP */
	remove_action( 'wp_head', 'wp_generator' );

	/* Editor styling */
	add_editor_style( '/_/css/editor.css' );

	/* Scripts and styles */
	add_action( 'wp_enqueue_scripts', 'wpbasetheme_register_scripts_and_styles' );
	function wpbasetheme_register_scripts_and_styles() {
		wp_register_script( 'modernizr', THEME_DIR . '/_/libs/modernizr.js', array(), 1.0, false );
		wp_register_script( 'theme-functions', THEME_DIR . '/_/js/functions.js', array('jquery'), 1.0, true );
		wp_register_style( 'normalize', THEME_DIR . '/_/libs/normalize.css', array(), 1.0, 'screen' );
		wp_register_style( 'theme-stylesheet', THEME_DIR . '/_/css/base.css', array(), 1.0, 'screen' );

		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'theme-functions' );
		wp_enqueue_style( 'normalize' );
		wp_enqueue_style( 'theme-stylesheet' );
	}

	/* Find emails in content and filter them with antispambot */	
	add_filter('the_content', 'wpbasetheme_antispambot_the_content_filter');
	function wpbasetheme_antispambot_the_content_filter( $content ) {
		$matches = array();
		preg_match_all( "/\b\w+\@\w+[\.\w+]+\b/", $content, $matches);
		foreach( $matches[0] as $match ){
		  $content = str_replace( $match, antispambot( $match ), $content);
		}
		return $content;
	}
?>