<?php
get_header();
?>

<main class="single-course">

    <div class="container">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <h1><?php the_title(); ?></h1>

                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large' ); ?>
                <?php endif; ?>

                <div class="course-content">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; ?>

        <?php endif; ?>

    </div>

</main>
<div class="course-content">
    <?php the_content(); ?>
</div>
<?php
$duration = get_post_meta(get_the_ID(), 'course_duration', true);
$fee = get_post_meta(get_the_ID(), 'course_fee', true);
$level = get_post_meta(get_the_ID(), 'course_level', true);
$deadline = get_post_meta(get_the_ID(), 'admission_deadline', true);
$featured = get_post_meta(get_the_ID(), 'featured_course', true);

$categories = get_the_terms(get_the_ID(), 'course_category');
?>

<div class="course-information">

    <h2>Course Information</h2>

    <ul>
        <li><strong>Course Duration:</strong> <?php echo esc_html($duration); ?></li>

        <li><strong>Course Fee:</strong> ₹<?php echo esc_html($fee); ?></li>

        <li><strong>Course Level:</strong> <?php echo esc_html($level); ?></li>

        <li><strong>Admission Deadline:</strong> <?php echo esc_html($deadline); ?></li>

        <li><strong>Featured Course:</strong> <?php echo $featured ? 'Yes' : 'No'; ?></li>

        <li><strong>Course Category:</strong>

            <?php
            if ($categories && ! is_wp_error($categories)) {
                foreach ($categories as $category) {
                    echo esc_html($category->name);
                }
            }
            ?>

        </li>
    </ul>

</div>
<?php
get_footer();