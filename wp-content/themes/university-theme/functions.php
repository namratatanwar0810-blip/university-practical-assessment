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

 // Google Font
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&display=swap',
        array(),
        null
    );

	wp_enqueue_style(
		'university-style',
		get_template_directory_uri() . '/assets/css/style.css',
		array(),
		filemtime( get_template_directory() . '/assets/css/style.css' )
	);

  wp_enqueue_style(
    'responsive-style',
    get_template_directory_uri() . '/assets/css/responsive.css',
    array(),
    filemtime(get_template_directory() . '/assets/css/responsive.css')
);

	wp_enqueue_script(
		'university-script',
		get_template_directory_uri() . '/assets/js/script.js',
		array(),
		filemtime( get_template_directory() . '/assets/js/script.js' ),
		true
	);
	
	// Swiper CSS
wp_enqueue_style(
    'swiper-css',
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
    array(),
    '11.2.10'
);

// Swiper JS
wp_enqueue_script(
    'swiper-js',
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
    array(),
    '11.2.10',
    true
);

}
add_action( 'wp_enqueue_scripts', 'university_enqueue' );

/*=========================================
 Register Courses CPT
=========================================*/

function university_register_courses_cpt() {

    $labels = array(
        'name'               => 'Courses',
        'singular_name'      => 'Course',
        'menu_name'          => 'Courses',
        'name_admin_bar'     => 'Course',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Course',
        'edit_item'          => 'Edit Course',
        'new_item'           => 'New Course',
        'view_item'          => 'View Course',
        'all_items'          => 'All Courses',
        'search_items'       => 'Search Courses',
        'not_found'          => 'No Courses Found',
        'not_found_in_trash' => 'No Courses Found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
		'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ),
        'has_archive'        => true,
        'rewrite'            => array(
            'slug' => 'courses'
        ),
        'show_in_rest'       => true,
    );

    register_post_type('courses', $args);

}

add_action('init', 'university_register_courses_cpt');


/* Register Course Categories Taxonomy */

function university_register_course_categories() {

    $labels = array(
        'name'              => 'Course Categories',
        'singular_name'     => 'Course Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Course Categories',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array(
            'slug' => 'course-category'
        ),
    );

    register_taxonomy(
        'course_category',
        'courses',
        $args
    );

}

add_action('init', 'university_register_course_categories');

/* Register Course Information Meta Box */

function university_add_course_meta_box() {

    add_meta_box(
        'course_information',
        'Course Information',
        'university_course_meta_box_callback',
        'courses',
        'normal',
        'high'
    );

}

add_action('add_meta_boxes', 'university_add_course_meta_box');

function university_course_meta_box_callback($post) {

    wp_nonce_field(
        'save_course_information',
        'course_information_nonce'
    );

    ?>

    <table class="form-table">

        <tr>

            <th>
                <label for="course_duration">Course Duration</label>
            </th>

            <td>
                <input
                    type="text"
                    id="course_duration"
                    name="course_duration"
                    value="<?php echo esc_attr(get_post_meta($post->ID,'course_duration',true)); ?>"
                    class="regular-text">
            </td>

        </tr>

        <tr>

            <th>
                <label for="course_fee">Course Fee</label>
            </th>

            <td>
                <input
                    type="number"
                    id="course_fee"
                    name="course_fee"
                    value="<?php echo esc_attr(get_post_meta($post->ID,'course_fee',true)); ?>"
                    class="regular-text">
            </td>

        </tr>

        <tr>

            <th>
                <label for="course_level">Course Level</label>
            </th>

            <td>

                <select
                    id="course_level"
                    name="course_level">

                    <option value="">Select</option>

                    <option value="Beginner"
                        <?php selected(get_post_meta($post->ID,'course_level',true),'Beginner'); ?>>
                        Beginner
                    </option>

                    <option value="Intermediate"
                        <?php selected(get_post_meta($post->ID,'course_level',true),'Intermediate'); ?>>
                        Intermediate
                    </option>

                    <option value="Advanced"
                        <?php selected(get_post_meta($post->ID,'course_level',true),'Advanced'); ?>>
                        Advanced
                    </option>

                </select>

            </td>

        </tr>

        <tr>

            <th>
                <label for="admission_deadline">
                    Admission Deadline
                </label>
            </th>

            <td>

                <input
                    type="date"
                    id="admission_deadline"
                    name="admission_deadline"
                    value="<?php echo esc_attr(get_post_meta($post->ID,'admission_deadline',true)); ?>">

            </td>

        </tr>

        <tr>

            <th>

                <label for="featured_course">
                    Featured Course
                </label>

            </th>

            <td>

                <input
                    type="checkbox"
                    id="featured_course"
                    name="featured_course"
                    value="1"
                    <?php checked(get_post_meta($post->ID,'featured_course',true),1); ?>>

            </td>

        </tr>

    </table>

    <?php
}

/* Save Course Meta Box */

function university_save_course_meta($post_id) {

    // Nonce Check
    if (
        ! isset($_POST['course_information_nonce']) ||
        ! wp_verify_nonce($_POST['course_information_nonce'], 'save_course_information')
    ) {
        return;
    }

    // Autosave Check
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Permission Check
    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save Course Duration
    if (isset($_POST['course_duration'])) {
        update_post_meta(
            $post_id,
            'course_duration',
            sanitize_text_field($_POST['course_duration'])
        );
    }

    // Save Course Fee
    if (isset($_POST['course_fee'])) {
        update_post_meta(
            $post_id,
            'course_fee',
            sanitize_text_field($_POST['course_fee'])
        );
    }

    // Save Course Level
    if (isset($_POST['course_level'])) {
        update_post_meta(
            $post_id,
            'course_level',
            sanitize_text_field($_POST['course_level'])
        );
    }

    // Save Admission Deadline
    if (isset($_POST['admission_deadline'])) {
        update_post_meta(
            $post_id,
            'admission_deadline',
            sanitize_text_field($_POST['admission_deadline'])
        );
    }

    // Save Featured Course
    update_post_meta(
        $post_id,
        'featured_course',
        isset($_POST['featured_course']) ? 1 : 0
    );

}

add_action('save_post_courses', 'university_save_course_meta');