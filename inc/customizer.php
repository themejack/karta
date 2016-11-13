<?php
/**
 * Karta Theme Customizer
 *
 * @package Karta
 */

/**
 * Support customize of footer copyright
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function karta_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Site copyright.
	$wp_customize->add_setting( 'karta_sitecopyright', array(
		'sanitize_callback'    => 'sanitize_text_field',
		'type'                 => 'theme_mod',
		'default'              => __( 'Copyright', 'karta' ) . ' &copy; ' . get_bloginfo( 'name' ),
		'transport'            => 'postMessage',
	) );

	$wp_customize->add_control( 'karta_sitecopyright', array(
		'label'    => __( 'Copyright', 'karta' ),
		'section'  => 'title_tagline',
		'settings' => 'karta_sitecopyright',
		'type'     => 'text',
	) );
}
add_action( 'customize_register', 'karta_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function karta_customize_preview_js() {
	wp_enqueue_script( 'karta_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160515', true );
}
add_action( 'customize_preview_init', 'karta_customize_preview_js' );
