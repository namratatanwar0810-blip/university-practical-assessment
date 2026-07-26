<footer class="site-footer">

    <div class="footer-top">

        <div class="container">

            <div class="footer-grid">

                <!-- Left -->

                <div class="footer-left">

                    <a href="<?php echo home_url(); ?>" class="footer-logo">

                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/footer-img.png"
                            alt="University Logo">

                    </a>

                    <p class="footer-address">
                        The University of Aberdeen<br>
                        India Location,<br>
                        Mumbai
                    </p>

                    <div class="footer-phone">

                        <span class="phone-label">Tel:</span>

                        <a href="tel:+9112121212" class="phone-number">
                            +91-1212121212
                        </a>

                    </div>

                    <ul class="footer-links">

                        <li>
                            <a href="#">Contact Us</a>
                        </li>

                        <li>
                            <a href="#">Student Policies</a>
                        </li>

                    </ul>

                </div>

                <!-- Right -->

                <div class="footer-right">

                    <h3>Connect With Us</h3>

                    <div class="footer-social">

                        <a href="#">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/twitter.png"
                                alt="">
                        </a>

                        <a href="#">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/instagram.png"
                                alt="">
                        </a>

                        <a href="#">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/linkedin.png"
                                alt="">
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="footer-bottom">

        <div class="container">

            <ul class="footer-bottom-menu">

                <li><a href="#">Privacy</a></li>

                <li><a href="#">Accessibility</a></li>

                <li><a href="#">Cookies</a></li>

            </ul>

            <p class="copyright">
               <?php echo do_shortcode('[university_year]'); ?>
           </p>

        </div>

    </div>

</footer>

<?php wp_footer(); ?>

</body>

</html>