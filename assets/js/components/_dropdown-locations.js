'use strict';

export const itInitLocationsDropdown = () => {
    const dropdowns = document.querySelectorAll('.locations-dropdown');

    const isMobile = () => window.innerWidth < 768;

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.locations-dropdown__toggle');
        const menu = dropdown.querySelector('.locations-dropdown__menu');
        const arrow = dropdown.querySelector('.dropdown-arrow');

        toggle?.addEventListener('click', (e) => {
            if (isMobile()) {
                e.preventDefault();
                menu.classList.toggle('active');
                arrow.classList.toggle('active');
            }
        });
    });

    // Close dropdowns when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (isMobile()) {
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(e.target)) {
                    const menu = dropdown.querySelector('.locations-dropdown__menu');
                    const arrow = dropdown.querySelector('.dropdown-arrow');
                    if (menu?.classList.contains('active')) {
                        menu.classList.remove('active');
                        arrow?.classList.remove('active');
                    }
                }
            });
        }
    });
};
