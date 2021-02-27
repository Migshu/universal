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

<header class='header'> 
<div class='conteiner'> 
<div class="header-wrapper">
<?php 
// Logo
if (has_custom_logo()) {
echo '<div class="logo">' . get_custom_logo()
. '<span>' . get_bloginfo( 'name' ) . '</span>' . '</div>';
} else {
echo 'Universal';
}
?>

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
     <a href="" class="header-menu-toggle">
     <span></span>
     <span></span>
     <span></span>
     </a>
  </div>
</div>
</header> 