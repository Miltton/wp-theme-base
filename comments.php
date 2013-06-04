<?php

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'wpbasetheme' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 
				'style' => 'ol',
				'avatar_size' => 0, // 0 to hide avatar
				'format' => 'html5' // since version 3.6
			) ); ?>
		</ol><!-- .commentlist -->

		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<!-- Comment pagination -->
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'wpbasetheme' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'wpbasetheme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'wpbasetheme' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'wpbasetheme' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
	$comment_form_args = array(
		'fields' =>  array(
		  'author' =>
		    '<p class="comment-form-author"><label for="author">' . __( 'Name', 'wpbasetheme' ) . 
		    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		    '"' . $aria_req . ' /></p>',

		  'email' =>
		    '<p class="comment-form-email"><label for="email">' . __( 'Email', 'wpbasetheme' ) . 
		    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '"' . $aria_req . ' /></p>',

		 'url' =>
		    '<p class="comment-form-url"><label for="url">' . __( 'Website', 'wpbasetheme' ) . '</label>' .
		    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		    '" /></p>',
		),
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . 
		'</label><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
		'comment_notes_after' => ''
	);


	comment_form( $comment_form_args ); ?>

</div><!-- #comments .comments-area -->