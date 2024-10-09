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

  <title>Student Login - Ascend Journey</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

  <style>


@media (min-width: 990px) {
  .hero_area {
	height: 65px;

}
  }

  .hero_area {

	margin-bottom: 60px;
}

.unique-login-wrapper {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in;
        }

        h2 {
            text-align: center;
            color: #28a745; /* Green color */
            margin-bottom: 20px;
            animation: slideInDown 0.5s ease-in-out;
        }

        .unique-form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border: 1px solid #28a745; /* Green border on focus */
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745; /* Green background */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            
        }

        button:hover {
            background-color: #218838; /* Darker green on hover */
            transform: translateY(-2px); /* Lift effect on hover */
        }

        .unique-error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 15px;
            animation: shake 0.5s;
        }

        .unique-student-info {
            background-color: #e9f7ef;
            border: 1px solid #c3e6cb;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes slideInDown {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
  </style>
</head>

<body>








  <div class="hero_area">
    <!-- header section strats -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" >Ascend Journey</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="index.html"> Home<span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="courses.html">Courses </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login  </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html"> About</a>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link " data-toggle="modal" data-target="#registrationModal">
                Register Now
            </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end header section -->

  </div>


<!-- Modal Structure -->
<div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrationModalLabel">Registration Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="registration.php" method="POST">
          <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
          </div>

          <div class="form-group">
            <label for="gender">Gender:</label><br>
            <input type="radio" id="male" name="gender" value="Male">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="unique-login-wrapper">
        <h2>Student Login</h2>
        
        <?php if (!empty($error)): ?>
            <div class="unique-error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <div class="unique-form-group">
                <label for="login_id">Login ID:</label>
                <input type="text" id="login_id" name="login_id" required>
            </div>
            <div class="unique-form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="unique-form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        
        <!-- Show student details if available -->
        <?php if ($studentDetails): ?>
            <div class="unique-student-info">
                <?php echo $studentDetails; ?>
            </div>
        <?php endif; ?>
    </div>










    
  <footer class="footer_section py-3 my-4">
    <div class="container">
        <!-- Logo -->
        <div class="text-center mb-3">
            <a class="navbar-brand" href="index.html">
                <span class="logo-text">Ascend Journey</span>
            </a>
        </div>
        
        <!-- Navigation Links -->
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="index.html" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="courses.html" class="nav-link px-2 text-body-secondary">Courses</a></li>
            <li class="nav-item"><a href="about.html" class="nav-link px-2 text-body-secondary">About</a></li>
            <li class="nav-item"><a href="team.php" class="nav-link px-2 text-body-secondary">Team</a></li>
           
        </ul>

        <!-- Contact Information -->
        <div class="text-center">
            <h6>Contact Information</h6>
            <p class="text-body-secondary">Azmi Khan</p>
            <p class="text-body-secondary">CEO and Director of Ascend Journey</p>
            <p class="text-body-secondary">8878676404</p>
            <p class="text-body-secondary">Mohammed8azmi@gmail.com</p>
        </div>

        <!-- LinkedIn Icon -->
        <div class="text-center mb-3">
            <a href="#"><img src="images/linkedin.png" alt="LinkedIn" class="social-icon"></a>
        </div>

        <!-- Google Map -->
        <div class="map-container mb-3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3655.4872343082757!2d78.57644647398439!3d23.62271589366878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x397ed6a7b663de4f%3A0xb2a2de82ac4ad928!2sGyanveer%20College!5e0!3m2!1sen!2sin!4v1727889725367!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <!-- Copyright Notice -->
        <p class="text-center text-body-secondary">© 2024 Ascend Journey | All Rights Reserved</p>
    </div>
</footer>


  


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</body>

</html>