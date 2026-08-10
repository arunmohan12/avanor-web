import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const propertyGallery = document.querySelector('.avanor-property-gallery');

if (propertyGallery) {
    new Swiper(propertyGallery, {
        modules: [Navigation, Pagination],

        loop: true,
        speed: 800,

        slidesPerView: 1,

        navigation: {
            nextEl: '.avanor-property-gallery-next',
            prevEl: '.avanor-property-gallery-prev',
        },

        pagination: {
            el: '.avanor-property-gallery-pagination',
            clickable: true,
        },
    });
}