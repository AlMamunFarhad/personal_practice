const themeToggle = document.querySelector('[data-theme-toggle]');

const updateThemeControl = (isDark) => {
    if (!themeToggle) {
        return;
    }

    const label = `Switch to ${isDark ? 'light' : 'dark'} mode`;

    themeToggle.setAttribute('aria-label', label);
    themeToggle.setAttribute('aria-pressed', String(isDark));
    themeToggle.setAttribute('title', label);
    document.querySelector('meta[name="theme-color"]')?.setAttribute('content', isDark ? '#0b1120' : '#111a2e');
};

updateThemeControl(document.documentElement.classList.contains('dark'));

themeToggle?.addEventListener('click', () => {
    const isDark = !document.documentElement.classList.contains('dark');
    const theme = isDark ? 'dark' : 'light';

    document.documentElement.classList.toggle('dark', isDark);
    document.documentElement.style.colorScheme = theme;
    localStorage.setItem('northstar-theme', theme);
    updateThemeControl(isDark);
});

const sidebar = document.querySelector('[data-sidebar]');
const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
const sidebarOverlay = document.querySelector('[data-sidebar-overlay]');

const setSidebarOpen = (isOpen) => {
    if (!sidebar || !sidebarToggle || !sidebarOverlay) {
        return;
    }

    sidebar.classList.toggle('-translate-x-full', !isOpen);
    sidebarOverlay.classList.toggle('hidden', !isOpen);
    sidebarToggle.setAttribute('aria-expanded', String(isOpen));
    document.body.classList.toggle('overflow-hidden', isOpen);
};

sidebarToggle?.addEventListener('click', () => {
    setSidebarOpen(sidebarToggle.getAttribute('aria-expanded') !== 'true');
});

sidebarOverlay?.addEventListener('click', () => setSidebarOpen(false));

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        setSidebarOpen(false);
    }
});

const notificationToggle = document.querySelector('[data-notification-toggle]');
const notificationPanel = document.querySelector('[data-notification-panel]');

notificationToggle?.addEventListener('click', () => {
    const isOpen = notificationToggle.getAttribute('aria-expanded') !== 'true';

    notificationToggle.setAttribute('aria-expanded', String(isOpen));
    notificationPanel?.classList.toggle('hidden', !isOpen);
});

document.addEventListener('click', (event) => {
    if (!(event.target instanceof Element) || event.target.closest('[data-notification-toggle], [data-notification-panel]')) {
        return;
    }

    notificationToggle?.setAttribute('aria-expanded', 'false');
    notificationPanel?.classList.add('hidden');
});

const orderSearch = document.querySelector('[data-order-search]');

orderSearch?.addEventListener('input', () => {
    const query = orderSearch.value.trim().toLocaleLowerCase();
    const rows = [...document.querySelectorAll('[data-order-row]')];
    let visibleRows = 0;

    rows.forEach((row) => {
        const matches = row.textContent?.toLocaleLowerCase().includes(query) ?? false;

        row.classList.toggle('hidden', !matches);
        visibleRows += Number(matches);
    });

    document.querySelector('[data-order-empty]')?.classList.toggle('hidden', visibleRows > 0);

    const count = document.querySelector('[data-order-count]');

    if (count) {
        count.textContent = String(visibleRows);
    }
});
