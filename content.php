<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	// Title
	if( is_page() ) : ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php else : ?>
	<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<time><?php echo get_the_date(); ?></time>
	<?php endif; ?>
	
	<?php 
	// Content
	the_content( 'continue reading' ); ?>
	
	<?php 
	// Comments
	if( is_singular( array( 'post' ) ) ) : ?>
	<?php comments_template( '', true ); ?>
	<?php endif; ?>
</article>