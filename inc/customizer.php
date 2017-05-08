<?php
/**
 * w3css-enfrte-blog Theme Customizer
 *
 * @package w3css-enfrte-blog
 */

/**
* Create theme's custom settings
*/
function a_simple_blog_theme_customizer_settings($wp_customize) {
	/*
		Tutorial:
		Calling 'customize_register' action automatically loads the $wp_customize
		object, which is an instance of the WP_Customize_Manager class. This is
		passed automatically to the function, and all customizations you make to
		the Theme Customization page are performed through methods of the
		$wp_customize object.
	*/

	/*
		Add a section.
		Sections are groups of options. When you define new controls, they must be
		added to a section.
		Note: If you are using a predefined wp customisation section like "Site settings",
		you don't need to define a new section. Simplely link it to your control.
	*/
	$wp_customize->add_section( 'a_simple_blog_customizer_section' , array(
	    'title'      => __( 'Theme\'s settings', 'a-simple-blog' ),
	    'priority'   => 1,
			'description' => __('Theme specific settings.', 'a-simple-blog')
	) );
	/* Add a setting
		You need to define your settings, then your sections, then your controls
		(controls need a section and a setting to function).
		Using the $wp_customize->add_setting() method allows you to create,
		save, or fetch settings for your theme.
	*/
	$wp_customize->add_setting('a_simple_blog_logo'); // setup create, save, fetch settings
	$wp_customize->add_setting('a_simple_blog_show_hide_categories_tags', array('default' => 0));
	/*
		A control is an HTML form element that renders on the Theme Customizer
		page, and allows admins to change a setting, and preview those changes
		in real time. Controls are linked to a single setting, and a single section.
	*/
	// html form to grab an image from the media library
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'a_simple_blog_logo',
			array(
				'label' => __('Upload site logo', 'a-simple-blog'),
				'section' => 'a_simple_blog_customizer_section',
				'settings' => 'a_simple_blog_logo', // setting id - defined in add setting
	) ) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'a_simple_blog_show_hide_categories_tags',
			array(
				'label'          => __( 'Hide category and tag info in post content.', 'a-simple-blog' ),
				'section'        => 'a_simple_blog_customizer_section',
				'settings'       => 'a_simple_blog_show_hide_categories_tags',
				'type'           => 'checkbox',
		)	)	);

}
add_action('customize_register', 'a_simple_blog_theme_customizer_settings');

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function a_simple_blog_customize_register( $wp_customize ) {
	/*
	 Note: transport arg defines how the customiser window refreshes after a
	 change/edit. 'refresh' (the default) refreshes the whole page. postMessage
	 uses /js/customizer.js to refresh just the part that was edited (async).
 	*/
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	//$wp_customize->get_setting( 'a_simple_blog_logo' )->transport = 'postMessage';
}
add_action( 'customize_register', 'a_simple_blog_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function a_simple_blog_customize_preview_js() {
	wp_enqueue_script( 'a_simple_blog_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'a_simple_blog_customize_preview_js' );
