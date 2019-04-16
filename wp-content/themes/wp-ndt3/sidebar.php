<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ndt3
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
  return;
}
?>

<div class="page-sidebar widget-area">
  <?php default_nav(); ?>
  <hr>
  <?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- .page-sidebar -->
