export const it_counter = () => {
    const counterElements = document.querySelectorAll('.js-counter .number-wrapper p');
    const ANIMATION_DURATION = 2000;

    function animateCounter(element, start, end, duration) {
        const range = end - start;
        const increment = range / (duration / 16);
        let current = start;
        const symbolElement = element.nextElementSibling;
        const symbol = symbolElement ? symbolElement.textContent.trim() : '';

        const formatNumber = (num) => {
            return Math.floor(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        };

        const updateCounter = () => {
            current += increment;

            if (symbol === '%') {
                element.textContent = `${Math.floor(current)}`;
            } else if (end >= 1000) {
                element.textContent = formatNumber(current);
            } else {
                element.textContent = Math.floor(current);
            }

            if ((increment > 0 && current < end) || (increment < 0 && current > end)) {
                requestAnimationFrame(updateCounter);
            } else {
                if (symbol === '%') {
                    element.textContent = `${end}`;
                } else if (end >= 1000) {
                    element.textContent = formatNumber(end);
                } else {
                    element.textContent = end;
                }
            }
        };

        requestAnimationFrame(updateCounter);
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                counterElements.forEach(counter => {
                    const targetNumber = parseInt(counter.textContent.replace(/\./g, ''), 10);
                    animateCounter(counter, 0, targetNumber, ANIMATION_DURATION);
                });

                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2
    });

    const section = document.querySelector('.counter.section');
    if (section) {
        observer.observe(section);
    }
};
