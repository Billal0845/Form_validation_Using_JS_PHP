<?php
include('dabcon.php'); // Assuming db connection script

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$otp = $_POST['otp'];

// Debug output to check the value of $otp
echo "Debug: OTP received is " . $otp . "<br>";

$sql = "SELECT * FROM otp_verification WHERE otp='$otp'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];

    $sql = "UPDATE users SET password='$password' WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        $sql = "DELETE FROM otp_verification WHERE otp='$otp'";
        $conn->query($sql);
        header('Location: index.html');
        exit();
    } else {
        echo "Error updating password: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
