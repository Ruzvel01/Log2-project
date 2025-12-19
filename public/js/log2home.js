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
// Select all dropdown toggles
const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

dropdownToggles.forEach(toggle => {
  toggle.addEventListener('click', (e) => {
    e.preventDefault();

    const submenu = toggle.nextElementSibling;
    const arrow = toggle.querySelector('.arrow');

    // Toggle submenu visibility
    if (submenu.style.display === 'block') {
      submenu.style.display = 'none';
      toggle.classList.remove('active');
    } else {
      submenu.style.display = 'block';
      toggle.classList.add('active');
    }
  });
});


document.addEventListener("DOMContentLoaded", () => {
    const toasts = document.querySelectorAll('.toast');

    toasts.forEach(toast => {
        // Add 'show' to slide down
        toast.classList.add('show');

        // Remove 'show' and add 'hide' after 3 seconds to slide up
        setTimeout(() => {
            toast.classList.remove('show');
            toast.classList.add('hide');
        }, 3000);
    });
});
