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
    const currentUrl = window.location.href;

    // Update page header and active links
    document.querySelectorAll('.sidebar-list a, .sidebar-submenu a').forEach(link => {
        const href = link.getAttribute('href');

        if (currentUrl.includes(href)) {
            link.classList.add('active');

            // Open parent submenu if exists
            const submenu = link.closest('.sidebar-submenu');
            if (submenu) {
                submenu.style.display = 'block';
                const parentToggle = submenu.previousElementSibling;
                parentToggle.classList.add('active');
            }

            // Update page header
            const pageTitle = document.getElementById('pageTitle');
            const pageSubtitle = document.getElementById('pageSubtitle');

            if (pageTitle && pageSubtitle) {
                const title = link.dataset.title || link.textContent.trim();
                const subtitle = link.dataset.subtitle || `Manage ${title.toLowerCase()}`;

                pageTitle.textContent = title;
                pageSubtitle.textContent = subtitle;
            }
        }
    });
});




function initMap(id) {
    const map = new google.maps.Map(document.getElementById('map'+id), {
        zoom: 10,
        center: { lat: 14.5995, lng: 120.9842 }
    });

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);

    // call directionsService.route(...)
}


