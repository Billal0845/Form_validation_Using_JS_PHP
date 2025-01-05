<?php
include('dabcon.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$message = 'Invalid username or Password';
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Redirect to dashboard with query parameters
        header("Location: dashboard.php?name=" . urlencode($row['name']) . "&username=" . urlencode($row['username']) . "&email=" . urlencode($row['email']) . "&created_at=" . urlencode($row['created_at']));
        exit(); 
    } else {
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('$message');</script>";
}

$conn->close();
?>
