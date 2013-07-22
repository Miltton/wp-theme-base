<?php get_header(); ?>

<?php the_breadcrumb( '»' ); ?>

<div class="views">Views: <?php the_views(); ?></div>

<section class="primary" role="main">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'content' ); ?>
	<?php endwhile; endif; ?>
</section><!-- .primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>