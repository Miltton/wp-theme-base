<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1><?php the_title(); ?></h1>
	<time><?php echo get_the_date(); ?></time>
	<?php the_content(); ?>
</article>