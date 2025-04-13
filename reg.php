<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'trip_planner';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define error variables
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validate first name
    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }

    // Validate last name
    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password (minimum 6 characters)
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        // Encrypt password using password_hash()
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into database
        $sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashed_password);
        if ($stmt->execute()) {
            // Redirect to login page on success
            header("Location: login.php");
            exit;
        } else {
            $errors[] = "Failed to register user. Please try again.";
        }

        // Close statement and connection
        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>

<!-- HTML Form with error display -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000; /* Black background */
        }

        .register-form {
            max-width: 600px; /* Larger form */
            margin: 80px auto;
            background-color: #e8f5e9; /* Light green background for the form */
            border-radius: 20px;
            padding: 50px;
            border: 3px solid #4caf50; /* Green border */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Form stands out with shadow */
        }

        .form-group label {
            color: #2e7d32; /* Dark green for labels */
            font-weight: bold;
        }

        .btn-custom {
            background-color: #81c784; /* Light green button */
            border-color: #81c784;
            color: white;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #66bb6a; /* Darker green on hover */
            border-color: #66bb6a;
        }

        h2 {
            color: #1b5e20; /* Darker green for the heading */
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
            font-size: 28px;
        }

        .alert {
            max-width: 600px;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <div class="register-form">
        <h2>Register</h2>

        <!-- Display validation errors -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name" value="<?php echo isset($firstname) ? $firstname : ''; ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" value="<?php echo isset($lastname) ? $lastname : ''; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo isset($email) ? $email : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-custom">Register</button>
        </form>
    </div>
</body>
</html>
