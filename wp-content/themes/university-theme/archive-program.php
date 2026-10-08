<?php
/**
 * Programs Archive
 */

get_header();
?>

<main id="primary" class="site-main programs-archive">

    <div class="container">

        <!-- ================================
             Programs Header
        ================================= -->

        <header class="programs-archive-header">

            <h1>Programs</h1>

            <p>
                Explore our undergraduate and postgraduate programs.
            </p>

            <!-- Filter Buttons -->

            <div
                class="program-filter"
                data-program-filter
            >

                <!-- ALL -->

                <a
                    href="<?php echo esc_url( get_post_type_archive_link( 'program' ) ); ?>"
                    class="program-filter-button active"
                    data-filter="all"
                >
                    All
                </a>


                <!-- UNDERGRADUATE -->

                <a
                    href="<?php echo esc_url( home_url( '/programmes/undergraduate/' ) ); ?>"
                    class="program-filter-button"
                    data-filter="undergraduate"
                >
                    Undergraduate
                </a>


                <!-- POSTGRADUATE -->

                <a
                    href="<?php echo esc_url( home_url( '/programmes/postgraduate/' ) ); ?>"
                    class="program-filter-button"
                    data-filter="postgraduate"
                >
                    Postgraduate
                </a>

            </div>

        </header>


        <!-- ================================
             Undergraduate Programs
        ================================= -->

        <section
            class="program-type-section"
            data-program-section="undergraduate"
        >

            <h2 class="program-type-heading">
                Undergraduate Programs
            </h2>


            <div class="programs-grid">

                <?php

                $undergraduate_programs = new WP_Query(
                    array(
                        'post_type'      => 'program',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',

                        'tax_query' => array(
                            array(
                                'taxonomy' => 'program-type',
                                'field'    => 'slug',
                                'terms'    => 'undergraduate',
                            ),
                        ),

                        'orderby' => 'title',
                        'order'   => 'ASC',
                    )
                );

                ?>

                <?php if ( $undergraduate_programs->have_posts() ) : ?>

                    <?php while ( $undergraduate_programs->have_posts() ) : ?>

                        <?php $undergraduate_programs->the_post(); ?>

                        <?php

                        $academic_year = get_post_meta(
                            get_the_ID(),
                            'academic_year',
                            true
                        );

                        $duration = get_post_meta(
                            get_the_ID(),
                            'duration',
                            true
                        );

                        ?>


                        <!-- PROGRAM CARD -->

                        <article
                            class="program-card"
                            data-program-type="undergraduate"
                        >

                            <?php if ( has_post_thumbnail() ) : ?>

                                <div class="program-card-image">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php
                                        the_post_thumbnail(
                                            'large',
                                            array(
                                                'alt' => get_the_title(),
                                            )
                                        );
                                        ?>

                                    </a>

                                </div>

                            <?php endif; ?>


                            <div class="program-card-content">

                                <h2 class="program-card-title">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php the_title(); ?>

                                    </a>

                                </h2>


                                <?php if ( $academic_year ) : ?>

                                    <p class="program-card-year">

                                        <strong>
                                            Academic Year:
                                        </strong>

                                        <?php
                                        echo esc_html( $academic_year );
                                        ?>

                                    </p>

                                <?php endif; ?>


                                <?php if ( $duration ) : ?>

                                    <p class="program-card-duration">

                                        <strong>
                                            Duration:
                                        </strong>

                                        <?php
                                        echo esc_html( $duration );
                                        ?>

                                    </p>

                                <?php endif; ?>


                                <a
                                    class="program-card-link"
                                    href="<?php the_permalink(); ?>"
                                >
                                    View Program
                                </a>

                            </div>

                        </article>

                    <?php endwhile; ?>

                <?php else : ?>

                    <div class="programs-empty">

                        <p>
                            No undergraduate programs found.
                        </p>

                    </div>

                <?php endif; ?>


                <?php wp_reset_postdata(); ?>

            </div>

        </section>



        <!-- ================================
             Postgraduate Programs
        ================================= -->

        <section
            class="program-type-section"
            data-program-section="postgraduate"
        >

            <h2 class="program-type-heading">
                Postgraduate Programs
            </h2>


            <div class="programs-grid">

                <?php

                $postgraduate_programs = new WP_Query(
                    array(
                        'post_type'      => 'program',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',

                        'tax_query' => array(
                            array(
                                'taxonomy' => 'program-type',
                                'field'    => 'slug',
                                'terms'    => 'postgraduate',
                            ),
                        ),

                        'orderby' => 'title',
                        'order'   => 'ASC',
                    )
                );

                ?>


                <?php if ( $postgraduate_programs->have_posts() ) : ?>

                    <?php while ( $postgraduate_programs->have_posts() ) : ?>

                        <?php $postgraduate_programs->the_post(); ?>

                        <?php

                        $academic_year = get_post_meta(
                            get_the_ID(),
                            'academic_year',
                            true
                        );

                        $duration = get_post_meta(
                            get_the_ID(),
                            'duration',
                            true
                        );

                        ?>


                        <!-- PROGRAM CARD -->

                        <article
                            class="program-card"
                            data-program-type="postgraduate"
                        >

                            <?php if ( has_post_thumbnail() ) : ?>

                                <div class="program-card-image">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php
                                        the_post_thumbnail(
                                            'large',
                                            array(
                                                'alt' => get_the_title(),
                                            )
                                        );
                                        ?>

                                    </a>

                                </div>

                            <?php endif; ?>


                            <div class="program-card-content">

                                <h2 class="program-card-title">

                                    <a href="<?php the_permalink(); ?>">

                                        <?php the_title(); ?>

                                    </a>

                                </h2>


                                <?php if ( $academic_year ) : ?>

                                    <p class="program-card-year">

                                        <strong>
                                            Academic Year:
                                        </strong>

                                        <?php
                                        echo esc_html( $academic_year );
                                        ?>

                                    </p>

                                <?php endif; ?>


                                <?php if ( $duration ) : ?>

                                    <p class="program-card-duration">

                                        <strong>
                                            Duration:
                                        </strong>

                                        <?php
                                        echo esc_html( $duration );
                                        ?>

                                    </p>

                                <?php endif; ?>


                                <a
                                    class="program-card-link"
                                    href="<?php the_permalink(); ?>"
                                >
                                    View Program
                                </a>

                            </div>

                        </article>

                    <?php endwhile; ?>

                <?php else : ?>

                    <div class="programs-empty">

                        <p>
                            No postgraduate programs found.
                        </p>

                    </div>

                <?php endif; ?>


                <?php wp_reset_postdata(); ?>

            </div>

        </section>


    </div>

