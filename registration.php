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
    // Get values from the form
    $fullName = formatName($_POST['fullName']); // Format name
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $email = $_POST['email'];
    $whatsapp = $_POST['whatsapp'];
    $altNumber = $_POST['altNumber'];
    $address = $_POST['address'];

    // Check if email already exists
    $emailCheckSql = "SELECT * FROM registrations WHERE email = ?";
    $stmt = $conn->prepare($emailCheckSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        $errorMessage = "This email is already registered. Please use a different email.";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO registrations (full_name, gender, qualification, email, whatsapp, alt_number, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fullName, $gender, $qualification, $email, $whatsapp, $altNumber, $address);

        // Execute the statement
        if ($stmt->execute()) {
            $registrationSuccessful = true; // Flag for success
        } else {
            $errorMessage = "Error: " . $stmt->error; // Store error message
        }
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Ascend journey - Registration</title>
  <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32">
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
     body {
        background-color:#d58e8e;
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
    .form-box {
	background: #987e7e;
	padding: 30px;
	border-radius: 15px;
	box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
	width: 90%;
	max-width: 500px;
	transition: transform 0.2s;
}
    .form-box:hover {
        transform: scale(1.02);
    }
    h5 {
        font-weight: bold;
        color: #333;
    }
    .alert {
	margin-top: 15px;
	/* background: ; */
	color: #000;
	padding: 10px;
	border-radius: 5px;
}
    .success-box {
        color: #fff;
        background: linear-gradient(135deg, #6d9dc5, #f09f6d); /* Popsicle Gradient */
        padding: 15px;
        border-radius: 15px;
        margin-top: 20px;
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
            <div class="alert alert-danger">
                <?php echo $errorMessage; ?>
               
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            
        
            <button type="submit" class="btn register-btn"><a href="index.html" style="margin-top: 15px;">Back to Homepage</a></button>
        </form>
    </div>
<?php endif; ?>


<script src="https://code.jquery.com/jquery-3.5.2.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
