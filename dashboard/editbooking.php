<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "trip_planner");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_id = $_POST['user_id'];
    $trip_id = $_POST['trip_id'];
    $seats_booked = $_POST['seats_booked'];
    $booking_date = $_POST['booking_date'];

    // Update booking query
    $update_query = "UPDATE booking SET seats_booked = ?, booking_date = ? WHERE user_id = ? AND trip_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("issi", $seats_booked, $booking_date, $user_id, $trip_id);

    if ($stmt->execute()) {
        echo "<script>alert('Booking updated successfully!'); window.location.href='my-booking.php';</script>"; // Redirect to booking list page
    } else {
        echo "<script>alert('Error updating booking: " . $conn->error . "');</script>";
    }

    // Close statement
    $stmt->close();
}

// Fetch current booking data (for example purposes)
$booking_id = $_GET['id']; // Assuming you're passing the booking ID as a GET parameter
$booking_query = "SELECT * FROM booking WHERE id = ?";
$stmt = $conn->prepare($booking_query);
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

// Close the database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../libs/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet"> <!-- Stylish font -->
    <style>
        body {
            background-color: #021b23;
            color: #333333;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .form-container {
            background: #ffffff;
            padding: 40px; /* Increased padding for more height */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            min-height: 400px; /* Set a minimum height */
        }
        .form-container h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #4da528;
            text-align: center;
            font-family: 'Montserrat', sans-serif; /* Use the new font */
            font-weight: 600; /* Make it thicker */
        }
        .form-container .form-label {
            font-weight: bold;
            color: #333333;
        }
        .form-container .form-control {
            background-color: #ffffff;
            border: 1px solid #555555;
            border-radius: 4px;
            padding: 10px;
            color: #333333;
        }
        .form-container .form-control:focus {
            border-color: #ffcc00;
            box-shadow: 0 0 0 0.2rem rgba(255, 204, 0, 0.25);
        }
        .form-container .btn-primary {
            background-color: #4da528;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container .btn-primary:hover {
            background-color: #429a23;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center">Edit Booking</h1>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="number" class="form-control" id="user_id" name="user_id" value="<?php echo htmlspecialchars($booking['user_id']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="trip_id" class="form-label">Trip ID</label>
                    <input type="number" class="form-control" id="trip_id" name="trip_id" value="<?php echo htmlspecialchars($booking['trip_id']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="seats_booked" class="form-label">Seats Booked</label>
                    <input type="number" class="form-control" id="seats_booked" name="seats_booked" value="<?php echo htmlspecialchars($booking['seats_booked']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="booking_date" class="form-label">Booking Date</label>
                    <input type="date" class="form-control" id="booking_date" name="booking_date" value="<?php echo htmlspecialchars($booking['booking_date']); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Booking</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
