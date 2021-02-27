<?php get_header();?>
<!------------------- main -------------------------->
<main class="front-page-header">
  <div class='conteiner'>
    <div class="hero">
      <div class='left'>

        <?php
    global $post;

        $myposts = get_posts([ 
            'numberposts' => 1,
            'category_name'    => 'css, html, javascript, web-design',
            'orderby' => 'date',
 
        ]);

        if( $myposts ){
	        foreach( $myposts as $post ){
		      setup_postdata( $post );
	?>

        <img src="<? 
        //должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url();
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
        ?>" alt="" class="post-thumb">
        <?php $author_id = get_the_author_meta('ID')?>
        <a href='<?= get_author_posts_url($author_id) ?>' class="author">
          <img src="<?= get_avatar_url($author_id) ?>" alt='' class="avatar">
          <!-- блок автора -->
          <div class="author-bio">
            <span class="author-name"><?php the_author(); ?></span>
            <span class="author-rank">Должность</span>

          </div>
        </a>
        <!-- вывод поста -->
        <div class="post-text">
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
          <!-- Обрезаем длинный заголовок до 5 слов с помощью wp_trim_words -->
          <h2 class="post-title"><?= wp_trim_words( get_the_title(), 5, $more = ' …' ); ?></h2>
          <a href="<?= get_the_permalink() ?>" class="post-button">
            Читать далее
          </a>
        </div>

        <?php 
	      }
          } else {
	          ?><p>Постов не найдено</p>
        <?
          }

            wp_reset_postdata(); // Сбрасываем $post
    ?>

      </div>
      <!-- left -->
      <div class='right'>
        <h3 class="recommend">Рекомендуем</h3>
        <ul class="posts-list">

          <?php
        global $post;

              $myposts = get_posts([ 
                'numberposts' => 5,
                'category_name'    => 'css, html, javascript, web-design',
                'orderby' => 'date',
                'offset' => '1',
 
              ]);

          if( $myposts ){
	          foreach( $myposts as $post ){
		            setup_postdata( $post );
		        ?>
          <li class="post">
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
            <!-- Обрезаем длинный заголовок до 10 слов с помощью wp_trim_words -->
            <h4 class="post-title"><?= wp_trim_words( get_the_title(), 10, $more = ' …' ); ?></h4>
          </li>
          <?php 
	              }
            } else {
	              ?><p>Постов не найдено</p>
          <?
                }

            wp_reset_postdata(); // Сбрасываем $post
        ?>
        </ul>
      </div>
      <!-- right -->
    </div>
    <!-- Hero -->

  </div>
  <!-- Контеинер -->
</main>

