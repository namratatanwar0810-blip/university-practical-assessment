<?php get_header(); ?>

<section class="hero">

    <div class="slider">

        <div class="slides">

            <!-- ================= Slide 1 ================= -->

            <div class="slide">

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner/hero-image.png"
                    alt="University Banner">

                <div class="overlay">

                    <h1>Join the University of Aberdeen in India</h1>

                    <p>
                        Global challenges are waiting for new ways of thinking.
                        Discover your true north and start creating a more inclusive
                        and sustainable world.
                        <span class="hero-arrow">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner/banner-arrow.png"
                                alt="Arrow">
                        </span>
                    </p>

                    <div class="dots">

                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>

                    </div>

                </div>

            </div>

            <!-- ================= Slide 2 ================= -->

            <div class="slide">

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner/hero-image.png"
                    alt="University Banner">

                <div class="overlay">

                    <h1>Study with World-Class Academics</h1>

                    <p>
                        Global challenges are waiting for new ways of thinking.
                        Discover your true north and start creating a more inclusive
                        and sustainable world.
                        <span class="hero-arrow">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner/banner-arrow.png"
                                alt="Arrow">
                        </span>
                    </p>
                    <div class="dots">

                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>

                    </div>


                </div>

            </div>

            <!-- ================= Slide 3 ================= -->

            <div class="slide">

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner/hero-image.png"
                    alt="University Banner">

                <div class="overlay">

                    <h1>Discover Your Future</h1>

                    <p>
                        Global challenges are waiting for new ways of thinking.
                        Discover your true north and start creating a more inclusive
                        and sustainable world.
                        <span class="hero-arrow">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner/banner-arrow.png"
                                alt="Arrow">
                        </span>
                    </p>

                    <div class="dots">

                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>

                    </div>

                </div>

            </div>

        </div>

        <!-- Navigation -->

        <button class="arrow prev" aria-label="Previous Slide">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner/left-arrows.png"
                alt="Arrow">
        </button>

        <button class="arrow next" aria-label="Next Slide">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner/right-arrows.png"
                alt="Arrow">
        </button>

        <!-- Pagination -->



    </div>

</section>

<section class="Careers-Employability section">

    <div class="container">

        <div class="careers-employability-heading">
            <h2>Careers and Employability</h2>
        </div>

        <div class="careers-employability-wrapper">

            <div class="careers-employability-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Careers-employability/Careers-Employability.png" alt="Tops">
            </div>

            <div class="careers-employability-content">

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <a href="#" class="careers-employability-btn">See More</a>

            </div>

        </div>

    </div>

</section>

<section class="our-programmes section">

    <div class="container">

        <div class="our-programmes-heading">
            <h2>Our Programmes</h2>
        </div>

        <div class="our-programmes-grid">

            <?php
            $program_types = array(
                'undergraduate' => 'Undergraduate Programmes',
                'postgraduate'  => 'Postgraduate Programmes',
            );

            foreach ( $program_types as $term_slug => $term_title ) :

                $programs = new WP_Query(
                    array(
                        'post_type'      => 'program',
                        'posts_per_page' => 1,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'program-type',
                                'field'    => 'slug',
                                'terms'    => $term_slug,
                            ),
                        ),
                    )
                );

                if ( $programs->have_posts() ) :

                    $programs->the_post();
                    ?>

                    <div class="programme-card">

                        <?php if ( has_post_thumbnail() ) : ?>

                            <div class="programme-image">
                                <?php the_post_thumbnail( 'full' ); ?>
                            </div>

                        <?php endif; ?>

                        <div class="programme-content">

                            <h3>
                                <?php echo esc_html( $term_title ); ?>
                            </h3>

                            <p>
                                Discover our
                                <?php echo esc_html( strtolower( $term_title ) ); ?>
                                designed to provide practical knowledge and career-focused education.
                            </p>

                            <a
                                href="<?php echo esc_url( home_url( '/programmes/' . $term_slug . '/' ) ); ?>"
                                class="programme-btn"
                            >
                                <span>See More</span>

                                <img
                                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/program-course/link-program.png' ); ?>"
                                    alt="Arrow"
                                >
                            </a>

                        </div>

                    </div>

                    <?php

                    wp_reset_postdata();

                endif;

            endforeach;
            ?>

        </div>

    </div>

</section>


<?php get_footer(); ?>