<?php
// dekhe dekhe sekhar jonoo eta
include("dbcon.php");
$msg = "";
$html = "test";
include('smtp/PHPMailerAutoload.php'); // Include PHPMailer here

function smtp_mailer($to, $subject, $msg)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // Correct the variable name
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = "yourEmail";
    $mail->Password = "abcdefghij"; //password of gmail after app password or two factor is on
    $mail->SetFrom("YourEmail0845@gmail.com"); // from which email the mail should go
    $mail->addAddress($to); // Use the correct recipient email
    $mail->IsHTML(true);
    $mail->Charset = 'UTF-8';
    $mail->Subject = $subject;
    $mail->Body = $msg; // Use the correct message content
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false, // Correct the option name
            'verify_peer_name' => false, // Correct the option name
            'allow_self_signed' => true // Set to true if using self-signed certificate
        )
    );

    if (!$mail->send()) {
        return $mail->ErrorInfo;
    } else {
        return 'Email is sent successfully';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Sanitize user inputs
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $checknumOfRows = mysqli_num_rows(mysqli_query($con, "select * from users where email='$email'"));
    if ($checknumOfRows > 0) {
        $msg = "Email already exists";
    } else {
        // Insert data into the database
        mysqli_query($con, "INSERT INTO users (name, email, password, verification_status) VALUES ('$name', '$email', '$password', 0)");

        $msg = "We are sending an email verification link to $email </br> </br>";
        $html = "Daducoding Daducoding!";

        echo smtp_mailer($email, 'Test Subject', $html); // Call the email function with the correct parameters
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        /* Add your CSS styling here */
        body {
            color: #fff;
            background: #63738a;
            font-family: 'Roboto', sans-serif;
        }

        .form-control {
            height: 40px;
            box-shadow: none;
            color: #969fa4;
        }

        .form-control:focus {
            border-color: #5cb85c;
        }

        .form-control,
        .btn {
            border-radius: 3px;
        }

        .signup-form {
            width: 450px;
            margin: 0 auto;
            padding: 30px 0;
            font-size: 15px;
        }

        .signup-form h2 {
            color: #636363;
            margin: 0 0 15px;
            position: relative;
            text-align: center;
        }

        .signup-form h2:before,
        .signup-form h2:after {
            content: "";
            height: 2px;
            width: 30%;
            background: #d4d4d4;
            position: absolute;
            top: 50%;
            z-index: 2;
        }

        .signup-form h2:before {
            left: 0;
        }

        .signup-form h2:after {
            right: 0;
        }

        .signup-form .hint-text {
            color: #999;
            margin-bottom: 30px;
            text-align: center;
        }

        .signup-form form {
            color: #999;
            border-radius: 3px;
            margin-bottom: 15px;
            background: #f2f3f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .signup-form .form-group {
            margin-bottom: 20px;
        }

        .signup-form input[type="checkbox"] {
            margin-top: 3px;
        }

        .signup-form .btn {
            font-size: 16px;
            font-weight: bold;
            min-width: 140px;
            outline: none !important;
        }

        .signup-form .row div:first-child {
            padding-right: 10px;
        }

        .signup-form .row div:last-child {
            padding-left: 10px;
        }

        .signup-form a {
            color: #fff;
            text-decoration: underline;
        }

        .signup-form a:hover {
            text-decoration: none;
        }

        .signup-form form a {
            color: #5cb85c;
            text-decoration: none;
        }

        .signup-form form a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="signup-form">
        <form method="post">
            <h2>Register</h2>
            <p class="hint-text">Create your account. It's free and only takes a minute.</p>
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" id="email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" id="password"
                    required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Register Now</button>
            </div>
            <div>
                <?php
                echo $msg;
                ?>
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
    </div>
</body>

</html>