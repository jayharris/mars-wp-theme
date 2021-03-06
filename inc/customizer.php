<?php
/**
 * Twenty Seventeen: Mars
 *
 */

add_filter( 'gettext', 'mars_change_label_names');

/**
 * Updates the Tagline field to "Short Title" in the theme customizer.
 *
 */
function mars_change_label_names($translated_text){

    if (is_admin()){
        switch ( $translated_text ) {
            /*
            case 'Site Title' :

                $translated_text = __( 'New Site Title label', 'theme_text_domain' );
                break;
            */
            case 'Tagline' :

                $translated_text = __( 'Menu and Responsive Mode Title', 'theme_text_domain' );
                break;
        }
    }

    return $translated_text;
}

add_action( 'customize_register', 'mars_customizer_settings' );

/**
 * Using the Theme Customization API, adding fields for the front-page template.
 *
 */
function mars_customizer_settings( $wp_customize ) {

  // Used for information boxes used in the customizer.
  $mars_info_text_style = 'style="padding: 15px; background-color: #fbffdb; border: solid 1px #CCC; border-radius: 5px;"';
  $custom_homepage_description = __('<div ' . $mars_info_text_style . '>Please visit the <a href="https://www.unlv.edu/style-guide/wp-documentation" target="_blank">Custom Homepage Setup Instructions</a> page before using any features within this section.</div>', 'mars');

  // Create homepage panel.
  $wp_customize->add_panel( 'panel_front_page', array(
      'priority'       => 100,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __('Custom Homepage Template', 'mars'),
      'description'    => __('<p>Included with this theme is a custom homepage you can use.</p>' . $custom_homepage_description, 'mars'),
  ) );

  // Move "Homepage Settings" section into the "Homepage Settings" (panel_front_page) panel.
  // Customize section title and priority.

  $wp_customize->get_section( 'static_front_page' )->priority  = 20;
  /*
  $wp_customize->get_section( 'static_front_page' )->panel  = 'panel_front_page';
  $wp_customize->get_section( 'static_front_page' )->title  = __( 'Homepage Display Options' );
  */

  // Get Tag Line control, we use it as the Short Title.
  $wp_customize->get_control( 'blogdescription' )->description = __( 'This is used for the menu heading and also replaces your "Site Title" when your website is displayed on a mobile device or tablet.<br><strong>25 character max.</strong>' );

  $wp_customize->get_control( 'blogdescription' )->input_attrs = array( 'maxlength' => 25);

  $wp_customize->get_control( 'site_icon' )->description .= '<p><strong>If you do not specify a Site Icon, then a UNLV Site Icon will be used.</strong></p>';


  // Hero Image Options
  // ##############################################

  // Create section Front Page options.
  $wp_customize->add_section( 'mars_frontpage_hero_image' , array(
    'title'      => 'Hero Image Settings',
    'priority'   => 30,
    'panel'  => 'panel_front_page',
    'description'    => $custom_homepage_description,
  ) );

  // Create hero image display toggle.
  $wp_customize->add_setting( 'hero_toggle_display' , array(
        'default'     => 'show',
        'transport'   => 'refresh',
  ) );

    $wp_customize->add_control( 'hero_toggle_display', array(
        'label' => 'Toggle Hero Display',
        'section' => 'mars_frontpage_hero_image',
        'settings' => 'hero_toggle_display',
        'description' => __( 'Show or hide the Hero Image?'),
        'type' => 'radio',
        'choices' => array(
          'show' => 'Show',
          'hide' => 'Hide',
        ),
  ) );

  // Create hero image upload form control.
  $wp_customize->add_setting( 'hero_image' , array(
      'transport'   => 'refresh',
      'default' => get_template_directory_uri() . '/assets/images/D65847_18.jpg',
  ) );

  $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'hero_image',
           array(
               'label'      => __( 'Hero Image', 'mars' ),
               /*'description' => __( 'When no image selected, a default campus image is used.' ),*/
               'section'    => 'mars_frontpage_hero_image',
               'settings'   => 'hero_image',
           )
       )
   );

  // Create hero text heading field.
  $wp_customize->add_setting( 'hero_image_heading' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'hero_image_heading', array(
      'label' => 'Hero Image Heading',
      'section' => 'mars_frontpage_hero_image',
      'type'   => 'text',
  ) );

  // Create hero description field.
  $wp_customize->add_setting( 'hero_image_description' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'hero_image_description', array(
      'label' => 'Hero Image Description (HTML allowed)',
      'section' => 'mars_frontpage_hero_image',
      'type'   => 'textarea',
  ) );

  // Create hero alt text field.
  $wp_customize->add_setting( 'hero_image_alt' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'hero_image_alt', array(
      'label' => 'Hero Image Alt Text',
      'section' => 'mars_frontpage_hero_image',
      'type'   => 'textarea',
  ) );

  // Section One Options
  // ##############################################

  $wp_customize->add_section( 'mars_frontpage_section_one' , array(
    'title'      => 'Section One Options',
    'priority'   => 30,
    'panel'  => 'panel_front_page',
    'description'    => $custom_homepage_description,
  ) );

    $wp_customize->add_setting( 'section_one_toggle_display' , array(
        'default'     => 'show',
        'transport'   => 'refresh',
  ) );

    $wp_customize->add_control( 'section_one_toggle_display', array(
        'label' => 'Toggle Section Display',
        'section' => 'mars_frontpage_section_one',
        'description' => __( 'You will need to refresh the page after you publish when showing a section.' ),
        'settings' => 'section_one_toggle_display',
        'type' => 'radio',
        'choices' => array(
          'show' => 'Show',
          'hide' => 'Hide',
        ),
  ) );

  // Create card text heading field.
  $wp_customize->add_setting( 'section_one_card_heading' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'section_one_card_heading', array(
      'label' => 'Card Heading',
      'section' => 'mars_frontpage_section_one',
      'type'   => 'text',
  ) );

  // Create card text.
  $wp_customize->add_setting( 'section_one_card_text' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'section_one_card_text', array(
      'label' => 'Card Text (HTML Allowed)',
      'section' => 'mars_frontpage_section_one',
      'type'   => 'textarea',
  ) );

  // Right column text.
  $wp_customize->add_setting( 'section_one_right_column_text' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'section_one_right_column_text', array(
      'label' => 'Right Column Text (HTML Allowed)',
      'section' => 'mars_frontpage_section_one',
      'type'   => 'textarea',
  ) );

  // Section Two Options
  // ##############################################

  // Create section for second section options.
  $wp_customize->add_section( 'mars_frontpage_section_two' , array(
    'title'      => 'Section Two Options',
    'priority'   => 30,
    'panel'  => 'panel_front_page',
    'description'    => $custom_homepage_description,
  ) );

  $wp_customize->add_setting( 'section_two_toggle_display' , array(
      'default'     => 'show',
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'section_two_toggle_display', array(
      'label' => 'Toggle Section Display',
      'section' => 'mars_frontpage_section_two',
      'settings' => 'section_two_toggle_display',
      'description' => __( 'You will need to refresh the page after you publish when showing a section.' ),
      'type' => 'radio',
      'choices' => array(
          'show' => 'Show',
          'hide' => 'Hide',
      ),
  ) );

  // Create section two image upload form control.
  $wp_customize->add_setting( 'section_two_image' , array(
      'transport'   => 'refresh',
      'default' => get_template_directory_uri() . '/assets/images/D67387_23-1.jpg',
  ) );

  $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'logo',
           array(
               'label'      => __( 'Section Image', 'mars' ),
               'section'    => 'mars_frontpage_section_two',
               'settings'   => 'section_two_image',
           )
       )
   );

  // Create second image caption text field.
  $wp_customize->add_setting( 'section_two_image_caption' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'section_two_image_caption', array(
      'label' => 'Section Image Caption Text',
      'section' => 'mars_frontpage_section_two',
      'type'   => 'textarea',
  ) );

  // Create second image alt text field.
  $wp_customize->add_setting( 'section_two_image_alt' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'section_two_image_alt', array(
      'label' => 'Section Image Alt Text',
      'section' => 'mars_frontpage_section_two',
      'type'   => 'textarea',
  ) );

  // Right column text.
  $wp_customize->add_setting( 'section_two_right_column_text' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'section_two_right_column_text', array(
      'label' => 'Right Column Text (HTML Allowed)',
      'section' => 'mars_frontpage_section_two',
      'type'   => 'textarea',
  ) );

  // Advanced Options
  // ##############################################

  // Create section for advanced options.
  $wp_customize->add_section( 'mars_frontpage_advanced' , array(
      'title'      => 'Advanced Options',
      'priority'   => 30,
      'panel'  => 'panel_front_page',
      'description'    => $custom_homepage_description,
  ) );

  // Create second image caption text field.
  $wp_customize->add_setting( 'frontpage_advanced_content' , array(
      'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'frontpage_advanced_content', array(
      'label' => 'Custom Code (HTML Allowed)',
      'section' => 'mars_frontpage_advanced',
      'type'   => 'textarea',
      'description' => __( '<strong>Content will appear at bottom of page.</strong>' ),
  ) );

  // Pass to customizer.js for real-time updates during theme customization.

  // Hero image settings.
  $wp_customize->get_setting( 'hero_toggle_display' )->transport = 'postMessage';
  $wp_customize->get_setting( 'hero_image_description' )->transport = 'postMessage';
  $wp_customize->get_setting( 'hero_image_heading' )->transport = 'postMessage';

  // Section one settings.
  $wp_customize->get_setting( 'section_one_toggle_display' )->transport = 'postMessage';
  $wp_customize->get_setting( 'section_one_card_heading' )->transport = 'postMessage';
  $wp_customize->get_setting( 'section_one_card_text' )->transport = 'postMessage';
  $wp_customize->get_setting( 'section_one_right_column_text' )->transport = 'postMessage';

  // Section two settings.
  $wp_customize->get_setting( 'section_two_toggle_display' )->transport = 'postMessage';
  $wp_customize->get_setting( 'section_two_right_column_text' )->transport = 'postMessage';
  $wp_customize->get_setting( 'section_two_image_caption' )->transport = 'postMessage';

  // Advanced settings.
  $wp_customize->get_setting( 'frontpage_advanced_content' )->transport = 'postMessage';

  // Header settings.
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

}

add_action( 'customize_preview_init', 'mars_customizer' );
/**
 * Include customizer.js to be used during theme customization.
 *
 */
function mars_customizer() {
  wp_enqueue_script(
      'mars_customizer',
      get_template_directory_uri() . '/inc/customizer.js',
      array( 'jquery','customize-preview' ),
      '',
      true
  );
}
