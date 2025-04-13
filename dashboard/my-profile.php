<?php
include 'config.php'; // Database connection

// Fetch current admin details
$admin_id = 1; // Example: change this to the logged-in admin ID
$stmt = $conn->prepare("SELECT username, password FROM admin WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
$stmt->close();

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Verify old password
    if ($old_password === $admin['password']) {
        // Update username and new password
        $stmt = $conn->prepare("UPDATE admin SET username = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $new_password, $admin_id);
        $stmt->execute();
        echo "<div class='alert alert-success'>Profile updated successfully</div>";
        $stmt->close();
    } else {
        $error_message = "Old password is incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../app/css/app.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="body header-fixed">
    <div id="wrapper">
        <div id="pagee" class="clearfix">
            <?php include 'sidebar.php'; ?>
            <div class="has-dashboard">
                <?php include 'includes/header.php'; ?>
                <main id="main">
                    <section class="profile-dashboard">
                        <?php if ($error_message): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <form method="POST" style="height:70vh;">
                            <h3>My Profile</h3>
                            <div>
                                <label>Username</label>
                                <input type="text" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
                            </div>
                            <div>
                                <label>Old Password</label>
                                <input type="password" name="old_password" required>
                            </div>
                            <div>
                                <label>New Password</label>
                                <input type="password" name="new_password" required>
                            </div>
                            <button type="submit">Save Changes</button>
                        </form>
                    </section>
                </main>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
