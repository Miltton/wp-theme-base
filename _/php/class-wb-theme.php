<?php

class WB_Theme {

	const NAME 		= THEME_NAME;
	const VERSION 	= THEME_VERSION;

	private static $sidebars 	= array();
	private static $menus 		= array();
	private static $css_files	= array();
	private static $js_files  	= array();

	public static function initialize( $callback ) {
		add_action( "after_setup_theme", array(__CLASS__, 'after_setup_theme'), 5 );
		add_action( "after_setup_theme", $callback, 10 );
	}

	public static function after_setup_theme() {
		load_theme_textdomain( self::NAME, get_template_directory() . '/_/lang' );

		if ( ! isset( $content_width ) ) $content_width = 900;

		add_editor_style( '/css/editor.css' );

		// add_theme_support( 'post-formats', array() );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );

		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

		add_action( 'admin_menu',			array( __CLASS__, 'admin_menu' ) );
		add_action( 'wp_enqueue_scripts',	array( __CLASS__, 'wp_enqueue_scripts' ) );
		add_action( 'wp_dashboard_setup',	array( __CLASS__, 'remove_dashboard_widgets' ) );
		add_action( 'init',					array( __CLASS__, 'rewrite_rules' ) );
		add_action( 'widgets_init', 		array( __CLASS__, 'register_sidebars' ) );

		add_filter( 'use_default_gallery_style', '__return_false' );
		add_filter( 'wp_title', 			array( __CLASS__, 'wp_title' ) );
		add_filter( 'the_content',			array( __CLASS__, 'antispambot_the_content_filter' ) );
		add_filter( 'wp_revisions_to_keep', array( __CLASS__, 'limit_revisions' ), 10, 2 );
	}

	public static function admin_menu() {
		// remove_menu_page( 'tools.php' ); 			// tools
		// remove_menu_page( 'edit-comments.php' ); 	// comments
		// remove_menu_page( 'edit.php' ); 				// posts
	}

	public static function remove_dashboard_widgets() {
		$user = wp_get_current_user();
		if( $user->has_cap( 'manage_options') ) {
			remove_meta_box( 'dashboard_recent_comments', 	'dashboard', 'normal' );
			remove_meta_box( 'dashboard_incoming_links', 	'dashboard', 'normal' );
			remove_meta_box( 'dashboard_plugins', 			'dashboard', 'normal' );
	        remove_meta_box( 'dashboard_quick_press', 		'dashboard', 'side' );
	        remove_meta_box( 'dashboard_primary', 			'dashboard', 'side' );
	        remove_meta_box( 'dashboard_secondary', 		'dashboard', 'side' );
	        remove_meta_box( 'dashboard_recent_drafts', 	'dashboard', 'side' );  
		}
	}

	public static function antispambot_the_content_filter($content) {
		$matches = array();
		preg_match_all( "/\b\w+\@\w+[\.\w+]+\b/", $content, $matches);
		foreach( $matches[0] as $match ){
		  $content = str_replace( $match, antispambot( $match ), $content);
		}
		return $content;
	}

	public static function wp_title( $title )
	{
		if( empty( $title ) && ( is_home() || is_front_page() ) ) {
			return bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
		} else {
			return $title . get_bloginfo( 'name' );
		}
	}

	public static function rewrite_rules() {
		global $wp_rewrite;
    	$wp_rewrite->pagination_base    = self::__( 'page' );
	}

	public static function register_sidebars() {
		$defaults = array(
			'id' 			=> 'sidebar', 
		 	'name' 			=> self::__( 'Default sidebar' ),
		 	'description'	=> self::__( 'Place widgets here.' ),
		 	'body_element'	=> 'div', 
		 	'title_elemnt' 	=> 'h3'
		);
		
		foreach ( self::$sidebars as $sidebar ) {
			$sidebar = array_merge($defaults, $sidebar);
			register_sidebar( array(
				'id'			=> $sidebar['id'],
				'name' 			=> $sidebar['name'],
				'description'	=> $sidebar['description'],
				'before_widget'	=> '<div id="%1$s" class="widget %2$s language-switch">',
				'after_widget'	=> '</div>',
				'before_title' 	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>'
			));
		}
	}

	public static function set_menus($menus_arr) {
		self::$menus = $menus_arr;
		register_nav_menus(self::$menus);
	}

	public static function wp_enqueue_scripts() {
		foreach( self::$css_files as $css_file ) {
			wp_register_style( $css_file[0], THEME_DIR . $css_file[1], $css_file[2], self::VERSION, $css_file[3] );
		}

		foreach( self::$js_files as $js_file ) {
			wp_register_script( $js_file[0], THEME_DIR . $js_file[1], $js_file[2], self::VERSION, $js_file[3] );
		}

		foreach( self::$css_files as $css_file ) {
			wp_enqueue_style( $css_file[0] );
		}

		foreach( self::$js_files as $js_file ) {
			wp_enqueue_script( $js_file[0] );
		}
	}

	public static function set_sidebars( $sidebar_arr ) {
		self::$sidebars = $sidebar_arr;
	}

	public static function set_css( $css_arr ) {
		self::$css_files = $css_arr;
	}

	public static function set_js( $js_arr ) {
		self::$js_files = $js_arr;
	}

	public static function limit_revisions( $num, $post ) {
	    return 3;
	}

	public static function __($str) { return __($str, self::NAME); }
    public static function _n($one, $many, $count) { return _n($one, $many, $count, self::NAME); }
    public static function _e($str) { return _e($str, self::NAME); }
    public static function _x($str, $context) { return _x($str, $context, self::NAME); }
}