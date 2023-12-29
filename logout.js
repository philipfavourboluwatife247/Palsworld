document.addEventListener('DOMContentLoaded', function() {
    // Assuming you have a logout button with the id 'logoutButton'
    const logoutButton = document.getElementById('logoutButton');

    if (logoutButton) {
        logoutButton.addEventListener('click', function() {
            // Perform any client-side cleanup if needed

            // Redirect to the logout page or your landing page
alert('Logout successful! Redirecting to the homepage.');
    // window.location.href = 'profile.html';
});

