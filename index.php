<?php get_header(); ?>

<?php the_breadcrumb( '»' ); ?>

<section class="primary" role="main">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content' ); ?>
	<?php endwhile; ?>
	
	<?php get_template_part( 'pagination' ); ?>
		
	<?php else : ?>
		<?php _e( 'No posts found.', 'wpbasetheme' ); ?>
	<?php endif; ?>

</section><!-- .primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>