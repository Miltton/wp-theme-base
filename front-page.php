<?php get_header(); ?>

<section class="primary full" role="main">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content' ); ?>
	<?php endwhile; endif; ?>
</section><!-- .primary -->

<?php get_footer(); ?>