<?php
/**
 * ndt3 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ndt3
 */

if ( ! function_exists( 'ndt3_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function ndt3_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on ndt3, use a find and replace
     * to change 'ndt3' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'ndt3', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'main-menu' => esc_html__( 'Main Menu', 'ndt3' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'ndt3_custom_background_args', array(
      'default-color' => 'ffffff',
      'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support( 'custom-logo', array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    ) );
  }
endif;
add_action( 'after_setup_theme', 'ndt3_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ndt3_content_width() {
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters( 'ndt3_content_width', 640 );
}
add_action( 'after_setup_theme', 'ndt3_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ndt3_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'ndt3' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'ndt3' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'ndt3_widgets_init' );

// Remove search widget from sidebar
function remove_default_widgets() {
  unregister_widget('WP_Widget_Search');
}
add_action( 'widgets_init', 'remove_default_widgets' );

/**
 * Enqueue scripts and styles.
 */
function ndt3_scripts() {
  wp_enqueue_style( 'ndt3-style', get_stylesheet_uri() );
  wp_enqueue_style( 'ndt3-ndt', 'https://conductor.nd.edu/stylesheets/themes/ndt/v3/ndt.css', array(), '20190403', 'all' );
  wp_enqueue_style( 'ndt3-theme', get_template_directory_uri() . '/css/theme.css', array(), '20190403', 'all' );

  wp_enqueue_script( 'ndt3-ndt', 'https://conductor.nd.edu/javascripts/themes/ndt/v3/ndt.js', array(), '20190403', true );
  wp_enqueue_script( 'ndt3-theme', get_template_directory_uri() . '/js/theme.js', array(), '20190403', true );
  //wp_enqueue_script( 'ndt3-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

  //wp_enqueue_script( 'ndt3-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'ndt3_scripts' );

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
  require get_template_directory() . '/inc/jetpack.php';
}

/* ND Additions */
function default_nav(){
  // if ( has_nav_menu( 'main-menu' ) ) {
    wp_nav_menu( array(
      'theme_location'  => 'main-menu',
      'menu'            => '',
      'container'       => 'nav',
      'container_class' => 'nav-site nav-full',
      'container_id'    => 'nav',
      'menu_class'      => 'nav-site nav-full',
      'menu_id'         => 'nav',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul class="site-nav__list">%3$s</ul>',
      // 'depth'           => 0,
      'walker'          => '',
    ) );
  // }
}

/* nav classes */
add_filter('nav_menu_css_class', 'special_nav_class', 10, 3);
function special_nav_class($classes, $item){
  if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) || in_array('current_page_item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

// function add_menuclass($ulclass) {
//   echo 'in add_menuclass';
//    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
// }
// add_filter('wp_nav_menu','add_menuclass');

add_filter('body_class', 'alter_search_classes');
function alter_search_classes($classes) {
  if(is_search()){
    return array('search-page');
  } else {
    return $classes;
  }
}

// Change <title> separator
add_filter( 'document_title_separator', 'cyb_document_title_separator' );
function cyb_document_title_separator( $sep ) {
  $sep = "|";
  return $sep;
}

/*=============================================
                BREADCRUMBS
=============================================*/
function the_breadcrumb() {
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = ' › '; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<li class="current">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb

  global $post;
  $homeLink = get_bloginfo('url');
  if (is_home() || is_front_page()) {
    if ($showOnHome == 1) {
      echo '<ol class="breadcrumbs"><li><a href="' . $homeLink . '">' . $home . '</a></li></ol>';
    }
  } else {
    echo '<ol class="breadcrumbs"><li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' </li>';
    if (is_category()) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
      }
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
    } elseif (is_search()) {
        echo $before . 'Search results for "' . get_search_query() . '"' . $after;
    } elseif (is_day()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' </li>';
        echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' </li>';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' </li>';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
            if ($showCurrent == 0) {
                $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
            }
            echo $cats;
            if ($showCurrent == 1) {
                echo $before . get_the_title() . $after;
            }
        }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
        echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
        if ($showCurrent == 1) {
            echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        }
    } elseif (is_page() && !$post->post_parent) {
        if ($showCurrent == 1) {
            echo $before . get_the_title() . $after;
        }
    } elseif (is_page() && $post->post_parent) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
            $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs)-1) {
                echo ' ' . $delimiter . ' ';
            }
        }
        if ($showCurrent == 1) {
            echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        }
    } elseif (is_tag()) {
        echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . 'Articles posted by ' . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . 'Error 404' . $after;
    }
    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
            echo ' (';
        }
        echo __('Page') . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
            echo ')';
        }
    }
    echo '</ol>';
  }
} // end the_breadcrumb()
