document.addEventListener('DOMContentLoaded', function () {
    // Check if the user is considered logged in
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

    if (isLoggedIn) {
        // Redirect to homepage.php if logged in and on indexpage
        const path = window.location.pathname;
        if (path.endsWith('indexpage.php') || path.endsWith('/') || path.endsWith('Page1.php')) {
            window.location.href = 'homepage.php';
        }

        // Change Home links to homepage.php
        const homeLinks = document.querySelectorAll('a[href="indexpage.php"]');
        homeLinks.forEach(link => {
            link.href = 'homepage.php';
        });

        const registerLinks = document.querySelectorAll('a[href="Page4.php"]');
        registerLinks.forEach(link => {
            // Find the parent <li> or <button> and hide it, or just hide the link
            if (link.parentElement && link.parentElement.tagName.toLowerCase() === 'li') {
                link.parentElement.style.display = 'none';
            } else if (link.parentElement && link.parentElement.tagName.toLowerCase() === 'button') {
                link.parentElement.style.display = 'none';
            } else {
                link.style.display = 'none';
            }
        });

        // Change "Login" links (Page7.php) to "Logout"
        const loginLinks = document.querySelectorAll('a[href="Page7.php"]');
        loginLinks.forEach(link => {
            link.textContent = 'Logout';
            link.href = '#';
            link.addEventListener('click', function (e) {
                e.preventDefault();
                localStorage.removeItem('isLoggedIn');
                alert('You have been logged out.');
                window.location.href = 'indexpage.php'; // Redirect to indexpage.php
            });
        });
    } else {
        // Redirect to indexpage.php if not logged in and on homepage
        const path = window.location.pathname;
        if (path.endsWith('homepage.php')) {
            window.location.href = 'indexpage.php';
        }
    }
});
