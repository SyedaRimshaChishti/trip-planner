<?php
session_start();
include 'config.php'; // Ensure this includes the $conn variable

// Check if 'id' is passed in the URL and is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $booking_id = intval($_GET['id']); // Make sure it's an integer

    // Check if the database connection is still open
    if ($conn->connect_errno == 0) {
        // Prepare the DELETE query
        $stmt = $conn->prepare("DELETE FROM booking WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
            $stmt->close();

            // Redirect to the booking page
            header("Location: my-booking.php");
            exit();
        } else {
            echo "Error preparing the DELETE statement.";
        }
    } else {
        echo "Database connection failed.";
    }
} else {
    echo "Invalid booking ID.";
}
?>
