const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

registerBtn.addEventListener('click',()=> {
       container.classList.add('active');
} );

loginBtn.addEventListener('click',()=> {
       container.classList.remove('active');
} );
document.addEventListener("DOMContentLoaded", () => {
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(toast => {
        // Slide down
        toast.classList.add('show');

        // Slide back up after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            toast.classList.add('hide');
        }, 3000);
    });
});
