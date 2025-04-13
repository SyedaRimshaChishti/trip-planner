<footer class="footer footer-style1">
                <div class="tf-container">
                    <div class="footer-main">
                        <div class="footer-logo">
                            <div class="logo-footer">
                                <img src="assets/images/logo3.png" alt="">
                            </div>
                            <p class="des-footer">The world’s first and largest digital market
                                for crypto collectibles and non-fungible
                            </p>
                            <ul class="footer-info">
                                <li class="flex-three">
                                    <i class="icon-noun-mail-5780740-1"></i>
                                    <p>Info@webmail.com</p>
                                </li>
                                <li class="flex-three">
                                    <i class="icon-Group-9"></i>
                                    <p>684 555-0102 490</p>
                                </li>
                                <li class="flex-three">
                                    <i class="icon-Layer-19"></i>
                                    <p>6391 Elgin St. Celina, NYC 10299</p>
                                </li>
                            </ul>

                        </div>
                        <div class="footer-service">
                            <h5 class="title">Services Req</h5>

                            <ul class="footer-menu">
                                <li>
                                    <a href="about.php">About Us</a>
                                </li>
                               
                               
                                <li>
                                    <a href="blog.php">Blog Insights</a>
                                </li>
                                <li>
                                    <a href="contact.php">Contact</a>
                                </li>
                            </ul>

                        </div>
                        <div class="footer-gallery">
                            <h5 class="title">Gallery</h5>

                            <div class="gallery-img">
                                <a href="assets/images/gallery/gl1.jpg" data-fancybox="gallery">
                                    <img src="assets/images/gallery/gl1.jpg" alt="image gallery">
                                </a>
                                <a href="assets/images/gallery/gl2.jpg" data-fancybox="gallery">
                                    <img src="assets/images/gallery/gl2.jpg" alt="image gallery">
                                </a>
                                <a href="assets/images/gallery/gl3.jpg" data-fancybox="gallery">
                                    <img src="assets/images/gallery/gl3.jpg" alt="image gallery">
                                </a>
                                <a href="assets/images/gallery/gl4.jpg" data-fancybox="gallery">
                                    <img src="assets/images/gallery/gl4.jpg" alt="image gallery">
                                </a>
                                <a href="assets/images/gallery/gl5.jpg" data-fancybox="gallery">
                                    <img src="assets/images/gallery/gl5.jpg" alt="image gallery">
                                </a>
                                <a href="assets/images/gallery/gl6.jpg" data-fancybox="gallery">
                                    <img src="assets/images/gallery/gl6.jpg" alt="image gallery">
                                </a>
                            </div>

                        </div>
                        <div class="footer-newsletter">
                            <h5 class="title">Newsletter</h5>
                            <form action="" id="footer-form">
                                <div class="input-wrap flex-three">
                                    <input type="email" placeholder="Enter Email Adress" id="email-input">
                                    <button type="submit" id="submit-btn"><i class="icon-paper-plane"></i></button>
                                </div>
                                <div class="check-form flex-three">
                                    <i class="icon-Vector-121"></i>
                                    <p>I agree to all your terms and policies</p>
                                </div>

                            </form>
                            <ul class="social-ft flex-three">
                                <li>
                                    <a href="https://www.facebook.com/">
                                        <i class="icon-icon-2"></i>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="https://www.instagram.com/">
                                        <i class="icon-8"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.pinterest.com/">
                                        <i class="icon-2"></i>
                                    </a>
                                </li>
                            </ul>

                        </div>
                         <!-- Add a div to display the success message -->
    <div class="success-message my-5 px-3" style="color:#fff">Thank you for subscribing! We are processing your request...</div>
                    </div>

                    <div class="row footer-bottom">
                        <div class="col-md-6">
                            <p class="copy-right">Copyright © 2024 by <a  class="text-main">The Dev Squad</a> All Rights Reserved</p>
                        </div>
                        <!-- <div class="col-md-6">
                            <ul class="social flex-six">
                                <li>
                                    <a href="#">
                                        <i class="icon-icon-2"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-x"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-icon_03"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-2"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </footer>
            <script>
                // Get the form, input, and button elements
const form = document.getElementById('footer-form');
const emailInput = document.getElementById('email-input');
const submitBtn = document.getElementById('submit-btn');
const successMessageDiv = document.querySelector('.success-message');

// Add an event listener to the form submission
form.addEventListener('submit', (e) => {
    e.preventDefault(); // Prevent the default form submission behavior

    // Get the email input value
    const email = emailInput.value.trim();

    // Validate the email input (you can add more validation logic here)
    if (email && email.includes('@')) {
        // Simulate a successful subscription (replace with your actual API call or processing logic)
        setTimeout(() => {
            successMessageDiv.style.display = 'block';
            submitBtn.disabled = true; // Disable the submit button to prevent multiple submissions
        }, 1000); // Simulate a 1-second delay for demonstration purposes
    } else {
        alert('Please enter a valid email address.'); // Display an error message
    }
});
            </script>
