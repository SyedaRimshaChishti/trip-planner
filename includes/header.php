<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'trip_planner');

$is_logged_in = isset($_SESSION['lastname']) && !empty($_SESSION['lastname']);
$username = $is_logged_in ? htmlspecialchars($_SESSION['lastname']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Expense Voyage</title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../app/css/app.css">
    <link rel="stylesheet" type="text/css" href="./app/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="./app/css/jquery.fancybox.min.css">
    <link rel="stylesheet" type="text/css" href="./app/css/textanimation.css">
    <link rel="shortcut icon" href="./assets/images/favico.png">
    <link rel="apple-touch-icon-precomposed" href="./assets/images/favico.png">
    
    <style>
        .main-header {
            position: relative;
            z-index: 1000;
        }
        .slider {
            height: 400px;
            background: #f0f0f0;
        }
        .highlighted-text {
            font-weight: bold;
            background-color: #569e16;
            color: whitesmoke;
            padding: 5px;
            border-radius: 3px;
        }
        .icon-Group-32, .icon-mail {
            color: darkgreen;
        }
    </style>
</head>
<body>
<header class="main-header header-style3 flex">
    <div id="header">
        <div class="tf-container">
            <div class="header-top">
                <div class="header-top-wrap flex-two">
                    <div class="header-top-right">
                        <ul class="flex-three">
                            <li class="flex-three">
                                <i class="icon-Group-32"></i>
                                <span class="highlighted-text">Hot Line: 684 555-0102 490</span>
                            </li>
                            <li class="flex-three">
                                <i class="icon-mail"></i>
                                <span class="highlighted-text">Mail Us: Info@Webmail.Com</span>
                            </li>
                        </ul>
                    </div>
                    <div class="header-top-left flex-two">
                        <ul class="menu-right-top flex-three">
                            <?php if ($is_logged_in): ?>
                                <li>
                                    <span class="welcome-message">Welcome, <?php echo $username; ?>!</span>
                                </li>
                                <li>
                                    <a href="logout.php" class="btn btn-red" style="background-color: red; color: white;">LOGOUT</a>
                                </li>
                            <?php else: ?>
                                <li><a href="login.php">Login</a></li>
                                <li><a href="reg.php">Sign Up</a></li>
                                <li><a href="admin-login.php">Admin Login</a></li>
                            <?php endif; ?>
                        </ul>
                        <div class="follow-social flex-two">
                            <ul class="flex-two">
                                <li><a href="https://www.facebook.com/"><i class="icon-icon-2"></i></a></li>
                                <!-- <li><a href="#"><i class="icon-icon_03"></i></a></li>
                                <li><a href="#"><i class="icon-x"></i></a></li> -->
                                <li><a href="https://pk.linkedin.com/"><i class="icon-icon"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-lower">
                <div class="tf-container full">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner-container flex justify-space align-center">
                                <div class="">
                                    <div class="logo">
                                        <a href="index.php">
                                            <img src="assets/images/logo3.png" alt="Logo" style="width: 150px; height: 110px; margin-left:0px;">
                                        </a>
                                    </div>
                                </div>
                                <div class="nav-outer flex align-center">
                                    <nav class="main-menu show navbar-expand-md">
                                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
    <ul class="navigation clearfix d-flex justify-content-center">
        <li><a href="index.php">Home</a></li>
        <li><a href="./archive-tour.php">Tour</a>
            <ul>
                <li><a href="./tour_single.php">Tour Single</a></li>
            </ul>
        </li>
        <li><a href="./destination.php">Destination</a></li>
        <li><a href="./blog.php">Blog</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="terms_and_conditions.php">Terms & Condition</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</div>

                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize your slider here
    });
</script>
</body>
</html>
