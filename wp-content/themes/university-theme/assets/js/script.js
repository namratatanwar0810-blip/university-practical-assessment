document.addEventListener('DOMContentLoaded', function () {

    /* ===========================
       Mobile Menu
    =========================== */

    const toggle = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.main-navigation');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            toggle.classList.toggle('active');
            nav.classList.toggle('active');
        });
    }

    /* ===========================
       Hero Slider
    =========================== */

    const slidesContainer = document.querySelector('.slides');
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const next = document.querySelector('.next');
    const prev = document.querySelector('.prev');

    if (!slidesContainer || slides.length === 0) {
        return;
    }

    let currentSlide = 0;
    const totalSlides = slides.length;

    function showSlide(index) {

        if (index >= totalSlides) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = totalSlides - 1;
        } else {
            currentSlide = index;
        }

        slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentSlide);
        });
    }

    if (next) {
        next.addEventListener('click', function () {
            showSlide(currentSlide + 1);
        });
    }

    if (prev) {
        prev.addEventListener('click', function () {
            showSlide(currentSlide - 1);
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', function () {
            showSlide(index);
        });
    });

    setInterval(function () {
        showSlide(currentSlide + 1);
    }, 5000);

    // Initial slide
    showSlide(0);

});