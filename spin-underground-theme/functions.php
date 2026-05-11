<?php
/**
 * Spin Underground Theme functions and definitions
 */

if ( ! function_exists( 'spinunderground_setup' ) ) :
	function spinunderground_setup() {
		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Enable support for custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'spinunderground_setup' );

/**
 * Enqueue scripts and styles.
 */
function spinunderground_scripts() {
	// Google Fonts
	wp_enqueue_style( 'spinunderground-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap', array(), null );
	
	// Bootstrap Icons
	wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3' );

	// Theme stylesheet
	wp_enqueue_style( 'spinunderground-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    // Main JS (we will enqueue it inline for now, or you can extract it)
}
add_action( 'wp_enqueue_scripts', 'spinunderground_scripts' );

/**
 * Custom Post Types, Taxonomies, and ACF fields
 */
require get_template_directory() . '/inc/artists-setup.php';
require get_template_directory() . '/inc/front-page-setup.php';

/**
 * Customizer settings
 */
require get_template_directory() . '/inc/customizer.php';
