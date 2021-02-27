<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package universal-theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

//  Создаем свою функцию вывода коментариев

function universal_theme_comment( $comment, $args, $depth ) {
  // Проверяем в каком стиле наш родитель (ol,ul,div)
	if ( 'div' === $args['style'] ) {
    // если стиль - div, то тег будет - div 
		$tag       = 'div';
		$add_below = 'comment';
	} else {
    // В другом случае используем - li
		$tag       = 'li';
		$add_below = 'div-comment';
	}
  // Какие классы вешаем на каждый комментарий
	$classes = ' ' . comment_class( empty( $args['has_children'] ) ? '' : 'parent', null, null, false );
	?>

	<<?php echo $tag, $classes; ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) { ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comments-body"><?php
	} ?>
      <div class="comments-author-avatar">
       <!-- вывод аватара -->
     <?php 
    if ( $args['avatar_size'] != 0 ) {
			echo get_avatar( $comment, $args['avatar_size'] );
		}?>
    </div>
    <!-- /вывод аватара -->

    <div class="comments-content">
    	<div class="comments-author vcard">
		<?php
		printf(
			__( '<cite class="comments-author-name">%s</cite>' ),
			get_comment_author_link()
		);
		?>
    	<span class="comments-author-meta commentmetadata">
		<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
			printf(
				__( '%1$s  %2$s' ),
				get_comment_date("F jS,"),
				get_comment_time()
			); ?>
		</a>

		<?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
     </span>
     
	 
	<?php if ( $comment->comment_approved == '0' ) { ?>
		<em class="comment-awaiting-moderation">
			<?php _e( 'Your comment is awaiting moderation.' ); ?>
		</em><br/>
	<?php } ?>
  
  <?php comment_text(); ?>
    
    <div class="comments-reply">
     <svg class="comments-add-icon" fill="#BCBFC2" width=13px height=13px>
        <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
        </svg>
		 <?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				)
			)
		); ?>
   </div>
   <!-- /comment-reply -->
 
  <?php if ( 'div' != $args['style'] ) { ?>
		</div>
	<?php }
}


if ( post_password_required() ) {
	return;
}
?>

<div class="conteiner">
<div id="comment" class="comment-area">

	<?php
	// Проверка есть ли комментарии !
	if ( have_comments() ) :
		?>
		<div class="comment-header">
    <h2 class="comment-title">
      <?php echo 'Комментарии ' .
       '<span class="comment-count">' . get_comments_number() . '</span>';
       ?>
		  </h2><!-- .comments-title -->
      <a href="#" class="comment-add-button">
        <svg class="comment-add-icon" fill="#BCBFC2" width=18px height=18px>
        <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#pencil"></use>
        </svg>
       Добавить комментарии
      </a>
    </div>
		<?php the_comments_navigation(); ?>
    <!-- Выводим список коментариев -->
		<ol class="comments-list">
			<?php
      // Выводим каждый отдельный комментарий
			wp_list_comments(
				array(
					'style'      => 'ol',
          'short_ping' => true,
          'avatar_size' => 75,
          'callback'=> 'universal_theme_comment',
          'login_text'=>'Зарегестрируйтесь, если хотите прокоментировать.',
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'universal-example' ); ?></p>
			<?php
		endif;

  endif; // Check for have_comments().
  
  $comments_args = array(
		// изменим название кнопки
		'label_submit' => 'Отправить',
	
		// удалим текст, который будет показано после того как коммент отправлен
		'comment_notes_after' => '',
	
);



	comment_form(array(
    'must_log_in'   => '<p class="must-log-in">' . 
		 sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	'logged_in_as'         => '',
	'title_reply'     => '',
    // переопределим textarea (тело формы)
    'comment_field' => '<div class="comment-form-area">
    <label for="comment" class="comment-form-label">' . _x( 'What do you think about this? ', 'noun' ) . '</label>
    <div class="comment-form-wrapper">
    ' . get_avatar(get_current_user_id(  ), 75) . '
    <div class="comment-form-textarea"><p class="comment-form-text"><textarea id="comment" class="comment-form-comm" name="comment" aria-required="true"></textarea></p></div>
    </div></div>',
    'label_submit'  => 'Отправить',
    'class_submit'  => 'submit',
    'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',

  ));
	?>
  </div>
</div>
