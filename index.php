<?php get_header(); ?>
<section class="primary" role="main">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content' ); ?>
	<?php endwhile; else : ?>
		<?php _e( 'No posts found.', 'wpbasetheme' ); ?>
	<?php endif; ?>
</section><!-- .primary -->

<aside class="secondary" role="complementary">
	<?php get_sidebar(); ?>
</aside><!-- .secondary -->
<?php get_footer(); ?>