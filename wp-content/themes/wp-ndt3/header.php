<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ndt3
 */

$ndt3_description = get_bloginfo( 'description', 'display' );
$description_location = (get_theme_mod( 'description_location_below' )) ? 'below' : 'above';
$description_class = ($description_location == 'below') ? 'site-tagline' : 'site-parent';
$has_parent = ( strlen($ndt3_description) > 0 && $description_location == 'above' ) ? 'has-parent' : '';
$has_logo = (has_custom_logo()) ? 'has-logo' : '';

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://static.nd.edu/" crossorigin>
  <link rel="preconnect" href="https://emergency.nd.edu/">
  <link rel="preconnect" href="https://ajax.googleapis.com/">
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="shortcut icon" href="<?= get_template_directory_uri() ?>/favicon.ico">
  <link rel="apple-touch-icon" sizes="57x57" href="https://static.nd.edu/images/webclips/default/webclip-57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="https://static.nd.edu/images/webclips/default/webclip-60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="https://static.nd.edu/images/webclips/default/webclip-72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="https://static.nd.edu/images/webclips/default/webclip-76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="https://static.nd.edu/images/webclips/default/webclip-114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="https://static.nd.edu/images/webclips/default/webclip-120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="https://static.nd.edu/images/webclips/default/webclip-144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="https://static.nd.edu/images/webclips/default/webclip-152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="https://static.nd.edu/images/webclips/default/webclip-180.png">
  <link rel="apple-touch-icon" sizes="512x512" href="https://static.nd.edu/images/webclips/default/webclip-512.png">
  <link rel="icon" type="image/png" href="https://static.nd.edu/images/monogram/favicon-16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="https://static.nd.edu/images/monogram/favicon-32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="https://static.nd.edu/images/monogram/favicon-96.png" sizes="96x96">
  <link rel="mask-icon" href="https://static.nd.edu/images/monogram/monogram.svg" color="#002b5c">
  <meta name="msapplication-TileColor" content="#002b5c">
  <meta name="msapplication-TileImage" content="https://static.nd.edu/images/webclips/default/webclip-144.png">
  <meta name="theme-color" content="#002b5c">
  <?php wp_head(); ?>
  <!--[if IE]>
  <link rel='stylesheet' href='<?= get_template_directory_uri() . '/css/ie.css'; ?> type='text/css'>
  <![endif]-->
  <!--[if lt IE 9]>
    <script src="https://static.nd.edu/js/html5shiv.min.js"></script>
    <script src="https://static.nd.edu/js/respond.js"></script>
  <![endif]-->
</head>

<body <?php body_class(); ?> vocab="https://schema.org/">

<!-- Skip links -->
<nav class="skip-links" aria-label="Skip links">
  <ul>
    <li><a href="#content" accesskey="C" title="Skip to content = C">Skip To Content</a></li>
    <li><a href="#nav" accesskey="S" title="Skip to navigation = S">Skip To Navigation</a></li>
    <li><a href="#search-input-nav-top">Skip To Search</a></li>
  </ul>
</nav>

<!-- Mobile Drawer -->
<div class="nav-mobile" id="nav-mobile"></div>

<div class="wrapper nav-top-false" id="wrapper">

  <!-- Site Header -->
  <header id="header" role="banner" class="site-header <?= $has_logo; ?>">
    <p class="mark-header"><a href="https://www.nd.edu/">University of Notre Dame</a></p>
    <?php  ?>
    <div class="site-title-group <?= $has_parent; ?>">
      <?php
      if( has_custom_logo() ){
        the_custom_logo();
      } else {
        echo '<p id="site-title" class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></p>';
      }
      if( $ndt3_description || is_customize_preview() ){
        echo '<p id="'. $description_class .'" class="'. $description_class .'">'. $ndt3_description .'</p>';
      }
      ?>
    </div><!-- .site-title-group -->

    <!-- Header Search/Nav  -->
    <div class="nav-header">
      <div class="nav-search-wrapper">
        <?php get_search_form(); ?>
      </div>
    </div>

    <!-- Mobile Navbar -->
    <div class="nav-mobile-util">
      <ul class="no-bullets">
        <li><a href="/"><svg class="icon" data-icon="home"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-home"></use></svg> Home</a></li>
        <!-- <li><a href="/about/contact/"><svg class="icon" data-icon="envelope-o"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-envelope-o"></use></svg> Contact</a></li> -->
        <li><button class="btn-search search-toggle"><svg class="icon" data-icon="search"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-search"></use></svg> Search</button>
        <li>
          <a href="#nav" class="nav-menu nav-skip">
          <svg version="1.1" class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" xml:space="preserve">
            <line class="ni ni1" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" x1="0.98" y1="2" x2="18.94" y2="2"/>
            <line class="ni ni2" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" x1="0.98" y1="8.69" x2="18.94" y2="8.69"/>
          </svg>
          <span class="ni ni3">Menu</span>
        </a>
        </li>
      </ul>
      <div class="nav-search-wrapper">
        <?php get_search_form(); ?>
      </div>
    </div>

  </header><!-- #masthead -->

  <!-- Site Content -->
  <div id="content" class="site-content">
    <div class="page-header <?= get_theme_mod( 'header_image' ); ?>"></div>
