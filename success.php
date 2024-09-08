<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            background-color: white;
            padding: 30px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #28a745;
        }
        p {
            font-size: 18px;
            color: #333;
            line-height: 1.5;
        }
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        .button {
            margin-top: 20px;
        }
        a {
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Registration Successful!</h1>
        <p>Dear 
            <span class="highlight">
            <?php
if (isset($_GET['name'])) {
    $name = htmlspecialchars($_GET['name']);
    echo ucfirst($name); // Capitalizes the first letter of the name
} else {
    echo "User";
}
?>
            </span>, 
            you have successfully registered for our English coaching program. 
        </p>
        <p>
            Our team will reach out to you soon with more details on how to proceed. Meanwhile, feel free to explore the Ascend Journey , we offer to help you along your learning journey.
        </p>
        <div class="button">
            <a href="index.html">Go Back to Homepage</a>
        </div>
    </div>

</body>
</html>
