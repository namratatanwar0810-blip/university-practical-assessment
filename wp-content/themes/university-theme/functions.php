<?php
/**
 * Theme Functions
 *
 * @package University_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Setup
 */
function university_theme_setup() {

	//  document title.
	add_theme_support( 'title-tag' );

	//  featured images.
	add_theme_support( 'post-thumbnails' );

	//  custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 250,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// HTML5 markup.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// navigation menu.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'university-theme' ),
		)
	);

}
add_action( 'after_setup_theme', 'university_theme_setup' );

/**
 * Enqueue Styles & Scripts
 */
function university_enqueue() {

	wp_enqueue_style(
		'university-style',
		get_template_directory_uri() . '/assets/css/style.css',
		array(),
		filemtime( get_template_directory() . '/assets/css/style.css' )
	);

	wp_enqueue_script(
		'university-script',
		get_template_directory_uri() . '/assets/js/script.js',
		array(),
		filemtime( get_template_directory() . '/assets/js/script.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'university_enqueue' );