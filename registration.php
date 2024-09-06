<?php
// Database connection variables
$servername = "localhost";  // Change if needed
$username = "root";  // Your database username
$password = "1913";  // Your database password
$dbname = "website";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Capture form data and prevent SQL injection
$full_name = $conn->real_escape_string($_POST['full_name']);
$user_name = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
$confirm_password = $_POST['confirm_password'];
$gender = $conn->real_escape_string($_POST['gender']);

// Ensure passwords match
if ($_POST['password'] !== $confirm_password) {
  echo "Passwords do not match!";
  exit();
}

// SQL to insert data
$sql = "INSERT INTO users (full_name, username, email, phone, password, gender)
VALUES ('$full_name', '$user_name', '$email', '$phone', '$password', '$gender')";

if ($conn->query($sql) === TRUE) {
  echo "Registration successful!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
