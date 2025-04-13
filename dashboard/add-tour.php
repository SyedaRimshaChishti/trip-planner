<?php
include 'config.php'; // Database connection
session_start(); // Start the session

// Check if user is logged in



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $trip_name = $_POST['trip_name'];
    $destination = $_POST['destination'];
    $budget = $_POST['budget'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO trip (trip_name, destination, budget, start_date, end_date, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissi", $trip_name, $destination, $budget, $start_date, $end_date, $user_id);
    
    if ($stmt->execute()) {
        echo "New trip added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Add Tour</title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../app/css/app.css">
</head>
<?php
include 'sidebar.php'; 

?>

<body class="body header-fixed">
    <div id="wrapper">
        <div id="pagee" class="clearfix">
            <div class="has-dashboard">
                <?php include 'includes/header.php'; ?>
                <main id="main">
                    <section class="profile-dashboard">
                        <div class="inner-header mb-40">
                            <h3 class="title">Add Tour</h3>
                            <p class="des">Add your tour details below</p>
                        </div>
                        <form action="" method="POST" id="form-add-tour" class="form-add-tour">
                            <div class="widget-dash-board pr-256 mb-75">
                                <h4 class="title-add-tour mb-30">1. Tour Information</h4>
                                <div class="grid-input-2 mb-45">
                                    <div class="input-wrap">
                                        <label>Enter Trip Name</label>
                                        <input type="text" name="trip_name" placeholder="Switzerland city tour" required>
                                    </div>
                                    <div class="input-wrap">
                                        <label>Enter Destination</label>
                                        <input type="text" name="destination" placeholder="Destination" required>
                                    </div>
                                </div>
                                <div class="input-wrap mb-45">
                                    <label>Budget</label>
                                    <input type="number" name="budget" placeholder="Budget" required>
                                </div>
                                <div class="grid-input-2 mb-45">
                                    <div class="input-wrap">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" required>
                                    </div>
                                    <div class="input-wrap">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="input-wrap">
                                <button type="submit" class="button-add"> Save Tour </button>
                            </div>
                        </form>
                    </section>
                </main>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>
    <!-- Javascript -->
    <script src="../app/js/jquery.min.js"></script>
    <script src="../app/js/bootstrap.min.js"></script>
    <script src="../app/js/main.js"></script>
</body>
</html>
