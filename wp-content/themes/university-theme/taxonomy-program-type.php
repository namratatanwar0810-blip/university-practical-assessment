<?php
/**
 * Program Type Archive
 */

get_header();

$current_term = get_queried_object();
?>

<main id="primary" class="site-main programs-archive">

    <!-- Full Width Blue Title Section -->
    <section class="program-type-hero">

        <div class="program-type-hero-inner">

            <h1>
                <?php echo esc_html( $current_term->name ); ?> Programmes
            </h1>

            <span class="program-type-hero-line"></span>

        </div>

    </section>


    <!-- Content Inside Container -->
    <div class="container">

        <div class="program-type-intro">

            <p>
                Discover a campus that blends Scottish heritage with Indian innovation. A global education awaits!
            </p>

        </div>


        <?php if ( have_posts() ) : ?>

            <div class="programs-grid">

                <?php
                while ( have_posts() ) :
                    the_post();

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

                    <article class="program-card">

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


                            <span class="program-card-line"></span>


                            <?php if ( $academic_year ) : ?>

                                <p class="program-card-year">

                                    <strong>
                                        Academic Year:
                                    </strong>

                                    <?php echo esc_html( $academic_year ); ?>

                                </p>

                            <?php endif; ?>


                            <?php if ( $duration ) : ?>

                                <p class="program-card-duration">

                                    <strong>
                                        Duration:
                                    </strong>

                                    <?php echo esc_html( $duration ); ?>

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

            </div>


        <?php else : ?>

            <div class="programs-empty">

                <p>
                    No programs found in this category.
                </p>

            </div>

        <?php endif; ?>

    </div>

</main>

<?php
get_footer();