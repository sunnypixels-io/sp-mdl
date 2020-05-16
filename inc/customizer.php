<?php
/**
 * Material Design Lite Theme Customizer
 *
 * @package SP_MDL
 */


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sp_mdl_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	/**
     * Note:
     * removing Core settings not allowed :/
     * but if you are dev you can uncomment it for make it looks customizer good for this theme :)
     */
    // $wp_customize->remove_section('colors');
    // $wp_customize->remove_section('background_image');
    // $wp_customize->remove_section('header_image');

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'sp_mdl_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'sp_mdl_customize_partial_blogdescription',
		) );
	}
}

add_action( 'customize_register', 'sp_mdl_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sp_mdl_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sp_mdl_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sp_mdl_customize_preview_js() {
	wp_enqueue_script( 'material-design-lite-customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'sp_mdl_customize_preview_js' );

/**
 * Add CSS for custom controls.
 * Enqueue the stylesheet.
 *
 * @link https://aristath.github.io/blog/modifying-wordpress-customizer
 */
function sp_mdl_customizer_stylesheet()
{
    wp_register_style( 'material-design-lite-customizer', get_template_directory_uri() . '/assets/css/customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'material-design-lite-customizer' );
}

add_action( 'customize_controls_print_styles', 'sp_mdl_customizer_stylesheet' );
