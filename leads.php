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
            background-color: #f0f4f8;
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
            background: #ffffff;
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
            color: #007bff;
            margin-bottom: 10px;
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
    <!-- slider section -->
    <section class="slider_section " id="navbar">
      <div class="carousel_btn-container">
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2">03</li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      Master English <br>
                      Unlock Your Full Potential <br>
                      with Us
                    </h1>
                    <p>
                      Elevate your language proficiency and soft skills with expert guidance from Ascend Journey.
                    </p>
                    <div class="btn-box">
                      <button type="button" class="nav-link register-btn" data-toggle="modal" data-target="#registrationModal">
                        Register Now
                      </button>
                    </div>
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="images/slider1.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      Achieve Fluency<br>
                      In English and German
                    </h1>
                    <p>
                      Gain the confidence you need for personal and professional success with our flexible learning approach.
                    </p>
                    <div class="btn-box">
                      <button type="button" class="nav-link register-btn" data-toggle="modal" data-target="#registrationModal">
                        Register Now
                      </button>
                    </div>
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="images/slider2.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-5 offset-md-1">
                  <div class="detail-box">
                    <h1>
                      Join Ascend Journey<br>
                      Unlock Global Opportunities
                    </h1>
                    <p>
                      Our courses are designed to help you master languages and essential soft skills for a successful career.
                    </p>
                    <div class="btn-box">
                      <button type="button" class="nav-link register-btn" data-toggle="modal" data-target="#registrationModal">
                        Register Now
                      </button>
                    </div>
                  </div>
                </div>
                <div class="offset-md-1 col-md-4 img-container">
                  <div class="img-box">
                    <img src="images/slider3.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section>
    <!-- end slider section -->
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
</html>

<?php
// Close connection
$conn->close();
?>
