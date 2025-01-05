<?php
include('dabcon.php');
include('smtp/PHPMailerAutoload.php'); // Include PHPMailer here

// Set the PHP timezone
date_default_timezone_set('Asia/Dhaka');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $otp = rand(100000, 999999);
    $expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));
    $created_at = date('Y-m-d H:i:s'); // Get the current time

    // Use prepared statement for inserting OTP
    $stmt = $conn->prepare("INSERT INTO otp_verification (email, otp, expiry, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $otp, $expiry, $created_at);

    if ($stmt->execute() === TRUE) {
        $subject = "OTP Verification";
        $msg = "Hi there! Your OTP is here from DaduCoding for your password recovery: $otp";

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->SMTPSecure = "tls";
            $mail->SMTPAuth = true;
            $mail->Username = "billalhosen0845@gmail.com";   
            $mail->Password = "qldqylbvsdoufkkb"; // Use your app-specific password
            $mail->setFrom("billalhosen0845@gmail.com");
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Charset = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body = $msg;
            $mail->SMTPOptions = array('ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ));

            $mail->send();
            header('Location: otp_verification.html');
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "No account found with this email.";
}

$stmt->close();
$conn->close();
?>
