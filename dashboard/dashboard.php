<?php
include 'config.php';
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">


<!-- Mirrored from themesflat.co/html/vitour/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Sep 2024 10:19:15 GMT -->
<head>
    <meta charset="utf-8">
    <title>Vitour - Travel & Tour Booking HTML Template</title>

    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../app/css/app.css">
    <link rel="stylesheet" href="../app/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../app/css/map.min.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="../assets/images/favico.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/images/favico.png">

</head>

<body class="body header-fixed ">

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

<?php
include 'sidebar.php';
?>
            <div class="has-dashboard">
                <!-- Main Header -->
      <?php
include 'includes/header.php';
      ?>
                <!-- End Main Header -->
                <main id="main">
                    <section class="profile-dashboard">
                        <div class="inner-header mb-40">
                            <h3 class="title">Dashboard</h3>
                            <p class="des">There are many variations of passages of Lorem Ipsum</p>
                        </div>
                        <div class="counter-grid-dashboard mb-70">
                            <div class="counter-dashboard flex-three tf-countto">
                                <div class="icon flex-five">
                                    <i class="icon-earnings-1"></i>
                                </div>
                                <div class="content">
                                    <span>Total Earning</span>
                                    <div class="number-counter money" data-to="43216" data-speed="2000"
                                        data-waypoint-active="yes">43216</div>
                                </div>
                            </div>
                            <div class="counter-dashboard flex-three tf-countto">
                                <div class="icon flex-five">
                                    <i class="icon-heart-1"></i>
                                </div>
                                <div class="content">
                                    <span>My Wishlist</span>
                                    <div class="number-counter plus" data-to="2351" data-speed="2000"
                                        data-waypoint-active="yes">2351</div>
                                </div>
                            </div>
                            <div class="counter-dashboard flex-three tf-countto">
                                <div class="icon flex-five">
                                    <i class="icon-Group-1000003085"></i>
                                </div>
                                <div class="content">
                                    <span>Total Listing</span>
                                    <div class="number-counter" data-to="43216" data-speed="2000"
                                        data-waypoint-active="yes">43216</div>
                                </div>
                            </div>
                            <div class="counter-dashboard flex-three tf-countto">
                                <div class="icon flex-five">
                                    <i class="icon-feedback"></i>
                                </div>
                                <div class="content">
                                    <span>Total Listing</span>
                                    <div class="number-counter plus" data-to="2351" data-speed="2000"
                                        data-waypoint-active="yes">2351</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xxl-8 col-xl-12">
                                <div class="page-insight">
                                    <!-- chart -->
                                    <div class="wg-box">
                                        <div class="flex-two">
                                            <h5>Total page view</h5>
                                            <div class="group-select">
                                                <div class="nice-select" tabindex="0">
                                                    <span class="current">This Week</span>
                                                    <ul class="list">
                                                        <li data-value class="option selected">This Week</li>
                                                        <li data-value="Last day" class="option">Last Day</li>
                                                        <li data-value="Last Week" class="option">Last Week</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="line-chart-1"></div>
                                    </div>
                                    <!-- /chart -->
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-12">
                                <div class="tfcl-card dashboard-message mb-25">
                                    <h4 class="title mb-30">What,s New?</h4>
                                    <ul class="message">
                                        <li class="flex-three">
                                            <div class="icon">
                                                <i class="icon-Group4"></i>
                                            </div>
                                            <p>Congratulation Your <span class="text-main">23</span> Listing has been
                                                approved Today</p>
                                        </li>
                                        <li class="flex-three">
                                            <div class="icon">
                                                <i class="icon-Vector-131"></i>
                                            </div>
                                            <p>Someone is saved your listing</p>
                                        </li>
                                        <li class="flex-three">
                                            <div class="icon">
                                                <div class="icon-Vector-141"></div>
                                            </div>
                                            <p>You have unread <span class="text-main">21</span> Message</p>
                                        </li>
                                        <li class="flex-three">
                                            <div class="icon">
                                                <i class="icon-Vector-131"></i>
                                            </div>
                                            <p>Congratulation Your <span class="text-main">22</span> Listing has
                                                been</p>
                                        </li>
                                        <li class="flex-three">
                                            <div class="icon">
                                                <i class="icon-Vector-131"></i>
                                            </div>
                                            <p>Mehedii Added Favorites Your listing “Mercedez Benz 2.3”</p>
                                        </li>
                                        <li class="flex-three">
                                            <div class="icon">
                                                <i class="icon-Vector-141"></i>
                                            </div>
                                            <p>You have unread <span class="text-main">21</span> Message</p>
                                        </li>
                                        <li class="flex-three">
                                            <div class="icon">
                                                <i class="icon-Vector-131"></i>
                                            </div>
                                            <p>Congratulation Your <span class="text-main">22</span> Listing has been
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tfcl-card dashboard-reviews">
                                    <h4 class="title mb-30">Recent Reviews</h4>
                                    <ul>
                                        <li class="comment-by-user flex-three">
                                            <div class="group-author">
                                                <img src="../assets/images/avata/avt-review.jpg" alt="image">
                                            </div>
                                            <div class="content">
                                                <div class="group-name flex-one">
                                                    <div class="review-name">Rohan De Spond</div>
                                                    <div class="rating-wrap">
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                    </div>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, con covered many vulputate ves
                                                </p>
                                            </div>
                                        </li>
                                        <li class="comment-by-user flex-three">
                                            <div class="group-author">
                                                <img src="../assets/images/avata/avt-review2.jpg" alt="image">
                                            </div>
                                            <div class="content">
                                                <div class="group-name flex-one">
                                                    <div class="review-name">Mehedii. Has</div>
                                                    <div class="rating-wrap">
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                    </div>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, con covered many vulputate ves
                                                </p>
                                            </div>
                                        </li>
                                        <li class="comment-by-user flex-three">
                                            <div class="group-author">
                                                <img src="../assets/images/avata/avt-review.jpg" alt="image">
                                            </div>
                                            <div class="content">
                                                <div class="group-name flex-one">
                                                    <div class="review-name">Rohan De Spond</div>
                                                    <div class="rating-wrap">
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                    </div>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, con covered many vulputate ves
                                                </p>
                                            </div>
                                        </li>
                                        <li class="comment-by-user flex-three">
                                            <div class="group-author">
                                                <img src="../assets/images/avata/avt-review3.jpg" alt="image">
                                            </div>
                                            <div class="content">
                                                <div class="group-name flex-one">
                                                    <div class="review-name">Mehedii. Has</div>
                                                    <div class="rating-wrap">
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                        <i class="icon-Star"></i>
                                                    </div>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, con covered many vulputate ves
                                                </p>
                                            </div>
                                        </li>

                                    </ul>

                                </div>

                            </div>
                        </div>

                    </section>

                </main>
<?php
include 'includes/footer.php';
?>
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
    <script src="../app/js/bootstrap-select.min.js"></script>
    <script src="../app/js/tinymce/tinymce.min.js"></script>
    <script src="../app/js/tinymce/tinymce-custom.js"></script>
    <script src="../app/js/swiper-bundle.min.js"></script>
    <script src="../app/js/swiper.js"></script>
    <script src="../app/js/plugin.js"></script>
    <script src="../app/js/map.min.js"></script>
    <script src="../app/js/map.js"></script>
    <script src="../app/js/countto.js"></script>
    <script src="../app/js/apexcharts.js"></script>
    <script src="../app/js/line-chart.js"></script>
    <script src="../app/js/shortcodes.js"></script>
    <script src="../app/js/main.js"></script>

</body>


<!-- Mirrored from themesflat.co/html/vitour/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Sep 2024 10:19:30 GMT -->
</html>