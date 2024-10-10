<?php
// Database configuration
$servername = "localhost"; // Your server name
$username = "root";        // Your database username
$password = "1913";        // Your database password
$dbname = "english";       // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching student data from the registrations table sorted by registered_at in descending order
$sql = "SELECT * FROM registrations ORDER BY registered_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registrations</title>
    
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
          background-color: #ffc5c5;
        }
        .container {
            margin-top: 30px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .student-card {
            background: #ab919185;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            animation: slideUp 0.5s ease-in-out;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .student-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }
        .student-card h5 {
	color: #000;
	margin-bottom: 10px;
	display: flex;
	justify-content: center;
}
        .student-card p {
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
        }
        .no-underline {
            text-decoration: none;
            color: inherit;
        }
        .no-underline:hover {
            color: #007bff;
        }
        /* Animation keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        /* Responsive styles */
        @media (max-width: 768px) {
            .student-card {
                max-width: 100%;
            }
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
    </nav>

</div>



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

          <button type="submit" class="btn register-btn">Register</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn register-btn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- leads -->
 
<div class="container">
    <h2>Student Registrations</h2>

    <!-- Card layout for all screens -->
    <div class="card-container">
        <?php
        if ($result->num_rows > 0) {
            // Output data for each row as a card
            while ($row = $result->fetch_assoc()) {
                echo "<div class='student-card'>
                        <h5>" . htmlspecialchars($row['full_name']) . "</h5>
                        <p><strong>ID:</strong> " . htmlspecialchars($row['id']) . "</p>
                        <p><strong>Gender:</strong> " . htmlspecialchars($row['gender']) . "</p>
                        <p><strong>Qualification:</strong> " . htmlspecialchars($row['qualification']) . "</p>
                        <p><strong>Email:</strong> <a href='mailto:" . htmlspecialchars($row['email']) . "' class='no-underline'>" . htmlspecialchars($row['email']) . "</a></p>
                        <p><strong>WhatsApp Number:</strong> <a href='tel:" . htmlspecialchars($row['whatsapp']) . "' class='no-underline'>" . htmlspecialchars($row['whatsapp']) . "</a></p>
                        <p><strong>Alternate Number:</strong> <a href='tel:" . htmlspecialchars($row['alt_number']) . "' class='no-underline'>" . htmlspecialchars($row['alt_number']) . "</a></p>
                        <p><strong>Address:</strong> " . htmlspecialchars($row['address']) . "</p>
                        <p><strong>Registered At:</strong> " . htmlspecialchars($row['registered_at']) . "</p>
                      </div>";
            }
        } else {
            echo "<p class='text-center'>No records found</p>";
        }
        ?>
    </div>
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
          <a href="https://github.com/Ankit-Gour" target="_blank" style="text-decoration: none;">Ankit Gour</a> 
          <a href="https://github.com/Ankit-Gour" target="_blank">
            <img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" alt="GitHub" width="20" height="20" style="vertical-align: middle; margin-left: 5px;border-radius: 5px;">
          </a> 
          <a href="https://www.linkedin.com/in/ankit-gour-0a00ab259" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="LinkedIn" width="20" height="20" style="vertical-align: middle; margin-left: 5px;border-radius: 10px;">
          </a>
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
// Close connection
$conn->close();
?>
