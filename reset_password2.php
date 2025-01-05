<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #752626;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #833988, #c94b4b);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #4b134f, #345f73e8); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #752626;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #833988, #c94b4b);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #4b134f, #1e3844); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #fff;
        }
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            padding-right: 40px; /* Add padding to the right to make space for the icon */
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .toggle-password {
            position: absolute;
            top: 70%;

            right: 15px; /* Position the icon 15px to the right */
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            cursor: pointer;
        }
        .warning {
            color: red;
            font-size: 12px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #e83692;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #a36fd6;
        }
    </style>
</head>
<body>

<?php
$otp2 = isset($_GET['otp']) ? htmlspecialchars($_GET['otp']) : '';
?>

<div class="container">
    <h2>Reset Password</h2>
    <form action="reset_password.php" method="post" onsubmit="return validatePassword()">
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" required>
            <img src="resources/view_password.png" class="toggle-password" id="toggle-password" onclick="togglePasswordVisibility('password')" alt="Show">
            <div class="warning" id="p-warn"></div>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" required>
            <img src="resources/view_password.png" class="toggle-password" id="toggle-confirm-password" onclick="togglePasswordVisibility('confirm-password')" alt="Show">
            <div class="warning" id="cp-warn"></div>
        </div>
        <input type="hidden" name="otp" value="<?php echo htmlspecialchars($otp2); ?>">
        <button type="submit" class="btn">Reset Password</button>
    </form>
</div>

<script>
    function validatePassword() {
        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%\^&\*])(?=.{8,})/;
        var password = document.getElementById('password').value;
        if (!passwordPattern.test(password)) {
            document.getElementById('p-warn').innerText = 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
            return false;
        } else {
            document.getElementById('p-warn').innerText = '';
        }

        var confirmPassword = document.getElementById('confirm-password').value;
        if (password !== confirmPassword) {
            document.getElementById('cp-warn').innerText = 'Confirm password does not match.';
            return false;
        } else {
            document.getElementById('cp-warn').innerText = '';
        }

        return true;
    }

    function togglePasswordVisibility(fieldId) {
        var field = document.getElementById(fieldId);
        var icon = document.getElementById('toggle-' + fieldId);
        if (field.type === 'password') {
            field.type = 'text';
            icon.src = 'resources/hide_password.png'; // Change the icon to a hide icon
        } else {
            field.type = 'password';
            icon.src = 'resources/view_password.png'; // Change the icon back to a view icon
        }
    }
</script>

</body>
</html>
