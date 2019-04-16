<?php
/**
 * ndt3 Theme Customizer
 *
 * @package ndt3
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function ndt3_customize_register( $wp_customize ) {
  require get_template_directory() . '/inc/radio-image.php';

  wp_enqueue_style( 'ndt3-customizer-css', get_template_directory_uri() . '/css/customizer.css', array( 'customize-preview' ), '20190403', 'all' );

  // Remove some settings
  $wp_customize->remove_section( 'colors');
  $wp_customize->remove_section( 'background_image');

  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  // $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
      'selector'        => '.site-title a',
      'render_callback' => 'ndt3_customize_partial_blogname',
    ) );
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
      'selector'        => '.site-description',
      'render_callback' => 'ndt3_customize_partial_blogdescription',
    ) );
  }

  /* Tagline Location */
  $wp_customize->add_setting( 'description_location_below', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'description_location_sanitize_checkbox',
  ) );
  $wp_customize->add_control( 'description_location_below', array(
    'type' => 'checkbox',
    'section' => 'title_tagline',
    'label' => __( 'Display Tagline below Site Title' ),
    'description' => __( 'Customize Tagline location' ),
  ) );
  function description_location_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
  }

  /* Footer */
  $wp_customize->add_setting( 'address' );
  $wp_customize->add_control( 'address', array(
    'label' => 'Address',
    'section' => 'title_tagline',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'phone' );
  $wp_customize->add_control( 'phone', array(
    'label' => 'Phone',
    'section' => 'title_tagline',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'fax' );
  $wp_customize->add_control( 'fax', array(
    'label' => 'Fax',
    'section' => 'title_tagline',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'email' );
  $wp_customize->add_control( 'email', array(
    'label' => 'Email',
    'section' => 'title_tagline',
    'type' => 'text',
  ) );

  /* Social */
  $wp_customize->add_section( 'social' , array(
    'title'      => 'Social',
    'priority'   => 30,
  ) );
  $wp_customize->add_setting( 'social_facebook' , array(
    'transport'   => 'postMessage',
  ) );
  $wp_customize->add_control( 'social_facebook', array(
    'label' => 'Facebook URL',
    'section' => 'social',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'social_twitter' , array(
    'transport'   => 'postMessage',
  ) );
  $wp_customize->add_control( 'social_twitter', array(
    'label' => 'Twitter URL',
    'section' => 'social',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'social_instagram' , array(
    'transport'   => 'postMessage',
  ) );
  $wp_customize->add_control( 'social_instagram', array(
    'label' => 'Instagram URL',
    'section' => 'social',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'social_youtube' , array(
    'transport'   => 'postMessage',
  ) );
  $wp_customize->add_control( 'social_youtube', array(
    'label' => 'YouTube URL',
    'section' => 'social',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'social_linkedin' , array(
    'transport'   => 'postMessage',
  ) );
  $wp_customize->add_control( 'social_linkedin', array(
    'label' => 'LinkedIn URL',
    'section' => 'social',
    'type' => 'text',
  ) );

  /* Organization */
  $wp_customize->add_setting( 'parent_org_1_name' );
  $wp_customize->add_control( 'parent_org_1_name', array(
    'label' => 'Parent Organization 1 Name',
    'section' => 'title_tagline',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'parent_org_1_url' );
  $wp_customize->add_control( 'parent_org_1_url', array(
    'label' => 'Parent Organization 1 URL',
    'section' => 'title_tagline',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'parent_org_2_name' );
  $wp_customize->add_control( 'parent_org_2_name', array(
    'label' => 'Parent Organization 2 Name',
    'section' => 'title_tagline',
    'type' => 'text',
  ) );
  $wp_customize->add_setting( 'parent_org_2_url' );
  $wp_customize->add_control( 'parent_org_2_url', array(
    'label' => 'Parent Organization 2 URL',
    'section' => 'title_tagline',
    'type' => 'text',
  ) );

  // PAGE HEADER IMAGES
  // Register the radio image control class as a JS control type.
  $wp_customize->register_control_type( 'Customize_Control_Radio_Image' );

  // Section
  $wp_customize->add_section('header_image', array(
    'title' => esc_html__( 'Header Image', 'header-image' ),
    'priority' => 30
  ) );

  // Settings
  $wp_customize->add_setting(
    'header_image',
    array(
      'default'           => 'campus',
      'transport'   => 'postMessage',
      'sanitize_callback' => 'sanitize_key',
    )
  );

  // Controls
  $wp_customize->add_control(
    new Customize_Control_Radio_Image(
      $wp_customize,
      'header_image',
      array(
        'label'    => esc_html__( 'Header Image', 'header-image' ),
        'section'  => 'header_image',
        'choices'  => array(
          'campus' => array(
            'label' => esc_html__( 'Campus', 'header-image' ),
            'url'   => get_template_directory_uri() . '/css/images/hdr-campus-300.jpg'
          ),
          'clover' => array(
            'label' => esc_html__( 'Clover', 'header-image' ),
            'url'   => get_template_directory_uri() . '/css/images/hdr-clover-300.jpg'
          ),
          'dome' => array(
            'label' => esc_html__( 'Dome', 'header-image' ),
            'url'   => get_template_directory_uri() . '/css/images/hdr-dome-300.jpg'
          ),
          'vinewall' => array(
            'label' => esc_html__( 'Vine Wall', 'header-image' ),
            'url'   => get_template_directory_uri() . '/css/images/hdr-vinewall-300.jpg'
          )
        )
      )
    )
  );

}
add_action( 'customize_register', 'ndt3_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ndt3_customize_partial_blogname() {
  bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ndt3_customize_partial_blogdescription() {
  bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ndt3_customize_preview_js() {
  wp_enqueue_script( 'ndt3-customizer-js', get_template_directory_uri() . '/inc/js/customizer.js', array( 'jquery' ), false, true );
}
add_action( 'customize_preview_init', 'ndt3_customize_preview_js' );

function ndt3_customizer_controls() {
  wp_enqueue_script( 'ndt3-contextualcontrols', get_template_directory_uri() . '/inc/js/customizer-contextual.js?v=' . rand(), array( 'customize-controls' ), false );
}
add_action( 'customize_controls_enqueue_scripts', 'ndt3_customizer_controls' );