<!--------------------- Секция Article -------------------------->
<section class="article-section">
  <div class="conteiner">
    <ul class="article-list">
       
      <?php
        global $post;

              $myposts = get_posts([ 
                'numberposts' => 4,
                'category_name'    => 'course',
                'orderby' => 'date'
               ]);

          if( $myposts ){
	          foreach( $myposts as $post ){
		            setup_postdata( $post );
		        ?>
  
       <li class="article-item">
         <a href="<?php the_permalink() ?>" class="article-permalink">
          <h4 class="article-title"> <?= wp_trim_words( get_the_title(), 5, $more = ' …' ); ?></h4>
         </a>  
        <img class="article-image"src="<?
        //должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url(null,'thumbnails');
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         } ?>"alt="">
      </li>
      

      <?php 
	              }
            } else {
	              ?><p>Постов не найдено</p>
      <?
                }

            wp_reset_postdata(); 
        ?>
       
    </ul>
    <!-- /article list  -->


    <div class="main-grid">
      <ul class="article-grid">
        <?php 
          // запрос
                  $query = new WP_Query( [
                      'posts_per_page' => '7',
                      'category__not_in' => array(11,19,23,24,25,26,28,32),
                     ] ); ?>

        <?php if ( $query->have_posts() ) : 
                      // содаем переменную счетчик постов
                          $cnt = 0;
                    
                      while ( $query->have_posts() ) : $query->the_post(); 
                      $cnt++;
                     
                      switch ($cnt) {
                        // вводим первый пост
                        case '1':
                         ?>

        <li class="article-grid-item article-grid-item-1">
          <a href="<? the_permalink() ?>" class="article-permalink">
            <div class="article-grid-block">
              <div class="article-grid-block-left">
                <span class="article-grid-category">
                  <? $category = get_the_category(); 
                                  echo $category[0]->name;?></span>
                <h4 class="article-grid-title">
                  <?= wp_trim_words( get_the_title(), 5, $more = ' …' ); ?>
                </h4>
                <p class="article-grid-excerpt">
                  <?= mb_strimwidth(get_the_excerpt(), 0, 100, '...'); ?>
                </p>
              </div>

              <div class="article-grid-block-right">
                <img src="<?php 
                //должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url(null,'thumbnails');
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
                ?>" alt="" class="article-grid-block-image">
              </div>
            </div>
            <div class="article-grid-info">

              <?php $author_id = get_the_author_meta('ID')?>
              <img src="<?= get_avatar_url($author_id) ?>" alt="" class="article-grid-avatar">

              <span class="article-grid-author">
                <strong>
                  <? the_author()?></strong> :
                <? the_author_meta('description')?>
              </span>

              <div class="article-grid-comments">
              <svg class="icon comments-icon" fill="#BCBFC2" width=13px height=13px >
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
              </svg>
              
              </div>
              <div class="article-grid-counter">
                <?php comments_number('0', '1' , '%'); ?>
              </div>


            </div>
          </a>
        </li>
        <?
                          break;
                          // выводим второй пост
                          case '2':
                            ?>

        <li class="article-grid-item article-grid-item-2">
          <img src="<?php 
           //должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url();
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
          
          ?>" alt="" class="article-grid-item-thumb2">
          <a href="<? the_permalink() ?>" class="article-grid-item-permalink2">

            <span class="article-grid-item-tags2">
              <?php $posttags = get_the_tags();
                                      if ($posttags) {
                                        echo $posttags[0]->name . ' ';
                                      }
                                    ?>
            </span>

            <span class="article-grid-item-category2">
              <? $category = get_the_category(); 
                                        echo $category[0]->name;?>
            </span>
            <h4 class="article-grid-item-title2">
              <?= wp_trim_words( get_the_title(), 7, $more = ' …' ); ?>
            </h4>
            <div class="article-grid-item-info-2">
              <?php $author_id = get_the_author_meta('ID')?>
              <img src="<?= get_avatar_url($author_id) ?>" alt="" class="article-grid-item-avatar2">

              <span class="article-grid-item-author2">
                <strong>
                  <? the_author()?>
                </strong>
              </span>

              <div class="article-grid-item-comments2">
                <span class="article-grid-item-data2">
                  <? the_time('j F'); ?>
                </span>
                <svg class="article-grid-item-icon2" fill="#edeff0" width=15px height=15px >
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
              </svg>
               <div class="article-grid-item-counter2">
                  <?php comments_number('0', '1' , '%'); ?>
                </div>
                <svg class="article-grid-item-icon2" fill="#edeff0" width=15px height=15px >
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
              </svg>
                
                <div class="article-grid-item-counter2">
                  <?php comments_number('0', '1' , '%'); ?>
                </div>
              </div>


            </div>




          </a>
        </li>
        <?
                        // выводим 3 пост
                            break;
                         case '3':
                          ?>
        <li class="article-grid-item article-grid-item-3">
          <a href="<? the_permalink() ?>" class="article-grid-item-permalink3">
            <img src="<?php
            //должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url();
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
            
            ?>" alt="" class="article-grid-item-thumb3">
            <h4 class="article-grid-item-title3">
              <?= wp_trim_words( get_the_title(), 3, $more = ' …' ); ?>
            </h4>

          </a>
        </li>
        <?
                       
                           break; 

                          // выводим остальные посты
                        default:
                         ?>
        <li class="article-grid-item article-grid-default">
          <a href="<? the_permalink() ?>" class="article-default-permalink">
            <h4 class="article-grid-item-title3">
              <?= wp_trim_words( get_the_title(), 3, $more = ' …' ); ?>
            </h4>
            <p class="article-grid-default-excerpt">
              <?= mb_strimwidth(get_the_excerpt(), 0, 60, '...'); ?>
            </p>
            <span class="article-grid-default-data">
              <? the_time('j F'); ?>
            </span>

          </a>
        </li>
        <?
                          break;
                      } ?>
        <!--  -->
        <?php endwhile; ?>
        <!-- конец цикла -->

        <!-- пагинация -->

        <?php wp_reset_postdata(); ?>

        <?php else : ?>
        <p><?php esc_html_e( 'There are no posts matching your criteria.' ); ?></p>
        <?php endif; ?>

      </ul>
      <!-- Подключаем сайдбар -->
      <?php get_sidebar(); ?>




    </div>
  </div>
