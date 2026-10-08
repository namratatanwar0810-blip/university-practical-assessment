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
		time(),
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
                'thumbnail',
                'custom-fields',
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



/* =========================================================
 * Register Programs CPT
 * ========================================================= */

function university_register_programs_cpt() {

    $labels = array(
        'name'               => 'Programs',
        'singular_name'      => 'Program',
        'menu_name'          => 'Programs',
        'name_admin_bar'     => 'Program',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Program',
        'edit_item'          => 'Edit Program',
        'new_item'           => 'New Program',
        'view_item'          => 'View Program',
        'all_items'          => 'All Programs',
        'search_items'       => 'Search Programs',
        'not_found'          => 'No Programs Found',
        'not_found_in_trash' => 'No Programs Found in Trash',
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'show_ui'      => true,
        'show_in_menu' => true,
        'show_in_rest' => true,

        'menu_icon' => 'dashicons-welcome-learn-more',

        /*
         * custom-fields is IMPORTANT because our registered
         * program meta is saved through the WordPress REST API.
         */
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
        ),

        'has_archive' => 'programmes',

        'rewrite' => array(
            'slug'       => 'programmes',
            'with_front' => false,
        ),
    );

    register_post_type( 'program', $args );
}

add_action( 'init', 'university_register_programs_cpt' );


/* =========================================================
 * Safety: Ensure Program supports custom-fields
 * ========================================================= */

function university_program_custom_fields_support() {

    add_post_type_support(
        'program',
        'custom-fields'
    );
}

add_action(
    'init',
    'university_program_custom_fields_support',
    20
);


/* =========================================================
 * Register Program Type Taxonomy
 * ========================================================= */

function university_register_program_type_taxonomy() {

    $labels = array(
        'name'              => 'Program Types',
        'singular_name'     => 'Program Type',
        'menu_name'         => 'Program Types',
        'all_items'         => 'All Program Types',
        'edit_item'         => 'Edit Program Type',
        'view_item'         => 'View Program Type',
        'update_item'       => 'Update Program Type',
        'add_new_item'      => 'Add New Program Type',
        'new_item_name'     => 'New Program Type Name',
        'search_items'      => 'Search Program Types',
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,

        'hierarchical' => true,

        'rewrite' => array(
            'slug'       => 'program-type',
            'with_front' => false,
        ),
    );

    register_taxonomy(
        'program-type',
        array( 'program' ),
        $args
    );
}

add_action(
    'init',
    'university_register_program_type_taxonomy'
);


/* =========================================================
 * Register Program Meta
 * ========================================================= */

