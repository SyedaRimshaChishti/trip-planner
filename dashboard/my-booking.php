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
    // Fetch data with pagination
    $booking = $conn->query("
    SELECT 
        b.id, 
        b.user_id, 
        u.firstname, 
        u.lastname,
        b.seats_booked, 
        b.booking_date,
        b.trip_id,
        t.trip_name
    FROM 
        booking b
    INNER JOIN 
        user u ON b.user_id = u.id
    INNER JOIN 
        trip t ON b.trip_id = t.id
    ORDER BY b.id ASC
    LIMIT $perPage OFFSET $offset");


    if (!$booking) {
        die("Query failed: " . $conn->error);
    }

    $totalBookings = $conn->query("SELECT COUNT(*) as count FROM booking")->fetch_assoc()['count'];
    $totalPages = ceil($totalBookings / $perPage);
} else {
    die("Database connection failed.");
}
?>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">


<!-- Mirrored from themesflat.co/html/vitour/my-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Sep 2024 10:19:30 GMT -->
<head>
    <meta charset="utf-8">
    <title>Vitour - Travel & Tour Booking HTML Template</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../app/css/app.css">
    <link rel="stylesheet" href="../app/css/map.min.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="../assets/images/favico.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/images/favico.png">
<style>
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

    <!-- <div class="preload preload-container">
        <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
            <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
            <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000" stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
        </svg>
    </div> -->

    <!-- /preload -->

    <div id="wrapper">

        <div id="pagee" class="clearfix">
      
         

            <div class="has-dashboard">
                <!-- Main Header -->
                <?php
include 'includes/header.php';
      ?>
                <!-- End Main Header -->
             <!-- Display bookings in a table -->

<main id="main">
                    <section class="profile-dashboard" >
                        <div class="inner-header mb-40">
                            <h3 class="title">My Booking</h3>
                        </div>
                        <div class="my-booking-wrap ">
                            <ul class="booking-table-title flex-three">
                                <li>
                                    <p>Name</p>
                                </li>
                               
                                <li>
                                    <p>user_id</p>
                                </li>
                                <li>
                                    <p>trip_id</p>
                                </li>
                                <li>
                                    <p>booking date</p>
                                </li>
                                <li>
                                    <p>seats_booked</p>
                                </li>
                                <li>
                                    <p>Action</p>
                                </li>
                            </ul>
                           <!-- Display bookings in a list -->
<ul class="booking-table-content mb-60">
    <?php while ($row = $booking->fetch_assoc()): ?>
        <li class="flex-three">
            <div class="booking-list flex-three">
              <p><?php echo htmlspecialchars($row['firstname']);  echo htmlspecialchars($row['lastname']);  ?></p>
            </div>
            <div class="booking-list-table">
                <p class="status"><?php echo htmlspecialchars($row['user_id']); ?></p> <!-- Modify status based on your logic -->
            </div>
            <div class="booking-list-table">
                <p class="date-gues"><?php echo htmlspecialchars($row['trip_id']); ?></p>
            </div>
            <div class="booking-list-table">
                <p class="date-gues"><?php echo htmlspecialchars($row['booking_date']); ?></p>
            </div>
            <div class="booking-list-table">
                <p class="date-gues"><?php echo htmlspecialchars($row['seats_booked']); ?></p>
            </div>
            <div class="flex-five action-wrap">
                <div class="action flex-five">
                <a href="editbooking.php?id=<?php echo $row['id']; ?>">     <i class="icon-Vector-16"></i></a> <!-- Replace with appropriate action -->
                </div>
                <div class="action flex-five">
            <a href="deletebooking.php?id=<?php echo $row['id']; ?>">  <i class="icon-Vector-17"> </i> </a><!-- Replace with appropriate action -->
                </div>
            </div>
        </li>
    <?php endwhile; ?>
</ul>
<div class="row">
    <div class="col-md-12">
        <ul class="tf-pagination flex-five">
            <!-- Previous Page -->
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                <a class="pages-link" href="?page=<?php echo max(1, $page - 1); ?>">
                    <i class="icon-29"></i>
                </a>
            </li>
            
            <!-- Numbered Pages -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            
            <!-- Next Page -->
            <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                <a class="pages-link" href="?page=<?php echo min($totalPages, $page + 1); ?>">
                    <i class="icon-1"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
                    </section>

                </main>


<?php
// Close the connection at the end
$conn->close(); 
?>




<!-- footer start -->
                <?php
include 'includes/footer.php';
?>
<!-- footer end -->

                <!-- Bottom -->
            </div>

        </div>
        <!-- /#page -->
    </div>

    <!-- Modal Popup Bid -->

    <a id="scroll-top" class="button-go"></a>

    <!-- Modal search-->
    <div class="modal search-mobie fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <form action="https://themesflat.co/" class="search-form-mobie">
                        <div class="search">
                            <i class="icon-circle2017"></i>
                            <input type="search" placeholder="Search Travel" class="search-input" autocomplete="off">
                            <button type="button">Search</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <!-- Javascript -->
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


<!-- Mirrored from themesflat.co/html/vitour/my-booking.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Sep 2024 10:19:43 GMT -->
</html>