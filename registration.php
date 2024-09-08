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
$highestQualification = $conn->real_escape_string($_POST['highestQualification']);
$email = $conn->real_escape_string($_POST['email']);
$wnumber = $conn->real_escape_string($_POST['wnumber']);
$anumber = $conn->real_escape_string($_POST['anumber']);
$address = $conn->real_escape_string($_POST['address']);
$gender = $conn->real_escape_string($_POST['gender']);

// SQL to insert data
$sql = "INSERT INTO users (full_name, gender, highestQualification, email, wnumber, anumber, address)
VALUES ('$full_name', '$gender', '$highestQualification', '$email', '$wnumber', '$anumber', '$address')";

if ($conn->query($sql) === TRUE) {
    // Redirect to success.html with name in the query string
    header("Location: success.php?name=" . urlencode($full_name));
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
