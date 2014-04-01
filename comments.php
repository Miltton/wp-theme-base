<?php
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( WB_Theme::_n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number() ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 
				'style' => 'ol',
				'avatar_size' => 0, 
				'format' => 'html5'
			) ); ?>
		</ol><!-- .commentlist -->
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<!-- Comment pagination -->
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php WB_Theme::_e( 'Comment navigation' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( WB_Theme::__( '&larr; Older Comments' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( WB_Theme::__( 'Newer Comments &rarr;' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php WB_Theme::_e( 'Comments are closed.' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$comment_form_args = array(
		'fields' =>  array(
		  'author' =>
		    '<p class="comment-form-author"><label for="author">' . WB_Theme::__( 'Name' ) . 
		    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		    '"' . $aria_req . ' /></p>',

		  'email' =>
		    '<p class="comment-form-email"><label for="email">' . WB_Theme::__( 'Email' ) . 
		    ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '"' . $aria_req . ' /></p>',

		 'url' =>
		    '<p class="comment-form-url"><label for="url">' . WB_Theme::__( 'Website' ) . '</label>' .
		    '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
		    '" /></p>',
		),
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . WB_Theme::_x( 'Comment', 'noun' ) . 
		'</label><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
		'comment_notes_after' => ''
	);

	comment_form( $comment_form_args ); ?>

</div><!-- #comments .comments-area -->