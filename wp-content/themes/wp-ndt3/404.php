<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ndt3
 */

get_header();
?>

<main id="main" class="page-main" role="main">

  <section class="error-404 not-found">
    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ndt3' ); ?></h1>

    <div class="page-content">
      <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ndt3' ); ?></p>

      <?php
      the_widget( 'WP_Widget_Recent_Posts' );
      ?>

      <div class="widget widget_categories">
        <h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'ndt3' ); ?></h2>
        <ul>
          <?php
          wp_list_categories( array(
            'orderby'    => 'count',
            'order'      => 'DESC',
            'show_count' => 1,
            'title_li'   => '',
            'number'     => 10,
          ) );
          ?>
        </ul>
      </div><!-- .widget -->

      <?php
      /* translators: %1$s: smiley */
      $ndt3_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'ndt3' ), convert_smilies( ':)' ) ) . '</p>';
      the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$ndt3_archive_content" );

      the_widget( 'WP_Widget_Tag_Cloud' );
      ?>

    </div><!-- .page-content -->
  </section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>
