<footer class="footer">
  <div class="conteiner">
  <div class="footer-form-wrapper">
      <h3 class="footer-form-title">Подпишитесь на нашу рассылку</h3>
    <form action="https://app.getresponse.com/add_subscriber.html" accept-charset="utf-8" method="post" class="footer-form">
	    <!-- Поле Email (обязательно) -->
	    <input required type="text" name="email" placeholder="Введите email" class="input footer-form-input"/>
	    <!-- Токен списка -->
	    <!-- Получить API ID на: https://app.getresponse.com/campaign_list.html -->
	    <input type="hidden" name="campaign_token" value="B9p86" />
      <!-- страница благодарности -->
      <input type="hidden" name="thankyou_url" value="<?php echo home_url('thankyou')?>"/>
	    <!-- Добавить подписчика в цикл на определенный день (по желанию) -->
	    <input type="hidden" name="start_day" value="0" />
	    <!-- Кнопка подписаться -->
	    <button type="submit" value="Подписаться">Подписаться</button>
   </form>
  </div>
    <?php
    if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	  return;
    }
    ?>

      <div class="footer-menu-bar">
	    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
      </div>
      <!-- /footer-menu-bar -->
      <div class="footer-info">
      <div class="footer-wrapper">
       <?php 
     // Logo
      $header_logo = get_theme_mod('header_logo');
      $img = wp_get_attachment_image_src($header_logo, 'full');
     if ($img) :
    ?>
    <img src="<?php echo $img[0]; ?>" alt="" width='40px'>
     <?php endif; 
       
     // Navigation menu
      wp_nav_menu( [
	    'theme_location'  => 'footer_menu',
      'container'       => 'nav', 
      'menu_class'      => 'footer-nav',
      'echo'            => true,
    
     ] );?>
     
     </div>
      <?
    // Social Widget
      $instance  = array(
        'title2' => '',
        'link_1' => 'http://facebook.com/',
        'link_2' => 'http://twitter.com/' ,
        'link_3' => 'http://youtube.com/',
      );
       $args = array(
         'before_widget' => '<div class="widget_soсial">',
         'after_widget' => '</div>',
       );
      the_widget( 'Soсial_Widget', $instance, $args );
      ?>
      </div>
      <!-- /footer-info -->
      <div class="footer-text-wrapper">
        <?php
         if ( ! is_active_sidebar( 'text-footer' ) ) {
	      return;
        }
       ?>

      <div class="footer-text-items">
	    <?php dynamic_sidebar( 'text-footer' ); ?>
         <span class="footer-copyright">
      <?php echo the_field('phone_2'). '  &copy  ' . date('Y') .' '. get_bloginfo( 'name' ).'<br>' . get_post_meta(130, 'my_email', true)?>
         </span>
      </div>
      
      </div>
     
  </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>