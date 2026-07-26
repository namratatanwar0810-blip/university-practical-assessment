<?php
/**
 * Plugin Name: University Utilities
 * Description: University Utility Shortcodes.
 * Version: 1.0
 * Author: Namrata
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * University Year Shortcode
 */

function university_year_shortcode() {

    return '© University of Aberdeen';

}

add_shortcode( 'university_year', 'university_year_shortcode' );