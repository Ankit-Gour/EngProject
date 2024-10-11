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

  <title>Generate Acknowledgement</title>
  <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>
    <style>
        body {
            background-color: #f3bebe;
        }

        .hero_area {
            height: 80px;}
            
            
            
            .container-alag {
	margin-top: 50px;
	max-width: 600px;
	padding: 20px;
	background: #f3bebe;
	border-radius: 10px;
	box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
	margin: 54px auto;
	padding: 27px;
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
            background-color: #ab8f8f52;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        #deleteicon {
	width: 32px;
	margin: 3px auto;
	/* padding: 10px; */
}
        #deleteicon img{
width: 100%;
height:100%;
border-radius:5px;
        }
    </style>
</head>
<body>



<div class="hero_area">
    <!-- header section strats -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html" >
          <div id="logo">
            <img src="images/logo.jpg">
          </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="index.html">Home <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login  </a>
              </li>
              <a class="nav-link" href="courses.html">Courses </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html"> About Us</a>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link " data-toggle="modal" data-target="#registrationModal">
                Register Now
            </button>
            </li>
          </ul>
        </div>
      </div>
    </nav></div>

<div class="container-alag">
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
        <button type="submit" name="add_acknowledgement" class="btn register-btn">Acknowledge</button>
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
    <button type="submit" title="Delete">
      <div id="deleteicon"><img src="images/delete.png"></div>
    </button>
</form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No acknowledgements generated yet.</p>
    <?php endif; ?>
</div>



<footer class="footer_section py-3 my-4">
    <div class="container">
        <!-- Logo -->
        <div class="text-center mb-3">
          <a class="navbar-brand" href="index.html" >
            <div id="logo">
              <img src="images/logo.jpg">
            </div>
          </a>
        </div>
        
        <!-- Navigation Links -->
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="index.html" class="nav-link ">Home</a></li>
            <li class="nav-item"><a href="courses.html" class="nav-link ">Courses</a></li>
            <li class="nav-item"><a href="about.html" class="nav-link ">About</a></li>
            <li class="nav-item"><a href="team.php" class="nav-link ">Team</a></li>
           
        </ul>

        <!-- Contact Information -->
        <div class="text-center">
          <h6 id="contact-info">Contact Information</h6>
            <p class="">Azmi Khan</p>
            <p class="">CEO and Director of Ascend Journey</p>
            <p class="clickable"><a href="tel:8878676404">8878676404</a></p>
            <p class="clickable"><a href="mailto:Mohammed8azmi@gmail.com">Mohammed8azmi@gmail.com</a></p>
            
        </div>

        <!-- LinkedIn Icon -->
        <div class="text-center mb-3">
            <a href="https://www.linkedin.com/in/azmi-khan-2a1778197/"><img src="images/linkedin.png" alt="LinkedIn" class="social-icon"></a>
        </div>

        <!-- Google Map -->
        <div class="map-container mb-3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3655.4872343082757!2d78.57644647398439!3d23.62271589366878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397ed6a7b663de4f%3A0xb2a2de82ac4ad928!2sGyanveer%20College!5e0!3m2!1sen!2sin!4v1727889725367!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <!-- Copyright Notice -->
        <p class="text-center"> 
          © 2024 Ascend Journey | All Rights Reserved | Site developed by 
          <a href="https://www.linkedin.com/in/ankit-gour-0a00ab259" target="_blank" style="text-decoration: none;">Ankit Gour</a> 
        
        </p>
        
    </div>
</footer>

<script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