</section>

<!------------------------- investigation ----------------------->
<section class="investigation"
  style="background: linear-gradient(0deg, rgba(64, 48, 61, 0.35), rgba(64, 48, 61, 0.35)), url(<?= get_the_post_thumbnail_url(85) ?>)no-repeat  center center; background-size:cover" >
  <?php
global $post;

$myposts = get_posts([ 
	'numberposts' => 1,
	'category_name' => 'investigation'
]);

if( $myposts ){
	foreach( $myposts as $post ){
		setup_postdata( $post );
		?>

  <div class="conteiner">
    <div class="investigation-content">
      <h2 class="investigation-title"><?= wp_trim_words( get_the_title(), 10, $more = ' …' ); ?></h2>
      <a href="<?= get_the_permalink() ?>" class="investigation-button">
        Читать статью
      </a>
    </div>
  </div>
  <?php 
	}
} else {
	
}

wp_reset_postdata(); // Сбрасываем $post
?>




</section>

<!------------------ bloglist ---------------------->
 <section class = "bloglist"> 
   <div class = "conteiner"> 

      <div class="bloglist-wrapper">
        <div class="bloglist-content">
  <?php
global $post;

$myposts = get_posts([ 
	'numberposts' => 6,
  'category_name'    => 'novosti, goryachee, mneniya',
  'orderby' => 'date',
]);

if( $myposts ){
	foreach( $myposts as $post ){
		setup_postdata( $post );
		?>

    
      <div class="bloglist-items">
        
      <div class="bloglist-left">
      <a href="<?= get_the_permalink() ?>" class="bloglist-permalink">
      <img src="<?php
        //должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url();
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
        ?>" alt="" class="bloglist-thumb" >
      </a> 
      </div>
      <!-- /left -->
      <div class="bloglist-right">
        <div class="bloglist-header">
          <span class="bloglist-category">
             
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
          
          </span>
          <svg class="bloglist-flags-icon" fill="#BCBFC2" width=19px height=19px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#bookmark"></use>
                 </svg>
        
        </div>
        <!-- /header -->
        <div class="bloglist-content">
        <a href="<?= get_the_permalink() ?>" class="bloglist-permalink">
          <h4 class="bloglist-title">
            <?= wp_trim_words( get_the_title(), 9, $more = ' …' ); ?>
          </h4>
        
          <p class="bloglist-text">
            <?= mb_strimwidth(get_the_excerpt(), 0, 150, '...'); ?>
          </p>
        </a>
        </div>
        <!-- /content -->
        <div class="bloglist-info">
              <span class="bloglist-date">
                <?php the_time('F j  g:i' )?>
              </span>
              <div class="bloglist-comments">
                <svg class="coments-icon" fill="#BCBFC2" width=13px height=13px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                 </svg>
               </div>
              <div class="bloglist-counter">
                <?php comments_number('0', '1' , '%'); ?>
              </div>
              <div class="bloglist-comments">
                <svg class="coments-icon" fill="#BCBFC2" width=13px height=13px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                 </svg>
                </div>
              <div class="bloglist-counter">
                <?php comments_number('0', '1' , '%'); ?>
              </div>                            
        </div>
        <!-- / -->
      </div>
      <!-- /right -->
    
    </div>
    <!-- /item -->
   
  <?php 
	}
} else {
	// Постов не найдено
}

wp_reset_postdata(); // Сбрасываем $post
?>
     </div>
    <!-- /content -->
      <!-- выводим нижний сайдбар -->
     <?php get_sidebar('bottom'); ?>
  </div>
    <!-- wrapper items -->
  
     
  </div>
    <!-- /conteiner -->
    
</section>

<!----------------------special----------------------->
<section class="special">
  <div class="conteiner">
    <div class="special-grid">
      
        <?php		
global $post;

