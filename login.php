<?php
// Database configuration
$servername = "localhost"; // Your server name
$username = "root";        // Your database username
$password = "1913";       // Your database password
$dbname = "english";      // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error = "";
$studentDetails = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $login_id = trim($_POST['login_id']);
    $password = trim($_POST['password']);
    
    // Validate input
    if (empty($login_id) || empty($password)) {
        $error = "Login ID and password cannot be empty.";
    } else {
        // Prepare and bind the statement
        $stmt = $conn->prepare("SELECT * FROM user_data WHERE login_id = ?");
        $stmt->bind_param("s", $login_id);
        
        // Execute the statement
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if the user exists
        if ($result->num_rows == 1) {
            // Fetch the user data
            $row = $result->fetch_assoc();
            
            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Prepare student details for display
                $email = isset($row['email']) ? htmlspecialchars($row['email']) : 'N/A';
                $additional_info = isset($row['additional_info']) ? htmlspecialchars($row['additional_info']) : 'N/A';

                $studentDetails = "
                    <div class='student-info'>
                        <p><strong>Login ID:</strong> " . htmlspecialchars($row['login_id']) . "</p>
                        <p><strong>Email:</strong> $email</p>
                        <p><strong>Additional Info:</strong> $additional_info</p>
                    </div>";
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "No user found with this Login ID.";
        }
        
        // Close the statement
        $stmt->close();
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 90%;
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px 0px #aaa;
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .error {
            color: red;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .student-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9f7ef;
            border: 1px solid #b2ebf2;
            border-radius: 8px;
            animation: fadeIn 1s;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* Responsive styling */
        @media (max-width: 600px) {
            .container {
                width: 95%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Login</h2>
    
    <?php if (!empty($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="login_id">Login ID:</label>
            <input type="text" id="login_id" name="login_id" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
    
    <!-- Show student details if available -->
    <?php if ($studentDetails): ?>
        <div class="student-info">
            <?php echo $studentDetails; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
