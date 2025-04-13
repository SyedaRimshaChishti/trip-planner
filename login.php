<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'trip_planner');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email)) {
        $error = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }

    if (empty($password)) {
        $error = "Password is required.";
    }

    if (empty($error)) {
        $stmt = $conn->prepare("SELECT id, lastname, password FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['email'] = $email;

                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid email or password";
            }
        } else {
            $error = "Invalid email or password";
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #000; /* off-white background */
    }

    .login-form {
      max-width: 500px; /* Slightly smaller than the register form */
      margin: 100px auto;
      background-color: #e8f5e9; /* light green background for the form */
      border-radius: 20px;
      padding: 40px;
      border: 3px solid #4caf50; /* Green border */
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Form stands out with shadow */
    }

    .form-group label {
      color: #2e7d32; /* dark green for labels */
      font-weight: bold;
    }

    .btn-custom {
      background-color: #81c784; /* light green button */
      border-color: #81c784;
      color: white;
      font-weight: bold;
    }

    .btn-custom:hover {
      background-color: #66bb6a; /* darker light green on hover */
      border-color: #66bb6a;
    }

    h2 {
      color: #1b5e20; /* Darker green for the heading */
      text-align: center;
      margin-bottom: 30px;
      font-weight: bold;
      font-size: 28px;
    }
  </style>
</head>
<body>

  <div class="login-form">
    <h2>Login</h2>
    <?php if ($error): ?>
      <div class="alert alert-danger">
        <?php echo $error; ?>
      </div>
    <?php endif; ?>
    <form action="login.php" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
      </div>
      <button type="submit" class="btn btn-custom btn-block">Login</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

