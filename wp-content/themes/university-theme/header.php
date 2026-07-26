<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header">

        <div class="container">

            <div class="header-top">

                <!-- Logo -->
                <div class="header-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php
        if ( has_custom_logo() ) {
            the_custom_logo();
        } else {
        ?>

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/header/header-logo.png"
                            alt="Logo">

                        <?php } ?>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="main-navigation">

                    <?php

    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => '',
    ));

    ?>

                </nav>

                <!-- Apply Button -->
                <div class="header-action">
                    <a href="#" class="apply-btn">Apply Now</a>
                </div>

                <!-- Mobile Toggle -->
                <button class="menu-toggle" aria-label="Toggle Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

            </div>

            <div class="header-bottom">
                <a href="#" class="header-link">
                    University of Aberdeen UK
                </a>
            </div>

        </div>

    </header>