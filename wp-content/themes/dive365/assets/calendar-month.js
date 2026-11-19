const diveCalendar = document.getElementById('calendar');

if (diveCalendar && window.fetch && window.DOMParser && window.history.replaceState) {
    let loadingMonth = false;

    diveCalendar.addEventListener('click', async (event) => {
        if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
        }

        const link = event.target.closest?.('.schedule-grid .month-nav a[href]');
        if (!link || link.origin !== window.location.origin) {
            return;
        }

        const destination = new URL(link.href);
        const month = destination.searchParams.get('dive_month');
        if (!month) {
            return;
        }

        event.preventDefault();
        if (loadingMonth) {
            return;
        }

        loadingMonth = true;
        diveCalendar.setAttribute('aria-busy', 'true');

        try {
            destination.hash = '';
            const response = await fetch(destination, {mode: 'same-origin'});
            if (!response.ok) {
                throw new Error('Could not load the calendar month.');
            }

            const page = new DOMParser().parseFromString(await response.text(), 'text/html');
            const nextGrid = page.querySelector('#calendar .schedule-grid');
            const monthTitle = nextGrid?.querySelector('.month-nav strong');
            if (!monthTitle) {
                throw new Error('Missing calendar month.');
            }

            const activeGrid = link.closest('.schedule-grid');
            const activeElement = document.activeElement;
            const scrollPosition = {left: window.scrollX, top: window.scrollY, behavior: 'instant'};
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('dive_month', month);
            window.history.replaceState(window.history.state, '', currentUrl);
            activeGrid.replaceWith(nextGrid);

            if (activeGrid.contains(activeElement)) {
                const activeLabel = activeElement.getAttribute('aria-label');
                const nextLink = Array.from(nextGrid.querySelectorAll('.month-nav a'))
                    .find((arrow) => arrow.getAttribute('aria-label') === activeLabel);
                monthTitle.tabIndex = -1;
                (nextLink || monthTitle).focus({preventScroll: true});
            }
            if (window.scrollX !== scrollPosition.left || window.scrollY !== scrollPosition.top) {
                window.scrollTo(scrollPosition);
            }
        } catch {
            window.location.assign(link.href);
        } finally {
            loadingMonth = false;
            diveCalendar.removeAttribute('aria-busy');
        }
    });
}
