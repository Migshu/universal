<?php get_header()?>
<div class = "conteiner">
  <?php if ( function_exists( 'the_breadcrumbs' ) ) the_breadcrumbs(); ?>
<h1 class = "category-page-title"><?php single_cat_title()?></h1>
<div class = "category-page-list">
<?php if ( have_posts() ){ while ( have_posts() ){ the_post(); ?>
	<!-- Вывода постов, функции цикла: the_title() и т.д. -->
  <div class="card">
  <a href="<? the_permalink() ?>" class="card-permalink">
  <img src="<?php 
           //должно находится внутри цикла
        if( has_post_thumbnail() ) {
         	echo get_the_post_thumbnail_url();
         }
        else {
	      echo get_template_directory_uri() . '/assets/images/image-default.png';
         }
          
          ?>" alt="" class="card-thumb">
  <div class="card-wrapper">
  <h2 class ="card-title"><?= wp_trim_words( get_the_title(), 5, $more = ' …' ); ?></h2>
  <p class="card-text"><?= mb_strimwidth(get_the_excerpt(), 0, 100, '...'); ?></p>
  
  <div class="card-author">
        <?php $author_id = get_the_author_meta('ID')?>
        <img src="<?= get_avatar_url($author_id) ?>" alt='' class="avatar">
        
        <div class="card-bio">
          <span class="author-name"><?php the_author(); ?></span>
          
              <div class="card-info">
              <span class="card-date">
						  <?php the_time('F j' )?>
            </span>
              <div class="card-comments">
                <svg class="coments-icon" fill="#BCBFC2" width=13px height=13px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                 </svg>
               </div>
              <div class="card-counter">
                <?php comments_number('0', '1' , '%'); ?>
              </div>
              <div class="card-comments">
                <svg class="likes-icon" fill="#BCBFC2" width=13px height=13px>
            <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                 </svg>
                </div>
              <div class="card-counter">
                <?php comments_number('0', '1' , '%'); ?>
              </div> 
              </div>                           
        </div>
 
  </div>
  <!-- /author -->
  </div>
  <!-- /wrapper -->
  </div>
  </a>
  <!-- /card -->

<?php } } else { ?>
	Записей нет.
<?php } ?>
     
<!-- page-list -->
</div> 
   <div class="category-pagination">
<!-- Выводим пагинацию -->
    <?php 
    $args = array(
      'prev_text' => __('Previous', 'universal'),
      'next_text' => __('Next', 'universal')
      ); 
    the_posts_pagination($args)?>
    </div>
</div>
<!-- /conteiner -->
<?php get_footer()?>