</main>


<!-- =========================================
     PROGRAM FILTER JAVASCRIPT
========================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const filterContainer = document.querySelector(
        '[data-program-filter]'
    );

    if (!filterContainer) {
        return;
    }


    const buttons = filterContainer.querySelectorAll(
        '.program-filter-button'
    );


    const sections = document.querySelectorAll(
        '[data-program-section]'
    );


    const cards = document.querySelectorAll(
        '.program-card'
    );


    /*
     * Apply filter
     */

    function applyFilter(filter) {

        /*
         * Show / hide individual cards
         */

        cards.forEach(function (card) {

            const type = card.getAttribute(
                'data-program-type'
            );

            if (
                filter === 'all' ||
                type === filter
            ) {

                card.style.display = '';

            } else {

                card.style.display = 'none';

            }

        });


        /*
         * Show / hide sections
         */

        sections.forEach(function (section) {

            const sectionType = section.getAttribute(
                'data-program-section'
            );

            if (
                filter === 'all' ||
                sectionType === filter
            ) {

                section.style.display = '';

            } else {

                section.style.display = 'none';

            }

        });


        /*
         * Active button
         */

        buttons.forEach(function (button) {

            const buttonFilter = button.getAttribute(
                'data-filter'
            );

            if (buttonFilter === filter) {

                button.classList.add('active');

            } else {

                button.classList.remove('active');

            }

        });

    }


    /*
     * Button click
     */

    buttons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            /*
             * VERY IMPORTANT:
             * Stop the normal <a> redirect.
             */

            event.preventDefault();


            const filter = button.getAttribute(
                'data-filter'
            );


            /*
             * Apply filter
             */

            applyFilter(filter);


            /*
             * Change URL without reload
             */

         let newUrl = '<?php echo esc_url( get_post_type_archive_link( 'program' ) ); ?>';

if (filter === 'undergraduate') {

    newUrl = '<?php echo esc_url( home_url( '/programmes/undergraduate/' ) ); ?>';

}

if (filter === 'postgraduate') {

    newUrl = '<?php echo esc_url( home_url( '/programmes/postgraduate/' ) ); ?>';

}


            window.history.pushState(
                {},
                '',
                newUrl
            );

        });

    });


    /*
     * Browser Back / Forward
     */

    window.addEventListener('popstate', function () {

        const params = new URLSearchParams(
            window.location.search
        );

        const filter = params.get(
            'program_type'
        );


        if (
            filter === 'undergraduate' ||
            filter === 'postgraduate'
        ) {

            applyFilter(filter);

        } else {

            applyFilter('all');

        }

    });


    /*
     * Apply filter when page first loads
     */

    const params = new URLSearchParams(
        window.location.search
    );

    const initialFilter = params.get(
        'program_type'
    );


    if (
        initialFilter === 'undergraduate' ||
        initialFilter === 'postgraduate'
    ) {

        applyFilter(initialFilter);

    } else {

        applyFilter('all');

    }

});

</script>


<?php

get_footer();

?>