<?php
/**
 * Add template tags, which WordPress dosen't offer.
 *
 * @package wpbasetheme
 */

/**
 *
 */
if( ! function_exists( 'the_numeric_pagination' ) ) :
function the_numeric_pagination()
{
    global $wp_query;
    $big = 999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}
endif;

/**
 *
 */
if( ! function_exists( 'the_blog_url' ) ) :
function the_blog_url() {
	echo get_the_blog_url();
}
endif;

/**
 *
 */
if( ! function_exists( 'get_blog_url' ) ) :
function get_blog_url() {
	return get_permalink( get_option( 'page_for_posts' ) );
}
endif;

/**
 *
 */
if( ! function_exists( 'the_breadcrumb' ) ) :
function the_breadcrumb( $separator = '&raquo;' ) {
    global $post;
    if( ! is_home() && ( is_page() || is_category() ) ) {
        echo '<div class="breadcrumb">';
        ?>
        <a href="<?php echo home_url(); ?>"><?php echo bloginfo( 'name' ); ?></a> <?php echo $separator; ?>
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
endif;
?>