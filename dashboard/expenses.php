<?php
session_start();
include 'config.php'; // Ensure this establishes the $conn variable

$servername = "localhost"; // or your server IP
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "trip_planner"; // your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Pagination
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 5;
$offset = ($page - 1) * $perPage;

// Check if the connection is still valid
if ($conn) {
    // Fetch expense data with pagination
    $expenses = $conn->query("
    SELECT 
        e.id, 
        e.category, 
        e.amount, 
        e.expense, 
        e.notes, 
        e.user_id, 
        e.trip_id 
    FROM 
        expenses e
    ORDER BY e.id ASC
    LIMIT $perPage OFFSET $offset");

    if (!$expenses) {
        die("Query failed: " . $conn->error);
    }

    $totalExpenses = $conn->query("SELECT COUNT(*) as count FROM expenses")->fetch_assoc()['count'];
    $totalPages = ceil($totalExpenses / $perPage);
} else {
    die("Database connection failed.");
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Vitour - Travel & Tour Booking HTML Template</title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../app/css/app.css">
    <link rel="stylesheet" href="../app/css/map.min.css">
    <link rel="shortcut icon" href="../assets/images/favico.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/images/favico.png">

    <style>
        .tf-pagination .page-item.active .page-link {
            background-color: #4da528; /* Specific green */
            color: white;
        }
        .tf-pagination .page-item.active .page-link:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .booking-table-title {
            background-color: #021b32; /* Blue background for header */
            color: white; /* White text */
            font-weight: bold;
            display: flex;
            justify-content: space-between; /* Space between header items */
            padding: 10px 0; /* Add some padding for aesthetics */
        }

        .booking-table-content li {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #eee;
            align-items: center; /* Align items vertically */
            width: 100%; /* Ensure it takes the full width */
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        .booking-table-content li div {
            flex: 1; /* Ensure each cell takes equal space */
            text-align: left; /* Align text to the left */
            padding: 5px; /* Add padding for better spacing */
        }

        .action-wrap {
            display: flex;
            gap: 10px;
            justify-content: center; /* Center the action icons */
        }

        .page-item a {
            background-color: #28a745 !important; /* Green shade */
            color: white !important;
            padding: 5px 10px;
            text-decoration: none;
        }
    </style>
</head>
<?php
include 'sidebar.php'; 

?>
<body class="body header-fixed">
    <div id="wrapper">
        <div id="pagee" class="clearfix">
            <div class="has-dashboard">
                <?php include 'includes/header.php'; ?>

                <main id="main" style="height:90vh;">
                    <section class="profile-dashboard">
                        <div class="inner-header mb-40">
                            <h3 class="title">My Expenses</h3>
                        </div>
                        <div class="my-expenses-wrap">
                            <ul class="booking-table-title flex-three">
                                <li><p>ID</p></li>
                                <li><p>Category</p></li>
                                <li><p>Amount</p></li>
                                <li><p>Expense</p></li>
                                <li><p>Notes</p></li>
                                <li><p>User ID</p></li>
                                <li><p>Trip ID</p></li>
                                <li><p>Action</p></li>
                            </ul>
                            <ul class="booking-table-content mb-60">
                                <?php while ($row = $expenses->fetch_assoc()): ?>
                                    <li class="flex-three">
                                        <div class="booking-list flex-three">
                                            <p><?php echo htmlspecialchars($row['id']); ?></p>
                                        </div>
                                        <div class="booking-list-table">
                                            <p class="status"><?php echo htmlspecialchars($row['category']); ?></p>
                                        </div>
                                        <div class="booking-list-table">
                                            <p class="date-gues"><?php echo htmlspecialchars($row['amount']); ?></p>
                                        </div>
                                        <div class="booking-list-table">
                                            <p class="date-gues"><?php echo htmlspecialchars($row['expense']); ?></p>
                                        </div>
                                        <div class="booking-list-table">
                                            <p class="date-gues"><?php echo htmlspecialchars($row['notes']); ?></p>
                                        </div>
                                        <div class="booking-list-table">
                                            <p class="date-gues"><?php echo htmlspecialchars($row['user_id']); ?></p>
                                        </div>
                                        <div class="booking-list-table">
                                            <p class="date-gues"><?php echo htmlspecialchars($row['trip_id']); ?></p>
                                        </div>
                                        <div class="flex-five action-wrap">
                                            <a href="editExpense.php?id=<?php echo $row['id']; ?>">
                                                <i class="icon-Vector-16"></i>
                                            </a>
                                            <a href="deleteExpense.php?id=<?php echo $row['id']; ?>">
                                                <i class="icon-Vector-17"></i>
                                            </a>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="tf-pagination flex-five">
                                        <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>">
                                                <i class="icon-29"></i>
                                            </a>
                                        </li>
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo min($totalPages, $page + 1); ?>">
                                                <i class="icon-1"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>

                <?php $conn->close(); ?>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </div>

    <a id="scroll-top" class="button-go"></a>

    <script src="../app/js/jquery.min.js"></script>
    <script src="../app/js/jquery.nice-select.min.js"></script>
    <script src="../app/js/bootstrap.min.js"></script>
    <script src="../app/js/tinymce/tinymce.min.js"></script>
    <script src="../app/js/tinymce/tinymce-custom.js"></script>
    <script src="../app/js/swiper-bundle.min.js"></script>
    <script src="../app/js/swiper.js"></script>
    <script src="../app/js/plugin.js"></script>
    <script src="../app/js/map.min.js"></script>
    <script src="../app/js/map.js"></script>
    <script src="../app/js/shortcodes.js"></script>
    <script src="../app/js/main.js"></script>
</body>
</html>
