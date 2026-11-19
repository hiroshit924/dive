const hero = document.querySelector('.hero');
const motion = window.matchMedia('(prefers-reduced-motion: reduce)');

if (hero) {
    const video = hero.querySelector('video');
    const toggle = hero.querySelector('.motion-toggle');

    function syncVideoControl() {
        const playing = !video.paused;
        hero.classList.toggle('is-playing', playing);
        toggle.textContent = playing ? 'Ⅱ' : '▶';
        toggle.setAttribute('aria-label', playing ? toggle.dataset.pause : toggle.dataset.play);
    }

    toggle.hidden = false;
    syncVideoControl();
    toggle.addEventListener('click', async () => {
        if (!video.paused) {
            video.pause();
            return;
        }
        if (!video.hasAttribute('src')) {
            video.src = video.dataset.src;
        }
        try {
            await video.play();
        } catch {
            syncVideoControl();
        }
    });
    video.addEventListener('playing', syncVideoControl);
    video.addEventListener('pause', syncVideoControl);
    motion.addEventListener('change', event => {
        if (event.matches) {
            video.pause();
        }
    });
}

const booking = document.querySelector('.d365-booking-form');
if (booking) {
    const session = booking.elements.namedItem('session');
    const service = booking.elements.namedItem('service');
    const date = booking.elements.namedItem('preferred_date');
    function showRequestFields() {
        const scheduled = session.value !== '';
        service.disabled = scheduled;
        service.required = !scheduled;
        date.disabled = scheduled;
    }
    session.addEventListener('change', showRequestFields);
    showRequestFields();
}
