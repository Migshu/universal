<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header <?php echo get_post_type()?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75)), url(
    <?php
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url();
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
        ?>
    ) no-repeat center; background-size:cover">
    <!-- Контейнер -->
		<div class="conteiner">
		   <div class="post-header-wrapper">
					<!-- Блок навигации -->
			<div class="post-header-nav">
			<!-- выводим категории -->
		<?php
		
    foreach ( get_the_category() as $category) {
            printf(
              '<a href="%s" class="category-link %s">%s<a/>' ,
               esc_url( get_category_link( $category)) ,
               esc_html( $category -> slug) ,
               esc_html( $category -> name )
            );
					}
					?>
					<a href="<? echo get_home_url() ?>" class="home-link">
					<svg class="coments-icon" width=18px height=17px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#home"></use>
           </svg>
					На главную
					</a>
					<?php
    the_post_navigation(
			array(
				'prev_text' => '<span class="post-nav-prev">
				<svg class="prev-icon" fill="#fff" width=15px height=7px>
          <use xlink:href="' . get_template_directory_uri() .'/assets/images/sprite.svg#left-arrow"></use>
        </svg>'
				 . esc_html__( __('Prev', 'universal') ) . '</span>',
				'next_text' => '<span class="post-nav-next">'
				 . esc_html__( __('Next', 'universal') )
			   . '<svg class="next-icon" fill="#fff" width=15px height=7px>
          <use xlink:href="' . get_template_directory_uri() .'/assets/images/sprite.svg#arrow"></use>
            </svg> 
				</span>'
				)
			);
			?>
			</div>
			<!-- /post-header-nav -->
		 <div class="post-title_block">
			<?php
		if ( is_singular() ) :
			the_title( '<h1 class="post-nav_title">', '</h1>' );
		else :
			the_title( '<h2 class="post-nav_title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    endif;
		?>
		<a href="" class="post-bookmark-btn">
			  <svg class="post-flags" fill="#BCBFC2" width=19px height=19px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#bookmark"></use>
				</svg>
				</a>
			</div>
		    <p><?= mb_strimwidth(get_the_excerpt(), 0, 300, '...'); ?></p>
		  <div class="post-header-info">
              <span class="post-header-date">
							<svg class="clock-icon" fill="#BCBFC2" width=13px height=13px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock"></use>
                 </svg>
                <?php the_time('F j G:i' )?>
              </span>
              <div class="post-header-comments">
                <svg class="coments-icon" fill="#BCBFC2" width=13px height=13px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                 </svg>
               </div>
              <div class="post-header-counter">
                <?php comments_number('0', '1' , '%'); ?>
              </div>
              <div class="post-header-comments">
                <svg class="likes-icon" fill="#BCBFC2" width=13px height=13px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                 </svg>
                </div>
              <div class="post-header-counter">
                <?php comments_number('0', '1' , '%'); ?>
              </div>                            
				</div>
			
					<div class="post-author">
						<!-- блок автора -->
						<div class="post-author-bio">
						<?php $author_id = get_the_author_meta('ID')?>
						 <img src="<?= get_avatar_url($author_id) ?>" alt='' class="post-author-avatar">
          	<span class="post-author-name"><?php the_author(); ?></span>
            <span class="post-author-rank">Фрилансер</span>
						<span class="post-author-count"><?php  plural_form(
							count_user_posts($author_id),
							array('статья','статьи','статей'))?></span>
					  </div>
				   <a href="<?= get_author_posts_url($author_id) ?>" class="posts-author-link">Страница автора</a>
				</div>
        	
			</div>
			<!-- /post-header-wrapper -->
	</div>
		<!-- /conteiner-->

</header>
 
<div class="conteiner">
	<div class="post-post_content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="post-reader-text"> "%s"</span>', 'universal-theme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( __('Pages:', 'universal' ) ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- /. entry-content -->
	<footer class="post-footer">
  <?php
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'universal-theme' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'universal-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			// Ссылки на соцсети
			meks_ess_share();
    ?>
	</div>
<!-- /conteiner -->	
	</footer><!-- .post-footer -->
	
<section class="info">
<div class="conteiner">
<div class="info-post">
	<?php
$categories = get_the_category($post->ID);
if ($categories) {
  $category_ids = array();
  foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
 
    $args=array(
      'category__in' => $category_ids, 
      'post__not_in' => array($post->ID), // Не выводить текущую запись
      'showposts'=>4, // Указываем сколько похожих записей выводить
     
    );
    $my_query = new wp_query($args);
    if( $my_query->have_posts() ) {
      
      while ($my_query->have_posts()) {
        $my_query->the_post();
?>
    <div class="info-post-items">
		     <a href="<?= get_the_permalink() ?>" class="info-post-link">
		    <div class="image-post-thumbnail">
		    <img src="<?php
						//должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url(null, 'thumbnail');
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
		 ?>" alt="" class="info-post-image">
     </div>
		 <h4 class="info-post-title"><?php echo wp_trim_words( get_the_title(), 4, $more = ' …' ); ?></h4>
		 <div class="info-post-bio">
			<div class="info-post-views">
			   <svg class="views-icon" fill="#BCBFC2" width=13px height=13px>
        <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#eye"></use>
				</svg>
				 <span><?php do_action( 'pageviews' ); ?></span>
			</div>
			<div class="info-post-comments">
			   <svg class="comment-icon" fill="#BCBFC2" width=13px height=13px>
        <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
        </svg>
				 <span><?php comments_number('0', '1' , '%'); ?></span>
			</div>
    
		</div>
		</a>
		</div>
<?php
      }
    
    }
    wp_reset_query();
  }
?>
</div>
</div>
</div>
</section>
		

  
</article>
