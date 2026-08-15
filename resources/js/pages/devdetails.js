import Swiper from 'swiper';

import {
    Navigation,
    Pagination,
    Autoplay,
    EffectFade,
} from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';


const propertyGallery = document.querySelector(
    '.avanor-property-gallery'
);

if (propertyGallery) {

    const slideCount = Number(
        propertyGallery.dataset.slideCount || 0
    );

    const nextButton = propertyGallery.querySelector(
        '.avanor-property-gallery-next'
    );

    const prevButton = propertyGallery.querySelector(
        '.avanor-property-gallery-prev'
    );

    const pagination = propertyGallery.querySelector(
        '.avanor-property-gallery-pagination'
    );


    if (slideCount > 1) {

        new Swiper(propertyGallery, {

            modules: [
                Navigation,
                Pagination,
                Autoplay,
                EffectFade,
            ],

            loop: true,

            speed: 800,

            effect: 'fade',

            fadeEffect: {
                crossFade: true,
            },

            autoplay: {
                delay: 5500,
                disableOnInteraction: false,
            },

            navigation: {
                nextEl: nextButton,
                prevEl: prevButton,
            },

            pagination: {
                el: pagination,
                clickable: true,
            },

        });

    }

}