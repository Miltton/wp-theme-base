<?php
/**
 * Wordpress Base Theme, just another starter theme by Janne Leppänen
 *
 * @package wpbasetheme
 * 
 * wpbasetheme_include
 * wpbasetheme_setup
 * wpbasetheme_admin_menu
 * wpbasetheme_widgets_init
 * wpbasetheme_register_scripts_and_styles
 * wpbasetheme_clean_content
 * wpbasetheme_antispambot_the_content_filter
 * wpbasetheme_gallery_shortcode
 * wpbasetheme_rewrite_rules
 */

define( 'THEME_DIR', get_template_directory_uri() );
define( 'IMAGES', THEME_DIR . '/_/images' );

wpbasetheme_require( array(
	'template-tags'
));
function wpbasetheme_require( $includes ) {
	foreach ( $includes as $include ) {
		require( "_/php/{$include}.php");
	}
}

add_action( 'after_setup_theme', 'wpbasetheme_setup' );
function wpbasetheme_setup() {
	load_theme_textdomain( 'wpbasetheme', get_template_directory() . '/_/lang' );

	/* Content width for maxium images */
	if ( ! isset( $content_width ) ) $content_width = 900;

	/* Editor styling */
	add_editor_style( '/css/editor.css' );

	/* Automatic RSS feed links */ 
	add_theme_support( 'automatic-feed-links' );

	/* Add theme supports */
	//add_theme_support( 'post-formats', array() );

	add_theme_support( 'post-thumbnails' );

	/* Remove junk from head */
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

	/* Theme has its own gallery styles */
	add_filter( 'use_default_gallery_style', '__return_false' );

	/* Add Menus */
	register_nav_menus( array(
		'main-menu' => __( 'Main menu', 'wpbasetheme' )
	) );
}

add_action( 'admin_menu', 'wpbasetheme_admin_menu');
function wpbasetheme_admin_menu() {
	// remove_menu_page( 'tools.php' ); 			// tools
	// remove_menu_page( 'edit-comments.php' ); 	// comments
	// remove_menu_page( 'edit.php' ); 				// posts
}

add_action( 'widgets_init', 'wpbasetheme_widgets_init');
function wpbasetheme_widgets_init() {
	/* Remove hardcoded styles for recent comments */
	global $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );

	register_sidebar( array(
		'name' 			=> __( 'Sidebar', 'wpbasetheme' ),
		'id'			=> 'sidebar',
		'description'	=> __( 'Widgets goes here.', 'wpbasetheme' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
	) );

	register_sidebar( array(
		'name' 			=> __( 'Google Analytics', 'wpbasetheme' ),
		'id'			=> 'google-analytics',
		'description'	=> __( 'Add text widget, which contains Google Analytics script.', 'wpbasetheme' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title' 	=> '',
		'after_title'	=> ''
	) );
}

/* Scripts and styles */
add_action( 'wp_enqueue_scripts', 'wpbasetheme_register_scripts_and_styles' );
function wpbasetheme_register_scripts_and_styles() {
	wp_register_script( 'modernizr', THEME_DIR . '/_/libs/modernizr.js', array(), 1.0, false );
	wp_register_script( 'responsive-nav', THEME_DIR . '/_/libs/responsive-nav.min.js', array(), 1.0, true );
	wp_register_script( 'theme-functions', THEME_DIR . '/_/js/functions.js', array('jquery'), 1.0, true );
	wp_register_script( 'flexslider', THEME_DIR . '/_/libs/flexslider/jquery.flexslider-min.js', array('jquery'), 1.0, true );
	wp_register_script( 'magnific-popup', THEME_DIR . '/_/libs/magnific-popup/magnific-popup.js', array('jquery'), 1.0, true );
	wp_register_style( 'theme-stylesheet', THEME_DIR . '/_/css/base.css', array(), 1.0, 'screen' );

	/* Enque comment-reply script only when it's necessary */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'responsive-nav' );
	wp_enqueue_script( 'theme-functions' );
	// wp_enqueue_script( 'flexslider' );
	// wp_enqueue_script( 'magnific-popup' );
	wp_enqueue_style( 'theme-stylesheet' );
}

add_action( 'wp_dashboard_setup' , 'wpbasetheme_remove_dashboard_widgets' );
function wpbasetheme_remove_dashboard_widgets() {
	$user = wp_get_current_user();
	if( $user->has_cap( 'manage_options') ) {
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        
	}
}

/* Look for emails in content and filter them with antispambot */	
add_filter('the_content', 'wpbasetheme_antispambot_the_content_filter');
function wpbasetheme_antispambot_the_content_filter( $content ) {
	$matches = array();
	preg_match_all( "/\b\w+\@\w+[\.\w+]+\b/", $content, $matches);
	foreach( $matches[0] as $match ){
	  $content = str_replace( $match, antispambot( $match ), $content);
	}
	return $content;
}

/* Redefine default gallery elements */
add_shortcode('gallery', 'wpbasetheme_gallery_shortcode');
function wpbasetheme_gallery_shortcode( $attr ) {
	$attr['itemtag']   	= 'div';
	$attr['icontag']    = 'div';
	$attr['captiontag']	= 'figure';
	return gallery_shortcode($attr);
}

/* Url translations */
add_action('init', 'wpbasetheme_rewrite_rules');
function wpbasetheme_rewrite_rules() {
    global $wp_rewrite;
    $wp_rewrite->pagination_base    = __( 'page', 'wpbasetheme' );
}