<!--Important to copy from Alecaddd-->
<?php
/*
@package sunsettheme
*/
if( post_password_required() ){
	return;
}
?>
<div id="comments" class="comments-area col-xs-12">

	<?php
	if( have_comments() ):
		//We have comments
		?>

        <h2 class="comment-title">
			<?php
            echo "<h3 class='underline'>".__('Comments')."</h3>"."<strong><p>".get_comments_number().__(' Comments')."</strong></p>";
//			printf(
//				esc_html( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sunsettheme' ) ),
//				number_format_i18n( get_comments_number() ),
//				'<span>' . get_the_title() . '</span>'
//			);

			?>
        </h2>

		<?php sunset_get_post_navigation(); ?> <!--Important to copy from Alecaddd-->

        <ul class="comment-list">

			<?php

			$args = array(
				'walker'			=> null,
				'max_depth' 		=> '',
				'style'				=> 'ul',
				'callback'			=> null,
				'end-callback'		=> null,
				'type'				=> 'all',
				'reply_text'		=> 'Reply',
				'page'				=> '',
				'per_page'			=> '',
				'avatar_size'		=> 32,
				'reverse_top_level' => null,
				'reverse_children'	=> '',
				'format'            => current_theme_supports( 'html5', 'comment-list' ) ? 'html5' : 'xhtml',
				'short_ping'		=> false,
				'echo'				=> true
			);
            wp_list_comments($args);
			//wp_list_comments('type=comment&callback=format_comment');
			?>

        </ul>

		<?php sunset_get_post_navigation(); ?> <!--Important to copy from Alecaddd-->

		<?php
		if( !comments_open() && get_comments_number() ):
			?>

            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sunsettheme' ); ?></p>

			<?php
		endif;
		?>

		<?php
	endif;
	?>

	<?php

	$fields = array(

		'author' =>
			'<div class="form-group"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> <span class="required">*</span> <input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" /></div>',

		'email' =>
			'<div class="form-group"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> <span class="required">*</span><input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" /></div>',

		'url' =>
			'<div class="form-group last-field"><label for="url">' . __( 'Website', 'domainreference' ) . '</label><input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>'

	);

	$args = array(

		'class_submit' => 'btn btn-block btn-lg btn-warning',
		'label_submit' => __( 'Submit Comment' ),
		'comment_field' =>
			'<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <span class="required">*</span><textarea id="comment" class="form-control" name="comment" rows="4" required="required"></textarea></p>',
		'fields' => apply_filters( 'comment_form_default_fields', $fields )

	);

	comment_form( $args );

	?>

</div><!-- .comments-area -->