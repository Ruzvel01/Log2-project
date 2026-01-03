// SIDEBAR TOGGLE
let sidebarOpen = false;
const sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}

document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
    toggle.addEventListener('click', e => {
        e.preventDefault();
        const submenu = toggle.parentElement.querySelector('.sidebar-submenu');

        toggle.classList.toggle('active');
        if (submenu) {
            submenu.style.display =
                submenu.style.display === 'block' ? 'none' : 'block';
        }

        // ✅ realtime breadcrumb for MANAGEMENT / SETTINGS
        const breadcrumb = document.getElementById('breadcrumb');
        if (breadcrumb) {
            breadcrumb.innerHTML = `
                <span>Dashboard</span>
                <span>${toggle.textContent.trim()}</span>
            `;
        }
    });
});



document.addEventListener("DOMContentLoaded", () => {
    const currentUrl = window.location.href;

    document.querySelectorAll('.sidebar-submenu a').forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {

            const submenu = link.closest('.sidebar-submenu');
            const toggle = submenu.previousElementSibling;

            // open submenu
            submenu.style.display = 'block';

            // rotate arrow
            toggle.classList.add('active');

            // optional active style
            link.classList.add('active');
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const breadcrumb = document.getElementById('breadcrumb');
    if (!breadcrumb) return;

    const currentUrl = window.location.href;

    // submenu breadcrumb on page load
    document.querySelectorAll('.sidebar-submenu a').forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {

            const submenu = link.closest('.sidebar-submenu');
            const parentToggle = submenu.previousElementSibling;

            const parentText = parentToggle.textContent.replace(/\s+/g, ' ').trim();
            const itemText = link.textContent.trim();

            breadcrumb.innerHTML = `
                <span>Dashboard</span>
                <span>${parentText}</span>
                <span>${itemText}</span>
            `;
        }
    });

    // fallback main links
    document.querySelectorAll('.sidebar-list-item > a:not(.dropdown-toggle)').forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            breadcrumb.innerHTML = `
                <span>Dashboard</span>
                <span>${link.textContent.trim()}</span>
            `;
        }
    });
});
