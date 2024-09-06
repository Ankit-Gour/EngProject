<?php
// Database configuration
$host = 'localhost';
$dbname = 'website';  // Update with your database name
$username = 'root';  // Update with your MySQL username
$password = '1913';  // Update with your MySQL password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Collect form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email is already registered
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        if ($stmt->rowCount() > 0) {
            die('Email is already registered.');
        }

        // Insert new user into the database
        $stmt = $pdo->prepare('INSERT INTO users (full_name, email, password) VALUES (:name, :email, :password)');
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashed_password
        ]);

        echo 'Signup successful! You can now login.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
