<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php /* Title */ ?>
		<h1 class="entry-title">
		<?php if ( is_single() || is_page()) : ?>
			<?php the_title(); ?>
		<?php else : ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		<?php endif; ?>
		</h1>
		
		<?php /* Thumbnail */ ?>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<?php /* Meta */ ?>
		<div class="entry-meta">
			<?php get_template_part('entry-meta'); ?>
			<?php edit_post_link( WB_Theme::__( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header>

	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( WB_Theme::__( 'Continue reading &rarr;' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . WB_Theme::__( 'Pages:' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	
	<footer class="entry-footer">
		<?php if ( is_single() ) : ?>
			<div class="comments-link">
				<?php comments_template( '', true ); ?>
			</div><!-- .comments-link -->
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article>