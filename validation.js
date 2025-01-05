function validateForm() {
    var namePattern = /^[A-Za-z\s.'-]+$/;
    var name = document.getElementById('name').value;
    if (!namePattern.test(name)) {
        alert('Please enter a valid name.');
        return false;
    }

    var usernamePattern = /\s/;
    var username = document.getElementById('username').value;
    if (usernamePattern.test(username)) {
        alert('Whitespace is not allowed in username.');
        return false;
    }

    var emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    var email = document.getElementById('email').value;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email.');
        return false;
    }

    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%\^&\*])(?=.{8,})/;
    var password = document.getElementById('password').value;
    if (!passwordPattern.test(password)) {
        alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.');
        return false;
    }

    var confirmPassword = document.getElementById('confirm-password').value;
    if (password !== confirmPassword) {
        alert('Confirm password does not match.');
        return false;
    }

    return true;
}

function validatePassword() {
    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%\^&\*])(?=.{8,})/;
    var password = document.getElementById('password').value;
    if (!passwordPattern.test(password)) {
        alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.');
        return false;
    }

    var confirmPassword = document.getElementById('confirm-password').value;
    if (password !== confirmPassword) {
        alert('Confirm password does not match.');
        return false;
    }

    return true;
}
