import Swiper from 'swiper';
import {
    Navigation,
    Pagination
} from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import intlTelInput from 'intl-tel-input';
import 'intl-tel-input/styles';

import '../pages/contact.js';

const propertyGallery = document.querySelector('.avanor-property-gallery');

if (propertyGallery) {
    new Swiper(propertyGallery, {
        modules: [Navigation, Pagination],

        loop: true,
        speed: 800,

        slidesPerView: 1,

        autoHeight: true,

        navigation: {
            nextEl: '.avanor-property-gallery-next',
            prevEl: '.avanor-property-gallery-prev',
        },

        pagination: {
            el: '.avanor-property-gallery-pagination',
            clickable: true,
        },

        breakpoints: {
            0: {
                autoHeight: true,
            },

            768: {
                autoHeight: false,
            },
        },
    });
}

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