<?php
/**
 * The header for our theme
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head >
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
   <?php wp_head();?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class='single-header'> 
  <div class='conteiner'> 
     <div class="single-header-wrapper">
     <div class="logo">
     <?php 
     // Logo
      $header_logo = get_theme_mod('header_logo');
      $img = wp_get_attachment_image_src($header_logo, 'full');
     if ($img) :
    ?>
    <img src="<?php echo $img[0]; ?>" alt="">
     <?php endif; ?>
     <span><?php echo get_bloginfo( 'name' )?></span>
     </div>
    <?php  
     // Navigation menu
    wp_nav_menu( [
	    'theme_location'  => 'header_menu',
      'container'       => 'nav', 
      'container_class' => 'header-nav', 
      'menu_class'      => 'header-menu',
      'echo'            => true,
    
] );
     ?>
      <!-- Форма поиска -->
     <?php echo get_search_form(); ?>
     <!-- burger menu -->
     <a href="" class="single-header-menu-toggle">
     <span></span>
     <span></span>
     <span></span>
     </a>
  </div>
</div>
</header> 