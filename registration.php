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

// SQL to create the table if it does not exist
$tableSql = "CREATE TABLE IF NOT EXISTS registrations (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    gender VARCHAR(50) NOT NULL,
    qualification VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    whatsapp VARCHAR(15) NOT NULL,
    alt_number VARCHAR(15),
    address TEXT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($tableSql)) {
    die("Error creating table: " . $conn->error);
}

// Function to format the name
function formatName($name) {
    return ucwords(strtolower($name));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registrations (full_name, gender, qualification, email, whatsapp, alt_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullName, $gender, $qualification, $email, $whatsapp, $altNumber, $address);

    // Get values from the form
    $fullName = formatName($_POST['fullName']); // Format name
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $email = $_POST['email'];
    $whatsapp = $_POST['whatsapp'];
    $altNumber = $_POST['altNumber'];
    $address = $_POST['address'];

    // Execute the statement
    if ($stmt->execute()) {
        $registrationSuccessful = true; // Flag for success
    } else {
        $errorMessage = "Error: " . $stmt->error; // Store error message
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .form-box, .success-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            transition: transform 0.2s;
        }
        .form-box:hover, .success-box:hover {
            transform: scale(1.02);
        }
        h5 {
            font-weight: bold;
            color: #333;
        }
        .alert {
            margin-top: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .success-box {
            color: #28a745;
        }
        @media (max-width: 768px) {
            body {
                height: auto;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<?php if (isset($registrationSuccessful) && $registrationSuccessful): ?>
    <div class="success-box">
        <h2>Registration Successful!</h2>
        <p>Thank you for registering with us, <strong><?php echo htmlspecialchars($fullName); ?></strong>.</p>
        <p>We look forward to helping you on your journey to mastering English!</p>
        <a href="index.html" class="btn btn-primary">Go to Homepage</a>
    </div>
<?php else: ?>
    <div class="form-box">
        <h5>Registration Form</h5>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label><br>
                <input type="radio" id="male" name="gender" value="Male" required>
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label><br>
                <input type="radio" id="preferNotToSay" name="gender" value="Prefer not to say">
                <label for="preferNotToSay">Prefer not to say</label>
            </div>

            <div class="form-group">
                <label for="qualification">Highest Qualification:</label>
                <input type="text" class="form-control" id="qualification" name="qualification" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="whatsapp">WhatsApp Number:</label>
                <input type="tel" class="form-control" id="whatsapp" name="whatsapp" required>
            </div>

            <div class="form-group">
                <label for="altNumber">Alternate Number:</label>
                <input type="tel" class="form-control" id="altNumber" name="altNumber">
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.5.2.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
