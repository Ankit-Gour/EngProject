<?php
// Database connection parameters
$servername = "localhost"; // Change if needed
$username = "root"; // Your MySQL username
$password = "1913"; // Your MySQL password
$dbname = "english"; // Your desired database name

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Database created or already exists
    $conn->select_db($dbname);

    // Create table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS team_members (
        id VARCHAR(50) PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    
    if ($conn->query($sql) !== TRUE) {
        die("Error creating table: " . $conn->error);
    }
} else {
    die("Error creating database: " . $conn->error);
}

// Initialize a message variable
$message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if logging in as a team member
    if (isset($_POST['login'])) {
        $teamId = $_POST['team_id'];
        $password = $_POST['password'];

        // Prepare and bind
        $stmt = $conn->prepare("SELECT * FROM team_members WHERE id = ? AND password = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $teamId, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            // Validate credentials
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $teamMemberName = $row['name']; // Get the member's name

                // Redirect to team.html with the name as a query parameter
                header("Location: team.html?name=" . urlencode($teamMemberName));
                exit(); // Always call exit after a redirect
            } else {
                $message = "Invalid Team ID or Password!";
            }
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
    }

    // Check if adding a new team member
    if (isset($_POST['add_member'])) {
        $newId = $_POST['new_team_id'];
        $newName = $_POST['new_name'];
        $newPassword = $_POST['new_password'];
        $securityKey = $_POST['security_key']; // High security key for adding new members

        // Verify security key (set your own secure key)
        $correctSecurityKey = "your-secure-key"; // Change this to your actual security key
        if ($securityKey !== $correctSecurityKey) {
            $message = "Invalid security key!";
        } else {
            // Prepare and bind for new member insertion
            $stmt = $conn->prepare("INSERT INTO team_members (id, name, password) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sss", $newId, $newName, $newPassword);

                // Execute and check if successful
                if ($stmt->execute()) {
                    $message = "New team member $newName added successfully!";
                } else {
                    $message = "Error adding new member: " . $conn->error;
                }
                $stmt->close();
            } else {
                $message = "Error preparing statement: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Login</title>
  
    
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="css/responsive.css" rel="stylesheet" />
<style>
    .hero_area {
      height: 69px;}
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
              <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
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



  <!-- registration modal -->
   <!-- Button trigger modal -->


<!-- Modal -->
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




<div class="container" style="max-width: 500px; margin:20px auto; padding: 20px; background:#19d925;; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h1 style="text-align: center; color: white;">Team Login</h1>
    <p class="message" style="color: red; text-align: center;"><?php echo $message; ?></p>

    <!-- Login Form -->
    <form method="POST">
        <h2 style="color: white;">Login as Team Member</h2>
        <input type="text" name="team_id" placeholder="Team ID" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px;">
        <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px;">
        <button type="submit" name="login" style="width: 100%; padding: 10px; background-color: white; color: #007bff; border: none; border-radius: 5px; cursor: pointer;">Login</button>
    </form>

    <hr style="border: 1px solid white;">

    <!-- Add New Team Member Form -->
    <form method="POST">
        <h2 style="color: white;">Add New Team Member</h2>
        <input type="text" name="new_team_id" placeholder="New Team ID" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px;">
        <input type="text" name="new_name" placeholder="New Team Member Name" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px;">
        <input type="password" name="new_password" placeholder="New Password" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px;">
        <input type="text" name="security_key" placeholder="Security Key" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px;">
        <button type="submit" name="add_member" style="width: 100%; padding: 10px; background-color: white; color: #007bff; border: none; border-radius: 5px; cursor: pointer;">Add Team Member</button>
    </form>
</div>






  <!-- experience section -->
  <section class="experience_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="img-box">
                    <img src="images/experience-img.jpg" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            Learn with the Best: Azmi Khan
                        </h2>
                    </div>
                    <p>
                        Ascend Journey is led by Azmi Khan, a visionary CEO with a deep passion for language education. Master English with expert guidance through personalized courses tailored to your needs. Whether you're a beginner or looking to advance your skills, our experienced instructors will help you gain fluency, confidence, and mastery in speaking, writing, and understanding English, all at your pace. Join us to achieve measurable outcomes and reach your full potential!
                    </p>
                    <div class="btn-box">
                        <button type="button" class="nav-link register-btn" data-toggle="modal" data-target="#registrationModal">
                            Register Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- end experience section -->

  <!-- category section -->

  <section class="category_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Our Pedagogy

        </h2>
      </div>
      <div class="category_container">
        <div class="box">
          <div class="img-box">
            <img src="images/c1.png" width="80" height="80">
          </div>
          <div class="detail-box">
            <h5>
              Assessment of Skill Level
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/c2.png" width="80" height="80" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Goal Setting
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/c3.png" width="80" height="80" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Building Vocabulary
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/c4.png" width="80" height="80" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Grammar Instruction
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/c5.png" width="80" height="80" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Listening & Speaking Practice
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/c6.png" width="80" height="80"  alt="">
          </div>
          <div class="detail-box">
            <h5>
              Reading & Comprehension
            </h5>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="images/c7.png" width="80" height="80" alt="">
          </div>
          <div class="detail-box">
            <h5>
              Writing Practice
            </h5>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- end category section -->

  
  <!-- freelance section -->

  <section class="freelance_section ">
    <div id="accordion">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 offset-md-1">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                  Continuous Professional Development
                </h2>
              </div>
              <div class="tab_container">
                <div class="t-link-box" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <div class="img-box">
                    <img src="images/f1.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                     100+ Students
                    </h5>
                    <h3>
                      get trained
                    </h3>
                  </div>
                </div>
                <div class="t-link-box collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <div class="img-box">
                    <img src="images/f2.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      200hr +                   </h5>
                    <h3>
                      Teaching experience
                    </h3>
                  </div>
                </div>
                <div class="t-link-box collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <div class="img-box">
                    <img src="images/f3.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                     200+ Students
                    </h5>
                    <h3>
                    Positive Feedback 
                    </h3>
                  </div>
                </div>
                <div class="t-link-box collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  <div class="img-box">
                    <img src="images/f4.png" alt="">
                  </div>
                  <div class="detail-box">
                    <h5>
                      100%
                    </h5>
                    <h3>
                      Student <br>
                      Satisfaction Rate
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="collapse show" id="collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="img-box">
                <img src="images/freelance-img.jpg" alt="">
              </div>
            </div>
            <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="img-box">
                <img src="images/freelance-img.jpg" alt="">
              </div>
            </div>
            <div class="collapse" id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="img-box">
                <img src="images/freelance-img.jpg" alt="">
              </div>
            </div>
            <div class="collapse" id="collapseFour" aria-labelledby="headingfour" data-parent="#accordion">
              <div class="img-box">
                <img src="images/freelance-img.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end freelance section -->

  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-10 mx-auto">
          <div class="heading_container">
            <h2>
              Testimonial
            </h2>
          </div>
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="detail-box">
                  <h4>
                    Priya Verma
                  </h4>
                  <p>
                    Azmi Khan Sir's teaching approach is simply amazing. His detailed explanations and real-world examples helped me grasp complex concepts in no time. His classes are interactive, and he ensures that every student understands thoroughly. I'm now confident in my English skills, all thanks to Azmi Sir.
                  </p>
                  <img src="images/quote.png" alt="">
                </div>
              </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h4>
                    Rahul Singh
                  </h4>
                  <p>
                    Learning under Azmi Khan Sir was an incredible experience. His ability to break down complicated grammar rules and make them easy to understand is remarkable. His patience and attention to detail have significantly improved my speaking and writing. I highly recommend Azmi Sir for mastering English.
                  </p>
                  <img src="images/quote.png" alt="">
                </div>
              </div>
              <div class="carousel-item">
                <div class="detail-box">
                  <h4>
                    Meera Patel
                  </h4>
                  <p>
                    Azmi Khan Sir is an outstanding teacher who makes learning fun and insightful. His unique methods, combined with his encouragement, gave me the confidence to improve my English. His lessons are engaging and tailored to individual needs, which made a huge difference in my learning journey.
                  </p>
                  <img src="images/quote.png" alt="">
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  

  <!-- end client section -->

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
            <a href="https://www.linkedin.com/in/azmi-khan-2a1778197/"><img src="images/linkedin.png" alt="LinkedIn" class="social-icon"></a>
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
</html>
