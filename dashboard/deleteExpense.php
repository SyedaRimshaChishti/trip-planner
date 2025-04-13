<?php
session_start();
include 'config.php'; // Ensure this establishes the $conn variable

// Check if ID is provided
if (isset($_GET['id'])) {
    $expense_id = intval($_GET['id']);

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM expenses WHERE id = ?");
    $stmt->bind_param("i", $expense_id);
    $stmt->execute();
    $stmt->close();

    // Redirect or display a success message
    header("Location: expenses.php?message=Expense deleted successfully");
    exit;
} else {
    echo "No expense ID provided.";
    exit;
}
?>
