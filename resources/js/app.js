import Lenis from 'lenis';

const lenis = new Lenis({
    duration: 0.8,
    smoothWheel: true,
    wheelMultiplier: 0.9,
    touchMultiplier: 1,
});

function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);



document.addEventListener('DOMContentLoaded', () => {

    const mobileMenu = document.querySelector('#avanorMobileMenu');
    const openButton = document.querySelector('#avanorMobileMenuOpen');
    const closeButton = document.querySelector('#avanorMobileMenuClose');

    if (!mobileMenu || !openButton || !closeButton) return;

    const openMenu = () => {
        mobileMenu.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    };

    const closeMenu = () => {
        mobileMenu.classList.remove('is-open');
        document.body.style.overflow = '';
    };

    openButton.addEventListener('click', openMenu);
    closeButton.addEventListener('click', closeMenu);

    mobileMenu.addEventListener('click', (event) => {
        if (event.target === mobileMenu) {
            closeMenu();
        }
    });

    mobileMenu
        .querySelectorAll('.avanor-mobile-submenu-toggle')
        .forEach((button) => {

            button.addEventListener('click', () => {
                button.closest('.has-children')
                    ?.classList.toggle('is-open');
            });

        });

});