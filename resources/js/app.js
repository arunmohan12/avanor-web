import $ from 'jquery';

window.$ = $;
window.jQuery = $;

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

                img.src = developer.logo
                    ? `/storage/${developer.logo}`
                    : '/assets/img/default-developer-logo.webp';

                img.alt = developer.name;

                card.href = `/developers/${developer.slug}`;

                card.classList.remove('is-flipping');
            }, 300);
        });

        offset = (offset + cards.length) % developers.length;

    }, 5000);
});