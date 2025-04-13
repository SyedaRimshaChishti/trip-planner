<?php
$message = '';
$conversion_rates = []; // Initialize conversion rates

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    if (isset($_POST['book_now'])) {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "trip_planner");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get form data
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $destination = $_POST['destination'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $seats_booked = $_POST['seats_booked'];
        $budget = $_POST['budget'];
        $booking_date = date('Y-m-d'); // Current date for booking

        // Insert into user table
        $user_query = "INSERT INTO user (firstname, lastname, email) VALUES ('$first_name', '$last_name', '$email')";
        if ($conn->query($user_query) === TRUE) {
            $user_id = $conn->insert_id; // Get the user ID after inserting

            // Insert into trip table
            $trip_query = "INSERT INTO trip (user_id, destination, start_date, end_date) VALUES ('$user_id', '$destination', '$start_date', '$end_date')";
            if ($conn->query($trip_query) === TRUE) {
                $trip_id = $conn->insert_id; // Get the trip ID after inserting

                // Insert into booking table
                $booking_query = "INSERT INTO booking (user_id, trip_id, booking_date, seats_booked, budget) VALUES ('$user_id', '$trip_id', '$booking_date', '$seats_booked', '$budget')";
                if ($conn->query($booking_query) === TRUE) {
                    $message = "Booking successful!";
                } else {
                    $message = 'Error booking: ' . $conn->error;
                }
            } else {
                $message = 'Error inserting trip data: ' . $conn->error;
            }
        } else {
            $message = 'Error inserting user data: ' . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }

    // Handle currency conversion request
    if (isset($_POST['convert_currency'])) {
        $budget = $_POST['budget'];
        if (!empty($budget) && is_numeric($budget) && $budget > 0) {
            $base_currency = 'USD'; // Change as needed
            $currencies = ['EUR', 'GBP', 'PKR']; // Currencies to convert to
            
            $api_url = "https://api.exchangerate-api.com/v4/latest/$base_currency";
            $response = file_get_contents($api_url);
            $data = json_decode($response, true);
            
            if (isset($data['rates'])) {
                foreach ($currencies as $currency) {
                    $conversion_rates[$currency] = $budget * $data['rates'][$currency];
                }
            } else {
                $message = 'Error fetching conversion rates.';
            }
        } else {
            $message = 'Please enter a valid budget.';
        }
    }
}

// Fetch destinations from trip table
$conn = new mysqli("localhost", "root", "", "trip_planner");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$destinations = [];
$result = $conn->query("SELECT DISTINCT destination FROM trip");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $destinations[] = $row['destination'];
    }
}

// Close the database connection for fetching destinations
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Booking Form</title>
    <style>
        /* Your existing styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .booking-form-container {
            background-color: white;
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: green;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: calc(100% - 40px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
        }
        .currency-symbol {
            display: inline-block;
            margin-left: -40px;
            padding: 10px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            line-height: 1.6;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: green;
            outline: none;
        }
        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: darkgreen;
        }
        .message {
            color: red;
            text-align: center;
            margin: 15px 0;
        }
        .conversion-results {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="booking-form-container">
        <h2>Book Your Trip</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first_name" placeholder="Enter your first name" required>
            </div>

            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last_name" placeholder="Enter your last name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="destination">Destination</label>
                <select id="destination" name="destination" required>
                    <option value="">Select your destination</option>
                    <?php foreach ($destinations as $destination): ?>
                        <option value="<?php echo htmlspecialchars($destination); ?>"><?php echo htmlspecialchars($destination); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="start-date">Start Date</label>
                <input type="date" id="start-date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end-date">End Date</label>
                <input type="date" id="end-date" name="end_date" required>
            </div>

            <div class="form-group">
                <label for="seats-booked">Seats Booked</label>
                <input type="number" id="seats-booked" name="seats_booked" placeholder="Enter number of seats" min="1" required>
            </div>

            <div class="form-group">
                <label for="budget">Budget</label>
                <div style="position: relative;">
                    <span class="currency-symbol">$</span>
                    <input type="number" id="budget" name="budget" placeholder="Enter your budget" required>
                </div>
            </div>

            <button type="submit" name="book_now" class="submit-btn">Book Now</button>
            <hr>
            <button type="submit" name="convert_currency" class="submit-btn">Convert Currency</button>
        </form>

        <?php if (!empty($conversion_rates)): ?>
            <div class="conversion-results">
                <h3>Converted Budget:</h3>
                <p>EUR: €<?php echo number_format($conversion_rates['EUR'], 2); ?></p>
                <p>GBP: £<?php echo number_format($conversion_rates['GBP'], 2); ?></p>
                <p>PKR: ₨<?php echo number_format($conversion_rates['PKR'], 2); ?></p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
