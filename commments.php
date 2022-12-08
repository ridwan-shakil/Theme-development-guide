<?php

/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress Theme
 * @subpackage Halim
 * @since Halim 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
	return;
?>

<div id="comments" class="comments-area">

	<?php if (have_comments()) : ?>
		<div class="title-text-two">
			<!-- Comments title  -->
			<?php
			printf(
				_nx('One thought on "%2$s"', '%1$s Comments ', get_comments_number(), 'comments title', 'twentythirteen'),
				number_format_i18n(get_comments_number()),
				'<span>' . get_the_title() . '</span>'
			);
			?>
		</div>

		<ol class="comment-list">
			<!-- All comment-list -->
			<?php
			wp_list_comments(array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 74,
				'callback' => 'comments_list' // This callback function helps editing comments list (add comments_list.php page )
			));
			?>
		</ol>

		<?php
		// Are there comments to navigate through?
		if (get_comment_pages_count() > 1 && get_option('page_comments')) :
		?>
			<nav class="navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text section-heading"><?php _e('Comment navigation', 'twentythirteen'); ?></h1>
				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'twentythirteen')); ?></div>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentythirteen')); ?></div>
			</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation 
		?>

		<?php if (!comments_open() && get_comments_number()) : ?>
			<p class="no-comments"><?php _e('Comments are closed.', 'twentythirteen'); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() 
	?>
	<!-- ============================== -->
	<!-- Comment Form  -->
	<!-- ============================== -->
	<?php
	//  comment_form();

	$commenter = wp_get_current_commenter();
	if (!isset($args['format']))
		$args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	$html_req = ($req ? " required='required'" : '');
	$html5    = 'html5' === $args['format'];


	$comments_args = array(
		// change the title of send button 
		'label_submit' => 'POST COMMENT',
		// change the title of the reply section
		'title_reply' => 'Add a comment',
		// remove "Text or HTML to be displayed after the set of comment fields"
		'comment_form_top' => 'ds',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		// redefine your own textarea (the comment body)
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="Your Comment* " aria-required="true"></textarea></p>',
		'fields' => apply_filters(
			'comment_form_default_fields',
			array(

				'author' =>
				'<p class="comment-form-author">'  .
					'<input id="author" class="blog-form-input" placeholder="Your Name* " name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
					'" size="30"' . $aria_req . ' /></p>',

				'email' =>
				'<p class="comment-form-email">' .
					'<input id="email" class="blog-form-input" placeholder="Your Email* " name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
					'" size="30"' . $aria_req . ' /></p>',

				'url' =>
				'<p class="comment-form-url">' .
					'<input id="url" class="blog-form-input" placeholder="Your Website URL" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
					'" size="30" /></p>'
			)
		),
	);

	comment_form($comments_args);



	?>



</div><!-- #comments -->
