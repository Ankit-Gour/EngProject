<?php
// Database configuration
$servername = "localhost"; // Your server name
$username = "root";        // Your database username
$password = "1913";        // Your database password
$dbname = "english"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create table if it doesn't exist
$table_sql = "
CREATE TABLE IF NOT EXISTS user_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    login_id VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address TEXT,
    additional_info TEXT,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($table_sql);

// Check if the form is submitted to add a new record
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_acknowledgement'])) {
    // Get user input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $login_id = trim($_POST['login_id']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $additional_info = trim($_POST['additional_info']);

    // Basic validation
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($login_id) || empty($password)) {
        $error = "Please fill in all fields correctly.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO user_data (name, email, login_id, password, address, additional_info) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $login_id, $hashed_password, $address, $additional_info);

        // Execute the statement
        if ($stmt->execute()) {
            $success = "Acknowledgement generated successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);

    // Prepare delete statement
    $delete_stmt = $conn->prepare("DELETE FROM user_data WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);

    // Execute the delete query
    if ($delete_stmt->execute()) {
        $success = "Acknowledgement deleted successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }

    // Close the delete statement
    $delete_stmt->close();
}

// Fetch all generated acknowledgements
$acknowledgements_sql = "SELECT * FROM user_data ORDER BY registered_at DESC";
$acknowledgements_result = $conn->query($acknowledgements_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Acknowledgement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f8;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            margin-bottom: 10px;
        }
        .acknowledgement-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            color: red;
            border: none;
            background: transparent;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Generate Acknowledgement</h2>
    
    <?php if (!empty($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (!empty($success)): ?>
        <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="login_id">Login ID:</label>
            <input type="text" class="form-control" id="login_id" name="login_id" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="additional_info">Additional Information:</label>
            <textarea class="form-control" id="additional_info" name="additional_info" rows="3"></textarea>
        </div>
        <button type="submit" name="add_acknowledgement" class="btn btn-primary">Acknowledge</button>
    </form>

    <h2 class="mt-4">Generated Acknowledgements</h2>
    
    <?php if ($acknowledgements_result->num_rows > 0): ?>
        <?php while ($row = $acknowledgements_result->fetch_assoc()): ?>
            <div class="acknowledgement-card">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <p><strong>Login ID:</strong> <?php echo htmlspecialchars($row['login_id']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                <p><strong>Additional Information:</strong> <?php echo htmlspecialchars($row['additional_info']); ?></p>
                <p><strong>Registered At:</strong> <?php echo htmlspecialchars($row['registered_at']); ?></p>
                
               <!-- Delete button -->
<form action="" method="POST" style="display:inline;">
    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
    <button type="submit" class="delete-btn" title="Delete">
        <i class="fas fa-trash-alt"></i> <!-- Font Awesome trash icon -->
    </button>
</form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No acknowledgements generated yet.</p>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
