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
    const breadcrumb = document.getElementById('breadcrumb');

    // 1. Awtomatikong buksan ang Sidebar Dropdown base sa URL
    document.querySelectorAll('.sidebar-submenu a').forEach(link => {
        if (currentUrl.includes(link.getAttribute('href'))) {
            const submenu = link.closest('.sidebar-submenu');
            const parentToggle = submenu.previousElementSibling;

            // Panatilihing nakabukas ang menu
            submenu.style.display = 'block';
            parentToggle.classList.add('active');
            link.classList.add('active'); // highlight ang current page link

            // 2. Ayusin ang Breadcrumbs base sa active link
            if (breadcrumb) {
                const parentText = parentToggle.textContent.trim();
                const itemText = link.textContent.trim();
                breadcrumb.innerHTML = `
                    <span>Dashboard</span>
                    <i class='bx bx-chevron-right'></i>
                    <span>${parentText}</span>
                    <i class='bx bx-chevron-right'></i>
                    <span>${itemText}</span>
                `;
            }
        }
    });

    // 3. Siguraduhin na ang Filter form ay nagpapasa ng tab preference (Optional)
    // Para mas accurate, pwede mong dagdagan ng hidden input ang filter form mo:
    // <input type="hidden" name="active_tab" value="requests">
});