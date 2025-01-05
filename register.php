<?php
include('dabcon.php'); // Assuming this includes your database connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$created_at = date('Y-m-d H:i:s');

$sql = "INSERT INTO users (name, username, email, password, created_at) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $username, $email, $password, $created_at);

if ($stmt->execute()) {
    header('Location: index.html');
    exit(); // Ensure script execution stops after redirection
} else {
    // Log error or provide user-friendly message
    echo "Error: " . $sql . "<br>" . $stmt->error;
}

$stmt->close();
$conn->close();
?>
