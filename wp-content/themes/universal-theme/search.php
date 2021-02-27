<?php get_header();?>
<section class = "bloglist">
  <div class="conteiner">
    <h2 class="search-title">Результаты поиска по запросу:</h2>
     <div class="bloglist-wrapper">
        <div class="bloglist-content"> 

       <?php while ( have_posts() ){ the_post(); ?>
            <!-- Вывода постов, функции цикла: the_title() и т.д. -->
       
            
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
           
        
           <!-- /окончание вывода -->
<?php } ?>
<?php if ( ! have_posts() ){ ?>
	Записей нет.
<?php } ?>

        </div>
        <!-- content -->
         <!-- выводим нижний сайдбар -->
        <?php get_sidebar('bottom'); ?>
      </div>
      <!-- /wrapper -->
  <!-- Выводим пагинацию -->
    <?php 
    $args = array(
      'prev_text' => 'Назад', 
      'next_text' =>'Вперед'
      ); 
    the_posts_pagination($args)?>
   </div> 
   <!-- /conteiner -->
</section>
<?php get_footer();?>