<?php 
add_action( 'the_content', 'wpbasetheme_page_views_the_content' );
function wpbasetheme_page_views_the_content( $content ) {
	session_start();
	$page_viewed_already = $_SESSION['page-' . get_the_ID() . '-viewed'];

	if( ( is_page() || is_single() ) && ! $page_viewed_already ) {
		$count_key = 'wpbasetheme_post_views_count';
		$postID = get_the_ID();
		$count = get_post_meta( $postID, $count_key, true );
		$_SESSION['page-' . $postID . '-viewed'] = true;

		if( $count == '' ) {
			$count = 1;
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '1');
		} else {
			$count++;
			update_post_meta( $postID, $count_key, $count );
		}
	}
	return $content;
}

function the_views() {
	echo get_the_views();
}

function get_the_views() {
	$count_key = 'wpbasetheme_post_views_count';
	return get_post_meta( get_the_ID(), $count_key, true );
}

// Disable refetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
?>