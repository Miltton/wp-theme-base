<?php
/*
	WP_Template_Tag::the_numeric_pagination();
	WP_Template_Tag::the_blog_url();
	WP_Template_Tag::get_blog_url();
	WP_Template_Tag::the_depth();
	WP_Template_Tag::get_depth();
	WP_Template_Tag::the_slug();
	WP_Template_Tag::get_slug();
	WP_Template_Tag::the_home_hash();
*/
class WB_Template_Tag {

	public static function the_numeric_pagination() {
		global $wp_query;
	    $big = 999999;
	    echo paginate_links(array(
	        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
	        'format' => '?paged=%#%',
	        'current' => max(1, get_query_var('paged')),
	        'total' => $wp_query->max_num_pages
	    ));
	}

	public  static function the_blog_url() {
		echo self::get_blog_url();
	}

	public static function get_blog_url() {
		return get_permalink( get_option( 'page_for_posts' ) );
	}

	public static function the_depth() {
		echo self::get_depth();
	}
	
	public static function get_depth() {
		global $wp_query;
		$object = $wp_query->get_queried_object();
		$parent_id  = $object->post_parent;
		$depth = 0;
		//var_dump( $parent_id );
		while ($parent_id > 0) {
		       $page = get_page($parent_id);
		       $parent_id = $page->post_parent;
		       $depth++;
		}
		 
		return $depth;
	}

	public static function the_slug( $id = null ) {
		echo self::get_slug( $id );
	}

	public static function get_slug( $id = null) {
		global $post;
		if( ! $id ) {
	    	$id = $post->ID;
		}
		$post_data = get_post($id, ARRAY_A);
		$slug = $post_data['post_name'];
	    
		return $slug;
	}

	public static function the_home_hash() {
		if( get_option('show_on_front') == 'page' ) {
			$posts_page_id = get_option('page_on_front');
			$posts_page = get_page( $posts_page_id);
			echo '#' . $posts_page->post_name;
		}
	}
	
}