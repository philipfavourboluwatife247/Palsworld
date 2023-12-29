document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // You can add your authentication logic here
    // For simplicity, let's just show an alert for successful login
    alert('Login successful! Redirecting to your profile.');
    
    // You can also redirect the user to their profile page
    // window.location.href = 'profile.html';
});

