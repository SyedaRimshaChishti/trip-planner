<?php
session_start();
include 'config.php'; // Ensure this file contains the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture the form data
    $user_id = $_POST['user_id'];
    $trip_id = $_POST['trip_id'];
    $seats_booked = $_POST['seats_booked'];
    $booking_date = $_POST['booking_date'];

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO booking (user_id, trip_id, seats_booked, booking_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiis", $user_id, $trip_id, $seats_booked, $booking_date); // Corrected parameter binding
    $stmt->execute();

    // Check if insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Booking successfully added!'); window.location.href='my-booking.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to add booking.');</script>";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../libs/font-awesome/css/font-awesome.min.css">
    <style>
        body {
            background-color: #555555;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .form-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .form-container h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #ffcc00;
            text-align: center;
        }

        .form-container .form-label {
            font-weight: bold;
            color: #ffffff;
        }

        .form-container .form-control {
            background-color: #333333;
            border: 1px solid #555555;
            border-radius: 4px;
            padding: 10px;
            color: #ffffff;
        }

        .form-container .form-control:focus {
            border-color: #ffcc00;
            box-shadow: 0 0 0 0.2rem rgba(255, 204, 0, 0.25);
        }

        .form-container .btn-primary {
            background-color: #ffcc00;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            color: black;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container .btn-primary:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
  <!-- HTML form fields updated to match the database columns -->
  <div class="container">
      <div class="form-container">
          <h1 class="text-center">Add Booking</h1>
          <form method="POST" action="">
              <div class="mb-3">
                  <label for="user_id" class="form-label">User ID</label>
                  <input type="number" class="form-control" id="user_id" name="user_id" required>
              </div>
              
              <div class="mb-3">
                  <label for="tri_id" class="form-label">Trip ID</label>
                  <input type="number" class="form-control" id="tri_id" name="tri_id" required>
              </div>
              
              <div class="mb-3">
                  <label for="seats_booked" class="form-label">Seats Booked</label>
                  <input type="number" class="form-control" id="seats_booked" name="seats_booked" required>
              </div>
              
              <div class="mb-3">
                  <label for="booking_date" class="form-label">Booking Date</label>
                  <input type="date" class="form-control" id="booking_date" name="booking_date" required>
              </div>
              
              <button type="submit" class="btn btn-primary">Add Booking</button>
          </form>
      </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
