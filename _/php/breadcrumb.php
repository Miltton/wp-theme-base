<?php
/* Breadcrumb for pages and categories */
function the_breadcrumb( $separator = '»' ) {
	global $post;
	if( ! is_home() && ( is_page() || is_category() ) ) {
		echo '<div class="breadcrumb">';
		?>
		<a href="<?php echo get_option( 'home' ); ?>"><?php echo bloginfo( 'name' ); ?></a> <?php echo $separator; ?>
		<?php

		if( is_page() ) {

			if( $post->post_parent ) {
				$ancestors = get_post_ancestors( $post->ID );

				foreach ( array_reverse( $ancestors ) as $ancestor ) {
					$link = get_page_link( $ancestor );
					$title = get_the_title( $ancestor );
					$output .= "<a href=\"$link\">$title</a> " . $separator . " ";
				}
				echo $output;
			}
			the_title();
		} elseif( is_category() ) {
            $category_id = get_query_var('cat');
			echo get_category_parents( $category_id, TRUE, " $separator " );
		}
		echo '</div>';
	}
}
?>