<?php
/**
 * Single Program Template
 */

get_header();

while ( have_posts() ) :

    the_post();

    $program_id = get_the_ID();

    $academic_year = get_post_meta(
        $program_id,
        'academic_year',
        true
    );

    $duration = get_post_meta(
        $program_id,
        'duration',
        true
    );

    $content_sections = get_post_meta(
        $program_id,
        'content_sections',
        true
    );

    $program_types = get_the_terms(
        $program_id,
        'program-type'
    );

    ?>

    <main id="primary" class="site-main program-single">

        <div class="container">

            <!-- Breadcrumb / Back Link -->
            <div class="program-breadcrumb">

                <a href="<?php echo esc_url( get_post_type_archive_link( 'program' ) ); ?>">
                    ← Back to Programmes
                </a>

            </div>


            <!-- Program Header -->
            <header class="program-single-header">

                <div class="program-single-image">

                    <?php if ( has_post_thumbnail() ) : ?>

                        <?php
                        the_post_thumbnail(
                            'large',
                            array(
                                'alt' => get_the_title(),
                            )
                        );
                        ?>

                    <?php endif; ?>

                </div>


                <div class="program-single-intro">

                    <h1>
                        <?php the_title(); ?>
                    </h1>


                    <?php if ( ! empty( $program_types ) && ! is_wp_error( $program_types ) ) : ?>

                        <p class="program-type">

                            <strong>Program Type:</strong>

                            <?php
                            $term = $program_types[0];
                            ?>

                            <a
                                href="<?php echo esc_url( get_term_link( $term ) ); ?>"
                            >
                                <?php echo esc_html( $term->name ); ?>
                            </a>

                        </p>

                    <?php endif; ?>


                    <?php if ( $academic_year ) : ?>

                        <p>
                            <strong>Academic Year:</strong>
                            <?php echo esc_html( $academic_year ); ?>
                        </p>

                    <?php endif; ?>


                    <?php if ( $duration ) : ?>

                        <p>
                            <strong>Duration:</strong>
                            <?php echo esc_html( $duration ); ?>
                        </p>

                    <?php endif; ?>


                    <div class="program-single-actions">

                        <button
                            type="button"
                            class="program-apply-button"
                            id="program-apply-button"
                        >
                            Apply Now
                        </button>

                        <button
                            type="button"
                            class="program-enquire-button"
                            id="program-enquire-button"
                        >
                            Enquire Now
                        </button>

                    </div>

                </div>

            </header>


            <!-- Repeater Content Sections -->

            <?php if ( is_array( $content_sections ) && ! empty( $content_sections ) ) : ?>

                <section class="program-content-sections">

                    <?php foreach ( $content_sections as $section ) : ?>

                        <article class="program-content-section">

                            <div class="program-content-section-text">

                                <?php if ( ! empty( $section['title'] ) ) : ?>

                                    <h2>
                                        <?php
                                        echo esc_html(
                                            $section['title']
                                        );
                                        ?>
                                    </h2>

                                <?php endif; ?>


                                <?php if ( ! empty( $section['description'] ) ) : ?>

                                    <div class="program-section-description">

                                        <?php
                                        echo wp_kses_post(
                                            wpautop(
                                                $section['description']
                                            )
                                        );
                                        ?>

                                    </div>

                                <?php endif; ?>

                            </div>


                            <?php if ( ! empty( $section['image'] ) ) : ?>

                                <div class="program-content-section-image">

                                    <img
                                        src="<?php echo esc_url( $section['image'] ); ?>"
                                        alt="<?php echo esc_attr( $section['title'] ?? get_the_title() ); ?>"
                                    >

                                </div>

                            <?php endif; ?>

                        </article>

                    <?php endforeach; ?>

                </section>

            <?php endif; ?>


            <!-- Enquiry Popup -->

            <section
                class="program-enquiry-popup"
                id="program-enquiry-popup"
                hidden
                aria-hidden="true"
            >

                <div
                    class="program-enquiry-overlay"
                    id="program-enquiry-overlay"
                ></div>


                <div
                    class="program-enquiry-modal"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="program-enquiry-title"
                >

                    <!-- Close Button -->

                    <button
                        type="button"
                        class="program-enquiry-close"
                        id="program-enquiry-close"
                        aria-label="Close enquiry form"
                    >
                        &times;
                    </button>


                    <!-- Form Wrapper -->

                    <div
                        id="program-enquiry-form-wrapper"
                        class="program-enquiry-form-wrapper"
                    >

                        <h2 id="program-enquiry-title">
                            Register your interest
                        </h2>


                        <form
                            class="program-enquiry-form"
                            id="program-enquiry-form"
                        >

                            <!-- I am enquiring as -->

                            <div class="form-field full-width">

                                <label for="enquiring-as">
                                    I am enquiring as <span>*</span>
                                </label>

                                <select
                                    id="enquiring-as"
                                    name="enquiring_as"
                                    required
                                >

                                    <option value="">
                                        Select an option
                                    </option>

                                    <option value="student">
                                        Student
                                    </option>

                                    <option value="parent">
                                        Parent
                                    </option>

                                    <option value="guardian">
                                        Guardian
                                    </option>

                                    <option value="agent">
                                        Agent
                                    </option>

                                    <option value="other">
                                        Other
                                    </option>

                                </select>

                            </div>


                            <!-- Level / Programme -->

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="level-of-interest">
                                        Level of interest <span>*</span>
                                    </label>

                                    <select
                                        id="level-of-interest"
                                        name="level_of_interest"
                                        required
                                    >

                                        <option value="">
                                            Select an option
                                        </option>

                                        <option value="undergraduate">
                                            Undergraduate
                                        </option>

                                        <option value="postgraduate">
                                            Postgraduate
                                        </option>

                                    </select>

                                </div>


                                <div class="form-field">

                                    <label for="programme-of-interest">
                                        Programme of interest <span>*</span>
                                    </label>

                                    <select
                                        id="programme-of-interest"
                                        name="programme_of_interest"
                                        required
                                    >

                                        <option value="">
                                            Select an option
                                        </option>

                                        <?php

                                        $programs = new WP_Query(
                                            array(
                                                'post_type'      => 'program',
                                                'posts_per_page' => -1,
                                                'post_status'    => 'publish',
                                                'orderby'        => 'title',
                                                'order'          => 'ASC',
                                            )
                                        );

                                        if ( $programs->have_posts() ) :

                                            while ( $programs->have_posts() ) :

                                                $programs->the_post();

                                                ?>

                                                <option
                                                    value="<?php echo esc_attr( get_the_ID() ); ?>"
                                                    <?php selected( get_the_ID(), $program_id ); ?>
                                                >
                                                    <?php the_title(); ?>
                                                </option>

                                                <?php

                                            endwhile;

                                            wp_reset_postdata();

                                        endif;

                                        ?>

                                    </select>

                                </div>

                            </div>


                            <!-- First / Last Name -->

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="first-name">
                                        First name <span>*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="first-name"
                                        name="first_name"
                                        required
                                    >

                                </div>


                                <div class="form-field">

                                    <label for="last-name">
                                        Last name <span>*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="last-name"
                                        name="last_name"
                                        required
                                    >

                                </div>

                            </div>


                            <!-- Country / City -->

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="country">
                                        Country <span>*</span>
                                    </label>

                                    <select
                                        id="country"
                                        name="country"
                                        required
                                    >

                                        <option value="">
                                            Select an option
                                        </option>

                                        <option value="india">
                                            India
                                        </option>

                                        <option value="united-kingdom">
                                            United Kingdom
                                        </option>

                                        <option value="united-states">
                                            United States
                                        </option>

                                        <option value="canada">
                                            Canada
                                        </option>

                                        <option value="australia">
                                            Australia
                                        </option>

                                        <option value="other">
                                            Other
                                        </option>

                                    </select>

                                </div>


                                <div class="form-field">

                                    <label for="city">
                                        City <span>*</span>
                                    </label>

                                    <select
                                        id="city"
                                        name="city"
                                        required
                                    >

                                        <option value="">
                                            Select an option
                                        </option>

                                        <option value="ahmedabad">
                                            Ahmedabad
                                        </option>

                                        <option value="delhi">
                                            Delhi
                                        </option>

                                        <option value="mumbai">
                                            Mumbai
                                        </option>

                                        <option value="surat">
                                            Surat
                                        </option>

                                        <option value="bangalore">
                                            Bangalore
                                        </option>

                                        <option value="other">
                                            Other
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <!-- Phone / Email -->

                            <div class="form-row">

                                <div class="form-field">

                                    <label for="phone-number">
                                        Phone number <span>*</span>
                                    </label>

                                    <input
                                        type="tel"
                                        id="phone-number"
                                        name="phone"
                                        value="+91"
                                        required
                                    >

                                </div>


                                <div class="form-field">

                                    <label for="email">
                                        Email <span>*</span>
                                    </label>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        required
                                    >

                                </div>

                            </div>


                            <!-- Consent -->

                            <div class="program-enquiry-consent">

                                <p>
                                    By clicking the button below, you agree to receive
                                    communications via Email/Call/WhatsApp/SMS about
                                    this academic program and other academic programs
                                    from University of Aberdeen or its trusted
                                    third-party partners and service providers.
                                    <a href="#">
                                        Privacy Policy
                                    </a>
                                </p>

                            </div>


                            <!-- Submit -->

                            <div class="program-enquiry-submit">

                                <button
                                    type="submit"
                                    class="program-enquiry-submit-button"
                                >
                                    Submit
                                </button>

                            </div>

                        </form>

                    </div>


                    <!-- Thank You -->

                    <div
                        class="program-enquiry-thank-you"
                        id="program-enquiry-thank-you"
                        hidden
                    >

                        <h2>
                            Thank You!
                        </h2>

                        <p>
                            Thank you for registering your interest.
                            We will contact you soon.
                        </p>

                        <button
                            type="button"
                            class="program-enquiry-thank-you-close"
                            id="program-enquiry-thank-you-close"
                        >
                            Close
                        </button>

                    </div>

                </div>

            </section>

        </div>

    </main>


    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const enquireButton =
            document.getElementById('program-enquire-button');

        const applyButton =
            document.getElementById('program-apply-button');

        const popup =
            document.getElementById('program-enquiry-popup');

        const closeButton =
            document.getElementById('program-enquiry-close');

        const overlay =
            document.getElementById('program-enquiry-overlay');

        const form =
            document.getElementById('program-enquiry-form');

        const formWrapper =
            document.getElementById('program-enquiry-form-wrapper');

        const thankYou =
            document.getElementById('program-enquiry-thank-you');

        const thankYouClose =
            document.getElementById('program-enquiry-thank-you-close');


        function openPopup() {

            popup.hidden = false;

            popup.setAttribute(
                'aria-hidden',
                'false'
            );

            document.body.classList.add(
                'program-enquiry-open'
            );

        }


        function closePopup() {

            popup.hidden = true;

            popup.setAttribute(
                'aria-hidden',
                'true'
            );

            document.body.classList.remove(
                'program-enquiry-open'
            );

        }

