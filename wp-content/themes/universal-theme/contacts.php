<?php
/*
Template Name: Страница контакты
Template Post Type: page 
*/

// … остальной код шаблона
get_header()?>
<section class="section-dark">
  <div class="conteiner">
    <h1 class="page-title"><?php the_title();?></h1>
    
    <div class="contacts-wrapper">
      <div class="contacts-left">
      <h2 class="contacts-title">Через форму обратной связи</h2>
      <!-- <form action="contacts_form" class="contacts-form" method="POST">
      <input name="contact_name" type="text" class="input contacts-input" placeholder="Ваше имя">
      <input name="contact_email" type="email" class="input contacts-input" placeholder="Ваш Email">
      <textarea name="contact_comment" id="" class="textarea contacts-textarea"placeholder="Ваше сообщение"></textarea>
      <button class="submit button">Отправить</button>
      </form> -->
      <?php echo do_shortcode( '[contact-form-7 id="213" title="Contact Form"]' )?>
      </div>
    <!-- /left -->
      <div class="contacts-right">
         <h2 class="contacts-title">Или по этим контактам</h2>
         <?php 
         $my_email = get_post_meta( get_the_ID(), 'my_email', true );
         if ($my_email) { echo '<a href="mailto:' . $my_email . '">' . $my_email . '</a>';}
       
         $address = get_post_meta( get_the_ID(), 'address', true);
         if ($address) { echo '<address>' . $address . '</address>';}

         $phone = get_post_meta( get_the_ID(), 'phone', true );
         if ($phone) { echo '<a href="tel: +2 800 089 45-34' . $phone . '">' . $phone . '</a><br>';}
         ?>
        <p class="phone_2"><?php the_field('phone_2')?></p>
        
      </div>
    <!-- /right -->
    </div>
  <!-- /wrapper -->
  </div>
<!-- /conteiner -->
</section>

<?php get_footer()?>