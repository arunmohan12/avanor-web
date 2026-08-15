document.addEventListener('DOMContentLoaded', () => {
    const grid = document.querySelector('#developerGrid');

    if (!grid || !window.avanorDevelopers) return;

    const cards = [...grid.querySelectorAll('.avanor-developer-card')];
    const developers = window.avanorDevelopers;

    if (!developers.length || !cards.length) return;

    let offset = 1;

    setInterval(() => {
        cards.forEach((card, index) => {
            const img = card.querySelector('.developer-logo-brand');

            card.classList.add('is-flipping');

            setTimeout(() => {
                const developer =
                    developers[(index + offset) % developers.length];

                img.src = developer.logo_url;
                img.alt = developer.name;

                card.href = `/developers/${developer.slug}`;

                card.classList.remove('is-flipping');
            }, 300);
        });

        offset = (offset + 1) % developers.length;
    }, 5000);
});