function university_register_program_meta() {

    /*
     * -----------------------------------------------------
     * Academic Year
     * -----------------------------------------------------
     */

    register_post_meta(
        'program',
        'academic_year',
        array(
            'type'              => 'string',
            'single'            => true,
            'default'           => '',
            'show_in_rest'      => true,
            'sanitize_callback' => 'sanitize_text_field',

            'auth_callback' => function(
                $allowed,
                $meta_key,
                $post_id
            ) {

                if ( $post_id ) {
                    return current_user_can(
                        'edit_post',
                        $post_id
                    );
                }

                return current_user_can(
                    'edit_posts'
                );
            },
        )
    );


    /*
     * -----------------------------------------------------
     * Duration
     * -----------------------------------------------------
     */

    register_post_meta(
        'program',
        'duration',
        array(
            'type'              => 'string',
            'single'            => true,
            'default'           => '',
            'show_in_rest'      => true,
            'sanitize_callback' => 'sanitize_text_field',

            'auth_callback' => function(
                $allowed,
                $meta_key,
                $post_id
            ) {

                if ( $post_id ) {
                    return current_user_can(
                        'edit_post',
                        $post_id
                    );
                }

                return current_user_can(
                    'edit_posts'
                );
            },
        )
    );


    /*
     * -----------------------------------------------------
     * Content Sections
     *
     * Each section contains:
     * - title
     * - description
     * - optional image URL
     * -----------------------------------------------------
     */

    register_post_meta(
        'program',
        'content_sections',
        array(
            'type'   => 'array',
            'single' => true,

            'show_in_rest' => array(
                'schema' => array(
                    'type'  => 'array',

                    'items' => array(
                        'type'       => 'object',

                        'properties' => array(

                            'title' => array(
                                'type' => 'string',
                            ),

                            'description' => array(
                                'type' => 'string',
                            ),

                            'image' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
            ),

            /*
             * Sanitize the repeater before saving.
             */
            'sanitize_callback' => function( $value ) {

                if ( ! is_array( $value ) ) {
                    return array();
                }

                $clean_sections = array();

                foreach ( $value as $section ) {

                    if ( ! is_array( $section ) ) {
                        continue;
                    }

                    $clean_sections[] = array(

                        'title' => isset(
                            $section['title']
                        )
                            ? sanitize_text_field(
                                $section['title']
                            )
                            : '',

                        'description' => isset(
                            $section['description']
                        )
                            ? wp_kses_post(
                                $section['description']
                            )
                            : '',

                        'image' => isset(
                            $section['image']
                        )
                            ? esc_url_raw(
                                $section['image']
                            )
                            : '',
                    );
                }

                return $clean_sections;
            },

            /*
             * Capability check.
             */
            'auth_callback' => function(
                $allowed,
                $meta_key,
                $post_id
            ) {

                if ( $post_id ) {

                    return current_user_can(
                        'edit_post',
                        $post_id
                    );
                }

                return current_user_can(
                    'edit_posts'
                );
            },
        )
    );
}

add_action(
    'init',
    'university_register_program_meta'
);


/* =========================================================
 * Program React Admin Panel
 * ========================================================= */


/*
 * Add React container to Program editor.
 */

function university_program_admin_metabox() {

    add_meta_box(
        'university-program-admin',
        'Program Information',
        'university_render_program_admin',
        'program',
        'normal',
        'high'
    );
}

add_action(
    'add_meta_boxes_program',
    'university_program_admin_metabox'
);


/*
 * Render React application container.
 */

function university_render_program_admin() {

    echo '<div id="university-program-admin"></div>';
}


/*
 * Enqueue React admin assets.
 */

function university_enqueue_program_admin_assets( $hook ) {

    /*
     * Only load on post edit/add screens.
     */

    if (
        ! in_array(
            $hook,
            array(
                'post.php',
                'post-new.php',
            ),
            true
        )
    ) {
        return;
    }


    /*
     * Check current post type.
     */

    $screen = get_current_screen();

    if (
        ! $screen ||
        'program' !== $screen->post_type
    ) {
        return;
    }


    /*
     * Build paths.
     */

    $build_dir = get_template_directory() . '/build/';
    $build_uri = get_template_directory_uri() . '/build/';


    /*
     * JavaScript asset information generated by wp-scripts.
     */

    $asset_file =
        $build_dir . 'program-admin.asset.php';


    if ( ! file_exists( $asset_file ) ) {
        return;
    }


    $asset = include $asset_file;


    $dependencies = isset(
        $asset['dependencies']
    )
        ? $asset['dependencies']
        : array();


    $version = isset(
        $asset['version']
    )
        ? $asset['version']
        : filemtime(
            $build_dir . 'program-admin.js'
        );


    /*
     * React JavaScript.
     */

    wp_enqueue_script(
        'university-program-admin',
        $build_uri . 'program-admin.js',
        $dependencies,
        $version,
        true
    );


    /*
     * Generated React CSS.
     */

    $css_file =
        $build_dir . 'program-admin.css';


    if ( file_exists( $css_file ) ) {

        wp_enqueue_style(
            'university-program-admin',
            $build_uri . 'program-admin.css',
            array(),
            filemtime( $css_file )
        );
    }
}

add_action(
    'admin_enqueue_scripts',
    'university_enqueue_program_admin_assets'
);

/**
 * Enqueue Programs Interactivity script.
 */

/* =========================================================
 * Flush Program Rewrite Rules When Theme Is Activated
 * ========================================================= */

function university_flush_program_rewrites() {

    /*
     * Register CPT and taxonomy first.
     */

    university_register_programs_cpt();
    university_register_program_type_taxonomy();

    /*
     * Flush rewrite rules.
     */

    flush_rewrite_rules();
}

add_action(
    'after_switch_theme',
    'university_flush_program_rewrites'
);

/**
 * Program frontend routing.
 */
function university_program_custom_rewrites() {

    add_rewrite_rule(
        '^programmes/undergraduate/?$',
        'index.php?program-type=undergraduate',
        'top'
    );

    add_rewrite_rule(
        '^programmes/postgraduate/?$',
        'index.php?program-type=postgraduate',
        'top'
    );
}
add_action( 'init', 'university_program_custom_rewrites' );

function university_enqueue_program_interactivity() {

    if ( ! is_post_type_archive( 'program' ) ) {
        return;
    }

    $build_dir = get_template_directory() . '/build/';
    $build_uri = get_template_directory_uri() . '/build/';
    $asset_file = $build_dir . 'programs-interactivity.asset.php';

    if ( ! file_exists( $asset_file ) ) {
        return;
    }

    $asset = include $asset_file;

    wp_enqueue_script(
        'university-programs-interactivity',
        $build_uri . 'programs-interactivity.js',
        isset( $asset['dependencies'] ) ? $asset['dependencies'] : array(),
        isset( $asset['version'] )
            ? $asset['version']
            : filemtime( $build_dir . 'programs-interactivity.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'university_enqueue_program_interactivity' );


/**
 * Program click tracking helper.
 */
function program_track_attr( $event, $label, $section, $component ) {

    $tracking_data = array(
        'type'         => 'click',
        'event'        => sanitize_key( $event ),
        'content_data' => array(
            'sectionName' => sanitize_text_field( $section ),
            'uiComponent' => sanitize_text_field( $component ),
        ),
    );

    if ( 'button' === $event ) {

        $tracking_data['button'] = array(
            'label' => sanitize_key( $label ),
        );

    } else {

        $tracking_data['link'] = array(
            'label' => sanitize_key( $label ),
        );
    }

    return 'data-track="' . esc_attr(
        wp_json_encode( $tracking_data )
    ) . '"';
}


/**
 * Register program tracking REST API.
 */
function university_register_program_tracking_route() {

    register_rest_route(
        'programs/v1',
        '/track',
        array(
            'methods'             => WP_REST_Server::CREATABLE,
            'callback'            => 'university_handle_program_tracking',
            'permission_callback' => '__return_true',
        )
    );
}
add_action(
    'rest_api_init',
    'university_register_program_tracking_route'
);


/**
 * Handle program tracking event.
 */
function university_handle_program_tracking( WP_REST_Request $request ) {

    $body = $request->get_body();

    // Reject oversized requests.
    if ( strlen( $body ) > 10000 ) {

        return new WP_Error(
            'tracking_payload_too_large',
            'Tracking payload is too large.',
            array(
                'status' => 413,
            )
        );
    }

    $payload = $request->get_json_params();

    if ( ! is_array( $payload ) ) {

        return new WP_Error(
            'invalid_tracking_payload',
            'Invalid tracking payload.',
            array(
                'status' => 400,
            )
        );
    }

    // Validate type.
    if (
        ! isset( $payload['type'] ) ||
        'click' !== $payload['type']
    ) {

        return new WP_Error(
            'invalid_tracking_type',
            'Invalid tracking type.',
            array(
                'status' => 400,
            )
        );
    }

    // Validate event.
    if (
        ! isset( $payload['event'] ) ||
        ! in_array(
            $payload['event'],
            array( 'link', 'button' ),
            true
        )
    ) {

        return new WP_Error(
            'invalid_tracking_event',
            'Invalid tracking event.',
            array(
                'status' => 400,
            )
        );
    }

    // Get label from link or button.
    $label = '';

    if ( 'link' === $payload['event'] ) {

        if (
            empty( $payload['link'] ) ||
            empty( $payload['link']['label'] )
        ) {

            return new WP_Error(
                'missing_tracking_label',
                'Tracking label is required.',
                array(
                    'status' => 400,
                )
            );
        }

        $label = sanitize_key(
            $payload['link']['label']
        );

    } else {

        if (
            empty( $payload['button'] ) ||
            empty( $payload['button']['label'] )
        ) {

            return new WP_Error(
                'missing_tracking_label',
                'Tracking label is required.',
                array(
                    'status' => 400,
                )
            );
        }

        $label = sanitize_key(
            $payload['button']['label']
        );
    }

    // Validate content data.
    if (
        empty( $payload['content_data'] ) ||
        ! is_array( $payload['content_data'] )
    ) {

        return new WP_Error(
            'invalid_content_data',
            'Content data is required.',
            array(
                'status' => 400,
            )
        );
    }

    $section_name = isset(
        $payload['content_data']['sectionName']
    )
        ? sanitize_text_field(
            $payload['content_data']['sectionName']
        )
        : '';

    $ui_component = isset(
        $payload['content_data']['uiComponent']
    )
        ? sanitize_text_field(
            $payload['content_data']['uiComponent']
        )
        : '';

    if ( ! $section_name || ! $ui_component || ! $label ) {

        return new WP_Error(
            'invalid_tracking_data',
            'Invalid tracking data.',
            array(
                'status' => 400,
            )
        );
    }

    // Keep only approved fields.
    $clean_payload = array(
        'type' => 'click',
        'event' => $payload['event'],
        'content_data' => array(
            'sectionName' => $section_name,
            'uiComponent' => $ui_component,
        ),
    );

    if ( 'link' === $payload['event'] ) {

        $clean_payload['link'] = array(
            'label' => $label,
        );

    } else {

        $clean_payload['button'] = array(
            'label' => $label,
        );
    }

    // Get uploads directory.
    $uploads = wp_upload_dir();

    $log_dir  = trailingslashit( $uploads['basedir'] ) . 'logs';
    $log_file = trailingslashit( $log_dir ) . 'data-track.log';

    // Create directory if needed.
    if ( ! file_exists( $log_dir ) ) {

        wp_mkdir_p( $log_dir );
    }

    // Protect directory listing.
    $index_file = trailingslashit( $log_dir ) . 'index.php';

    if ( ! file_exists( $index_file ) ) {

        file_put_contents(
            $index_file,
            "<?php\n// Silence is golden.\n"
        );
    }

    // Try to block direct access on Apache.
    $htaccess_file = trailingslashit( $log_dir ) . '.htaccess';

    if ( ! file_exists( $htaccess_file ) ) {

        file_put_contents(
            $htaccess_file,
            "Deny from all\n"
        );
    }

    // Get only the URL path, not sensitive query data.
    $referer = wp_get_raw_referer();

    $page_url = '';

    if ( $referer ) {

        $parsed_url = wp_parse_url( $referer );

        if ( ! empty( $parsed_url['path'] ) ) {

            $page_url = sanitize_text_field(
                $parsed_url['path']
            );
        }
    }

    // Final log entry.
    $log_entry = array(
        'timestamp' => current_time(
            'c',
            true
        ),
        'page_url'  => $page_url,
        'payload'   => $clean_payload,
    );

    $written = file_put_contents(
        $log_file,
        wp_json_encode( $log_entry ) . PHP_EOL,
        FILE_APPEND | LOCK_EX
    );

    if ( false === $written ) {

        return new WP_Error(
            'tracking_log_failed',
            'Could not write tracking log.',
            array(
                'status' => 500,
            )
        );
    }

    return new WP_REST_Response(
        array(
            'success' => true,
        ),
        200
    );
}

/**
 * Program Click Tracking API
 */
function university_register_program_tracking_api() {

    register_rest_route(
        'university/v1',
        '/track-click',
        array(
            'methods'             => 'POST',
            'callback'            => 'university_track_program_click',
            'permission_callback' => '__return_true',
        )
    );

}

add_action(
    'rest_api_init',
    'university_register_program_tracking_api'
);


/**
 * Save Program Click
 */
function university_track_program_click( WP_REST_Request $request ) {

    $data = $request->get_json_params();

    $event = isset( $data['event'] )
        ? sanitize_text_field( $data['event'] )
        : '';

    $program_id = isset( $data['program_id'] )
        ? absint( $data['program_id'] )
        : 0;

    $program_title = isset( $data['program_title'] )
        ? sanitize_text_field( $data['program_title'] )
        : '';

    $log_dir  = WP_CONTENT_DIR . '/uploads/logs/';
    $log_file = $log_dir . 'data-track.log';

    if ( ! file_exists( $log_dir ) ) {
        wp_mkdir_p( $log_dir );
    }

    $log_data = array(
        'time'          => current_time( 'mysql' ),
        'event'         => $event,
        'program_id'    => $program_id,
        'program_title' => $program_title,
        'url'           => isset( $data['url'] )
            ? esc_url_raw( $data['url'] )
            : '',
    );

    file_put_contents(
        $log_file,
        wp_json_encode( $log_data ) . PHP_EOL,
        FILE_APPEND | LOCK_EX
    );

    return new WP_REST_Response(
        array(
            'success' => true,
            'message' => 'Click tracked successfully.',
        ),
        200
    );
}
function university_enqueue_programs_interactivity() {

    if ( ! is_post_type_archive( 'program' ) ) {
        return;
    }

    $build_dir = get_template_directory() . '/build/';
    $build_uri = get_template_directory_uri() . '/build/';

    $asset_file = $build_dir . 'programs-interactivity.asset.php';

    if ( ! file_exists( $asset_file ) ) {
        return;
    }

    $asset = include $asset_file;

    $version = isset( $asset['version'] )
        ? $asset['version']
        : filemtime( $build_dir . 'programs-interactivity.js' );

    $dependencies = isset( $asset['dependencies'] )
        ? $asset['dependencies']
        : array();

    wp_enqueue_script_module(
        'university-programs-interactivity',
        $build_uri . 'programs-interactivity.js',
        $dependencies,
        $version
    );
}

add_action(
    'wp_enqueue_scripts',
    'university_enqueue_programs_interactivity'
);
