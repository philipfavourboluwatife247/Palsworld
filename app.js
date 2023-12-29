// Add smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Text animation on scroll
document.addEventListener('scroll', function () {
    const heroText = document.querySelector('.hero h1');
    const heroPosition = heroText.getBoundingClientRect().top;

    if (heroPosition < window.innerHeight / 1.5) {
        heroText.classList.add('animate');
    }
});

// Add an event listener to toggle the mobile menu
document.querySelector('.menu-icon').addEventListener('click', function () {
    const mobileNav = document.querySelector('.mobile-nav');
    mobileNav.style.display = (mobileNav.style.display === 'block') ? 'none' : 'block';
});

// Optional: Close the mobile menu when a link is clicked
document.querySelectorAll('.mobile-nav a').forEach(link => {
    link.addEventListener('click', function () {
        document.querySelector('.mobile-nav').style.display = 'none';
    });
});


// Add an event listener to toggle the mobile menu
document.querySelector('.mobile-menu-icon').addEventListener('click', function () {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.classList.toggle('show');
});



