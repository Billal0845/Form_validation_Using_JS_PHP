<?php
include('dabcon.php'); // Assuming db connection script

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current time from the database
$sql = "SELECT CURRENT_TIMESTAMP AS current_db_time";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("SQL Error: " . $conn->error . "<br>Check your SQL syntax or MariaDB version compatibility.");
}

$current_time_row = $result->fetch_assoc();
$current_time = $current_time_row["current_db_time"];

echo "POST Data:<br>";
print_r($_POST); // Debugging output

if (!isset($_POST['otp'])) {
    die("OTP not provided.<br>");
}

$otp = $_POST['otp'];

// Adjust time difference if necessary
$current_time_server = new DateTime($current_time);
$current_time_local = new DateTime();
$time_diff = $current_time_server->getTimestamp() - $current_time_local->getTimestamp();
$expiry_adjusted = date('Y-m-d H:i:s', strtotime('+5 minutes') - $time_diff);

// Use prepared statement to check OTP validity with adjusted expiry
$stmt = $conn->prepare("SELECT * FROM otp_verification WHERE otp = ? AND expiry > ?");
if (!$stmt) {
    die("Error in statement preparation: " . $conn->error);
}
$stmt->bind_param("is", $otp, $expiry_adjusted);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Redirect to reset_password.html with OTP as a URL parameter
    header('Location: reset_password2.php?otp=' . urlencode($otp));
    exit();
} else {
    // Invalid or expired OTP
    echo "Invalid or expired OTP.<br>";
    echo "Current time (Server): $current_time<br>";
    echo "Current time (Local): " . $current_time_local->format('Y-m-d H:i:s') . "<br>";
    echo "Adjusted Expiry Time: $expiry_adjusted<br>";
}

$stmt->close();
$conn->close();
?>
