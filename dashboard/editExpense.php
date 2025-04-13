<?php
session_start();
include 'config.php'; // Ensure this file contains the database connection

// Check if the expense ID is set in the URL
if (isset($_GET['id'])) {
    $expense_id = intval($_GET['id']);

    // Fetch the expense details
    $stmt = $conn->prepare("SELECT * FROM expenses WHERE id = ?");
    $stmt->bind_param("i", $expense_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the expense data
        $expense = $result->fetch_assoc();
    } else {
        echo "<script>alert('No expense found!'); window.location.href='expenses.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid expense ID!'); window.location.href='expenses.php';</script>";
    exit;
}

// Handle form submission to update the expense
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture the form data
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $expense_details = $_POST['expense'];
    $notes = $_POST['notes'];
    $user_id = $_POST['user_id'];
    $trip_id = $_POST['trip_id'];

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE expenses SET category = ?, amount = ?, expense = ?, notes = ?, user_id = ?, trip_id = ? WHERE id = ?");
    $stmt->bind_param("sdssiii", $category, $amount, $expense_details, $notes, $user_id, $trip_id, $expense_id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Expense successfully updated!'); window.location.href='expenses.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to update expense.');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../libs/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet"> <!-- Stylish font -->
    <style>
        body {
            background-color: #021b23; /* Dark background */
            color: #333333; /* Main text color */
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .form-container {
            background: #ffffff; /* White background for the form */
            padding: 40px; /* Increased padding for more height */
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            min-height: 400px; /* Set a minimum height */
        }

        .form-container h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #4da528; /* Green color for the heading */
            text-align: center;
            font-family: 'Montserrat', sans-serif; /* Use the new font */
            font-weight: 600; /* Make it thicker */
        }

        .form-container .form-label {
            font-weight: bold;
            color: #333333; /* Label color */
        }

        .form-container .form-control {
            background-color: #ffffff; /* White background for input fields */
            border: 1px solid #555555; /* Border color */
            border-radius: 4px;
            padding: 10px;
            color: #333333; /* Text color inside inputs */
        }

        .form-container .form-control:focus {
            border-color: #ffcc00; /* Focus border color */
            box-shadow: 0 0 0 0.2rem rgba(255, 204, 0, 0.25); /* Focus shadow */
        }

        .form-container .btn-primary {
            background-color: #4da528; /* Button background color */
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            color: white; /* Button text color */
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container .btn-primary:hover {
            background-color: #429a23; /* Button hover color */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center">Edit Expense</h1>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($expense['category']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="<?php echo htmlspecialchars($expense['amount']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="expense" class="form-label">Expense</label>
                    <input type="text" class="form-control" id="expense" name="expense" value="<?php echo htmlspecialchars($expense['expense']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <input type="text" class="form-control" id="notes" name="notes" value="<?php echo htmlspecialchars($expense['notes']); ?>">
                </div>

                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="number" class="form-control" id="user_id" name="user_id" value="<?php echo htmlspecialchars($expense['user_id']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="trip_id" class="form-label">Trip ID</label>
                    <input type="number" class="form-control" id="trip_id" name="trip_id" value="<?php echo htmlspecialchars($expense['trip_id']); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Expense</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
