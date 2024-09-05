<?php
session_start();

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
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare SQL query to fetch the user
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);  // Correct binding here
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            echo "Login successful! Welcome, " . $_SESSION['user_name'];
        } else {
            echo 'Invalid email or password.';
        }
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
