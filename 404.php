<?php get_header(); ?>
<section class="primary" role="main">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h1 class="entry-title"><?php _e( "404 Error - Unfortunately, page not found.", 'wpbasetheme' ); ?></h1>
	</article>
</section><!-- .primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>