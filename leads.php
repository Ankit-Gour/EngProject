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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
