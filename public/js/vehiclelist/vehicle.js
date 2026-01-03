function closeAlert() {
    const alert = document.getElementById('successAlert');
    if (alert) {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    }
}

// auto remove after 3 seconds
setTimeout(() => {
    closeAlert();
}, 3000);