document.getElementById('forgotPasswordForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // You can add your forgot password logic here
    // For simplicity, let's just show an alert for password reset
    alert('Password reset link sent to your email. Check your inbox.');
    
    // You can also redirect the user to a confirmation page or back to login
    // window.location.href = 'login.html';
});

