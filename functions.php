<?php

include_once( '_/php/class-wb-template-tag.php' );
include_once( '_/php/class-wb-shortcode.php' );
include_once( '_/php/class-wb-theme.php' );
include_once( '_/php/class-custom-theme.php' );

define( 'THEME_VERSION', 	0.1 );
define( 'THEME_DIR', 		get_template_directory_uri() );
define( 'THEME_NAME', 		basename(THEME_DIR) );
define( 'IMAGES', 			THEME_DIR . '/_/images' );

WB_Shortcode::initialize();

/*
	Anonymous Functions excepts PHP 5.3.0 or higher
*/
WB_Theme::initialize(function() {
	WB_Theme::set_sidebars(array(
		array( 
		 	'id' 			=> 'sidebar', 
		 	'name' 			=> WB_Theme::__( 'Sidebar' ), 
		 	'body_element'	=> 'div', 
		 	'title_elemnt' 	=> 'h3'
		 ),
		array( 
			'id' 			=> 'google-analytics', 
		 	'name' 			=> WB_Theme::__( 'Google Analytics' ), 
		 	'body_element'	=> '', 
		 	'title_elemnt' 	=> ''
		)
	));

	WB_Theme::set_menus(array(
		'main-menu' => WB_Theme::__( 'Main menu' )
	));

	// active, id, path, depencies, type, 
	WB_Theme::set_css(array(
		array( 'theme-stylesheet', '/_/css/base.css', array(), 'screen' ),
	));

	// active, id, path , depencies, is bottom of page
	WB_Theme::set_js(array(
		array( 'modernizr', 		'/_/libs/modernizr.js', 						array(), 			false ),
		array( 'flexslider', 		'/_/libs/flexslider/jquery.flexslider-min.js', 	array('jquery'), 	true ),
		array( 'magnific-popup', 	'/_/libs/magnific-popup/magnific-popup.js', 	array('jquery'), 	true ),
		array( 'theme-functions', 	'/_/js/functions.js', 							array('jquery'), 	true ),
		array( 'responsive-nav', 	'/_/libs/responsive-nav.min.js', 				array(), 			true ),
	));
});