$query = new WP_Query( [
	'posts_per_page' => 1,
  'category_name'  => 'fotograf',
  'orderby' => 'date'
] );

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
    <div class="photo-report">
          <!-- Slider main container -->
<div class="swiper-container photo-report-slider">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
          <!-- Slides -->
          <?php $images = get_attached_media( 'image' );
            foreach( $images as $image ) {
              echo '<div class="swiper-slide"><img src="';
              printf( $image -> guid );
              echo '"> </div>';
            }
          ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
</div>
        <div class="photo-report-content">
        <!-- category -->
        <a href="" class="photo-report-category">
         <?php 
          foreach ( get_the_category() as $category) {
            printf(
              '<a href="%s" class="photo-report-category-link">%s<a/>' ,
               esc_url( get_category_link( $category)) ,
               esc_html( $category -> name )
            );
          }
           ?>
        </a>
        <!-- блок автора -->
         <div class="photo-report-items">
          <?php $author_id = get_the_author_meta('ID')?>
          <a href='<?= get_author_posts_url($author_id) ?>' class="photo-report-link">
          <img src="<?= get_avatar_url($author_id) ?>" alt='' class="photo-report-avatar">
          <div class="photo-report-name"><?php the_author(); ?></div>
          <div class="photo-report-rank">Должность</div>
          </a>
        
        
          <h3 class="photo-report-title"><?= wp_trim_words( get_the_title(), 9, $more = ' …' ); ?></h3>
          <a href="<?php echo get_the_permalink() ?>" class="button photo-report-button">
            <svg class="photo-report-icon">
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#images"></use>
            </svg>
             Смотреть фото
             <span class="photo-report-button-counter"><?php echo count($images)?></span>
          </a>
          </div> 
          <!-- items -->
        
        </div>
        <!-- /photo-report-content -->
       
    </div>
      <!-- /photo-report -->
		<?php 
	}
} else {
	// Постов не найдено
}

wp_reset_postdata(); // Сбрасываем $post
?>
     
      <div class="other">
       <div class="career">
        <?php 
          // запрос
                  $query = new WP_Query( [
                      'posts_per_page' => '3',
                      'category_name' => 'career',
                     ] ); ?>

        <?php if ( $query->have_posts() ) : 
                      // содаем переменную счетчик постов
                          $cnt = 0;
                    
                      while ( $query->have_posts() ) : $query->the_post(); 
                          $cnt++;
                     
                      switch ($cnt) {
                        // вводим первый пост
                        case '1':
                         ?>
          <div class="career-top">
                <span class="career-top-category">
                 <?php 
                foreach ( get_the_category() as $category) {
                 printf(
                  '<a href="%s" class="">%s<a/>' ,
                  esc_url( get_category_link( $category)) ,
                  esc_html( $category -> name )
                  );
               }
           ?>
                  </span>
                <h4 class="career-top-title">
                  <?= wp_trim_words( get_the_title(), 5, $more = ' …' ); ?>
                </h4>
                <p class="career-top-text">
                  <?= mb_strimwidth(get_the_excerpt(), 0, 100, '...'); ?>
                </p>
                <a href="<? the_permalink() ?>" class="career-top-button">
                 Читать далее
                </a>
          </div>
                         
            
                         <?php
                         break;
                        // вводим остальные посты
                        default:
                         ?>
          <div class="career-default">
          <a href="<? the_permalink() ?>" class="career-default-link">
            <h4 class="career-default-title">
              <?= wp_trim_words( get_the_title(), 3, $more = ' …' ); ?>
            </h4>
            <p class="career-default-text">
              <?= mb_strimwidth(get_the_excerpt(), 0, 60, '...'); ?>
            </p>
            <span class="career-default-time">
              <? the_time('j F'); ?>
            </span>
          </a>
          </div>
                         <?
                         break;
                         
                         
                      } ?>
        <!--  -->
        <?php endwhile; ?>
        <!-- конец цикла -->

        <!-- пагинация -->

        <?php wp_reset_postdata(); ?>

        <?php else : ?>
        <p><?php esc_html_e( 'There are no posts matching your criteria.' ); ?></p>
        <?php endif; ?>

      </div>
        
      </div>
      <!-- /other -->
    </div>
  <!-- /special-grid -->
  </div>
  <!-- /conteiner -->

</section>
<?php get_footer();?>

  