if (enquireButton) {
    enquireButton.addEventListener(
        'click',
        function () {
            trackProgramClick('enquire_now');
            openPopup();
        }
    );
}

     if (applyButton) {
    applyButton.addEventListener(
        'click',
        function () {
            trackProgramClick('apply_now');
            openPopup();
        }
    );
}


        if (closeButton) {

            closeButton.addEventListener(
                'click',
                function () {

                    closePopup();

                }
            );

        }


        if (overlay) {

            overlay.addEventListener(
                'click',
                function () {

                    closePopup();

                }
            );

        }


        if (form) {

            form.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();

                    formWrapper.hidden = true;

                    thankYou.hidden = false;

                }
            );

        }


        if (thankYouClose) {

            thankYouClose.addEventListener(
                'click',
                function () {

                    closePopup();

                    formWrapper.hidden = false;

                    thankYou.hidden = true;

                    if (form) {
                        form.reset();
                    }

                }
            );

        }


        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape' &&
                    popup &&
                    !popup.hidden
                ) {

                    closePopup();

                }

            }
        );
        function trackProgramClick(eventName) {

    fetch('<?php echo esc_url( rest_url( 'university/v1/track-click' ) ); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            event: eventName,
            program_id: <?php echo (int) $program_id; ?>,
            program_title: <?php echo wp_json_encode( get_the_title() ); ?>,
            url: window.location.href
        })
    }).catch(function (error) {
        console.error('Tracking error:', error);
    });

}

    });
    </script>

    <?php

endwhile;

get_footer();
?>