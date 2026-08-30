import Swiper from 'swiper';


import intlTelInput from 'intl-tel-input';
import 'intl-tel-input/styles';



document.addEventListener('DOMContentLoaded', () => {

    const galleryElement =
        document.getElementById('landingGalleryMain');

    if (!galleryElement) {
        return;
    }

    const prevButton =
        document.getElementById('landingGalleryPrev');

    const nextButton =
        document.getElementById('landingGalleryNext');

    const thumbnails =
        document.querySelectorAll('[data-gallery-index]');


    /*
    |--------------------------------------------------------------------------
    | Main Slider
    |--------------------------------------------------------------------------
    */

    const gallerySwiper = new Swiper(galleryElement, {

        slidesPerView: 1,

        speed: 600,

        loop: true,

        grabCursor: true,

        allowTouchMove: true,

        simulateTouch: true,

        on: {

            slideChange(swiper) {

                const index = swiper.realIndex;

                thumbnails.forEach((thumbnail) => {

                    thumbnail.classList.toggle(
                        'is-active',
                        Number(thumbnail.dataset.galleryIndex) === index
                    );

                });

            },

        },

    });


    /*
    |--------------------------------------------------------------------------
    | Previous
    |--------------------------------------------------------------------------
    */

    prevButton?.addEventListener('click', (event) => {

        event.preventDefault();

        gallerySwiper.slidePrev();

    });


    /*
    |--------------------------------------------------------------------------
    | Next
    |--------------------------------------------------------------------------
    */

    nextButton?.addEventListener('click', (event) => {

        event.preventDefault();

        gallerySwiper.slideNext();

    });


    /*
    |--------------------------------------------------------------------------
    | Thumbnail Click
    |--------------------------------------------------------------------------
    */

    thumbnails.forEach((thumbnail) => {

        thumbnail.addEventListener('click', () => {

            const index =
                Number(thumbnail.dataset.galleryIndex);

            gallerySwiper.slideToLoop(index);

        });

    });

});


document.addEventListener('DOMContentLoaded', () => {

    const propertyBar = document.getElementById('landingPropertyBar');
    const footer = document.getElementById('landingFooter');

    if (!propertyBar || !footer) {
        console.log('Missing:', {
            propertyBar,
            footer
        });

        return;
    }

    const observer = new IntersectionObserver(
        ([entry]) => {

            console.log('Footer intersection:', entry.isIntersecting);

            if (entry.isIntersecting) {
                propertyBar.classList.add('is-hidden');
            } else {
                propertyBar.classList.remove('is-hidden');
            }

        },
        {
            threshold: 0,
            rootMargin: '0px 0px 150px 0px',
        }
    );

    observer.observe(footer);

});

document.addEventListener('DOMContentLoaded', () => {

    const menuToggle = document.getElementById('landingMenuToggle');
    const mobileMenu = document.getElementById('landingMobileMenu');

    if (!menuToggle || !mobileMenu) {
        return;
    }

    const closeMenu = () => {
        mobileMenu.classList.remove('is-open');
        menuToggle.classList.remove('is-active');
        menuToggle.setAttribute('aria-expanded', 'false');
    };

    menuToggle.addEventListener('click', () => {

        const isOpen = mobileMenu.classList.toggle('is-open');

        menuToggle.classList.toggle('is-active', isOpen);

        menuToggle.setAttribute(
            'aria-expanded',
            isOpen ? 'true' : 'false'
        );

    });


    /* Close menu after clicking a link */

    mobileMenu.querySelectorAll('a').forEach((link) => {

        link.addEventListener('click', () => {
            closeMenu();
        });

    });

});

document.addEventListener('DOMContentLoaded', () => {

    const popup = document.getElementById('landingLeadPopup');

    if (!popup) {
        return;
    }

    const openButtons = document.querySelectorAll(
        '[data-lead-popup-open]'
    );

    const closeButtons = popup.querySelectorAll(
        '[data-lead-popup-close]'
    );

    const openPopup = () => {

        popup.classList.add('is-open');

        popup.setAttribute(
            'aria-hidden',
            'false'
        );

        document.body.classList.add(
            'landing-popup-open'
        );
    };

    const closePopup = () => {

        popup.classList.remove('is-open');

        popup.setAttribute(
            'aria-hidden',
            'true'
        );

        document.body.classList.remove(
            'landing-popup-open'
        );
    };

    openButtons.forEach((button) => {

        button.addEventListener('click', (event) => {

            event.preventDefault();

            openPopup();
        });
    });

    closeButtons.forEach((button) => {

        button.addEventListener('click', () => {
            closePopup();
        });
    });

    document.addEventListener('keydown', (event) => {

        if (
            event.key === 'Escape' &&
            popup.classList.contains('is-open')
        ) {
            closePopup();
        }
    });

});


document.addEventListener('DOMContentLoaded', () => {

    const phoneInputs = document.querySelectorAll(
        'input[type="tel"]'
    );

    phoneInputs.forEach((input) => {

        if (input.dataset.intlInitialized === 'true') {
            return;
        }

        intlTelInput(input, {
            initialCountry: 'ae',
            separateDialCode: true,
            preferredCountries: [
                'ae',
                'in',
                'sa',
                'qa',
                'kw',
                'om',
            ],
        });

        input.dataset.intlInitialized = 'true';
    });

});
/* =====================================================
   AUTO OPEN LEAD POPUP
   Opens once after 5 seconds
===================================================== */

let leadPopupOpened = false;

document
    .querySelectorAll('[data-lead-popup-open]')
    .forEach((button) => {
        button.addEventListener('click', () => {
            leadPopupOpened = true;
        });
    });

setTimeout(() => {

    if (leadPopupOpened) {
        return;
    }

    const popupTrigger = document.querySelector(
        '[data-lead-popup-open]'
    );

    if (popupTrigger) {
        leadPopupOpened = true;
        popupTrigger.click();
    }

}, 5000);
