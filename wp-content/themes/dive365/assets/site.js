const hero = document.querySelector('.hero');
const motion = window.matchMedia('(prefers-reduced-motion: reduce)');

if (hero) {
    const video = hero.querySelector('.hero-video');
    let photoTimer;
    let videoTimer;
    let started = false;
    let inView = !('IntersectionObserver' in window);

    function showPhoto() {
        window.clearTimeout(videoTimer);
        video.pause();
        hero.classList.remove('is-playing');
    }

    function canAutoplay() {
        return inView && !document.hidden && !motion.matches;
    }

    async function playVideo() {
        if (started || !canAutoplay()) {
            return;
        }
        started = true;
        video.src = video.dataset.src;
        try {
            await video.play();
        } catch {
            return;
        }
        if (!video.paused && canAutoplay()) {
            hero.classList.add('is-playing');
            videoTimer = window.setTimeout(showPhoto, 4800);
        }
    }

    function updateAutoplay() {
        window.clearTimeout(photoTimer);
        if (!canAutoplay()) {
            showPhoto();
        } else if (!started) {
            photoTimer = window.setTimeout(playVideo, 6000);
        }
    }

    video.addEventListener('ended', showPhoto);
    motion.addEventListener('change', updateAutoplay);
    document.addEventListener('visibilitychange', updateAutoplay);
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(([entry]) => {
            inView = entry.isIntersecting;
            updateAutoplay();
        });
        observer.observe(hero);
    } else {
        updateAutoplay();
    }
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
