<?php
/**
 * The sidebar containing the main widget area
 *
 */

if ( ! is_active_sidebar( 'main-sidebar-bottom' ) ) {
	return;
}
?>

<aside class="sidebar_bottom-front-page">
	<?php dynamic_sidebar( 'main-sidebar-bottom' ); ?>
</aside><!-- #secondary -->