
document.addEventListener('DOMContentLoaded', () => {
    const grid = document.querySelector('#developerGrid');

    if (!grid || !window.avanorDevelopers) return;

    const cards = [...grid.querySelectorAll('.avanor-developer-card')];
    const developers = window.avanorDevelopers;

    if (developers.length <= cards.length) return;

    let offset = cards.length;

    setInterval(() => {
        cards.forEach((card, index) => {
            const img = card.querySelector('.developer-logo-brand');

            card.classList.add('is-flipping');

            setTimeout(() => {
                const developer =
                    developers[(offset + index) % developers.length];

                    img.src = developer.logo_url;

                img.alt = developer.name;

                // card.href = `/developers/${developer.slug}`;
                card.href = `javascript:void(0)`;

                card.classList.remove('is-flipping');
            }, 300);
        });

        offset = (offset + cards.length) % developers.length;

    }, 5000);
});

document.addEventListener('DOMContentLoaded', () => {
    const blogSwiper = document.querySelector('.avanor-blog-swiper');

    if (!blogSwiper) return;

    new Swiper('.avanor-blog-swiper', {
        slidesPerView: 1.15,
        spaceBetween: 20,
        grabCursor: true,

        breakpoints: {
            576: {
                slidesPerView: 1.5,
                spaceBetween: 24,
            },

            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },

            1200: {
                slidesPerView: 3,
                spaceBetween: 45,
            },
        },
    });
});