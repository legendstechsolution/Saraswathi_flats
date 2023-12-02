<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $work = $_POST["work"];
    $apply = $_POST["apply"];
    $subject = $_POST["subject"];

    // Validate captcha
    if (!isset($_POST['captcha_answer']) || empty($_POST['captcha_answer'])) {
        // Handle the case where captcha is not provided
        exit("Captcha answer is required!");
    }

    $userAnswer = $_POST['captcha_answer'];
    $correctAnswer = $_POST['captcha_ans'];

    if ($userAnswer !== $correctAnswer) {
        // Handle the case where the captcha answer is incorrect
        exit("Incorrect captcha answer!");
    }

    // Check if the table exists
    $checkTableQuery = "SHOW TABLES LIKE 'venture_scs'";
    $tableExists = $conn->query($checkTableQuery);

    if ($tableExists->num_rows == 0) {
        // Table doesn't exist, create it
        $createTableQuery = "CREATE TABLE venture_scs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            number VARCHAR(15) NOT NULL,
            work VARCHAR(255) NOT NULL,
            apply VARCHAR(255) NOT NULL,
            subject TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($conn->query($createTableQuery) !== TRUE) {
            // Handle the case where table creation fails
            exit("Error creating table: " . $conn->error);
        }
    }

    // Insert data into the database
    $insertDataQuery = "INSERT INTO venture_scs (name, email, number, work, apply, subject) VALUES ('$name', '$email', '$number', '$work', '$apply', '$subject')";
    $conn->query($insertDataQuery);


    // Close the database connection
    $conn->close();
}

$num1 = rand(1, 10);
$num2 = rand(1, 10);
$c = $num1 + $num2;






?>






<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-ML69RCZS');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Saraswathi Constructions</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/favicons/manifest.json">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font awesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <!-- OwlCarousel CSS -->
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <!-- SlickNav CSS -->
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- Magnific popup CSS -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML69RCZS" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- Header Area Start -->
    <header class="construct-header-area">
        <div class="header-top-area">
            <div class="header-top-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="header-top-left">

                            <p style="font-size: 14px;">27/15, Shanthi Nagar Main Road, Adambakkam, Chennai</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="header-top-right">
                            <ul>
                                <li><a target="_blank;"
                                        href="https://www.facebook.com/Saraswathi-Constructions-109052950639449/?modal=admin_todo_tour"
                                        style="font-size:18px;"><i class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank;" href="https://www.linkedin.com/in/anand-nathamani-2308a7a1/"
                                        style="font-size:18px;"><i class="fa fa-linkedin"></i></a></li>
                                <li><a target="_blank;"
                                        href="https://instagram.com/nanandn2020?utm_source=qr&igshid=MzNlNGNkZWQ4Mg=="
                                        style="font-size:18px;"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-logo-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5 col-sm-5">

                        <a href="index.php">
                            <img src="assets/img/scs_logo.png" class="img-fluid" alt="site logo"
                                style="width:400px; height:80px;" />
                        </a>


                    </div>
                    <div class="col-lg-3 col-md- col-sm-12">
                        <div class="logo-right-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <a href="tel:+91 80727 98551">
                            <h4>Call us</h4>
                            <p>+91 80727 98551</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md- col-sm-12 ">
                        <div class="logo-right-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="mailto:scsinconstructions@gmail.com">
                            <h4>Mail us</h4>
                            <p>scsinconstructions@gmail.com</p>
                        </a>


                    </div>

                </div>
            </div>
        </div>
        <div class="mainmenu-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <style>
                            .mainmenu ul>li>ul>li {
                                position: relative;
                            }
                        </style>
                        <div class="mainmenu">
                            <ul id="construct_navigation">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="#">Projects</a>
                                    <ul>
                                        <li><a href="OnGoing_Project.php">OnGoing Projects</a>

                                        </li>
                                        <li><a href="#">Completed Projects</a></li>
                                    </ul>
                                </li>
                                <li><a href="services.php">Our Services</a></li>
                                <li class="current-page-item"><a href="venture.php">Joint Venture</a></li>
                                <li><a href="portfolia.php">Portfolio</a></li>
                                <li><a href="pricing.php">Pricing</a></li>

                                <li>
                                    <a href="#">More</a>
                                    <ul>
                                        <li><a href="carrer.php">Careers</a></li>
                                        <li><a href="contact.php">Contact Us</a></li>
                                        <li><a href="blog.php">Blog</a></li>
                                    </ul>
                                </li>

                                <a href="pricing.php">
                                    <li style="float:right;">

                                        <img src="assets/img/price.png" class="img-fluid " alt="offer"
                                            style="width:250px; height:50px;border-radius:5px; margin-top:2px; " />
                                    </li>
                                </a>

                            </ul>
                        </div>

                        <!-- Responsive Menu Start -->
                        <div class="construct-responsive-menu">
                            <img src="assets/img/price.png" class="img-fluid " alt="offer"
                                style="width:250px; height:50px;border-radius:5px;float:right;margin-top:-55px;" />
                        </div>
                        <!-- Responsive Menu End -->
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->



    <div class="container careerform">
        <div class="row pt-5 pb-3">
            <div class="section-heading">
                <h2>Joint Venture</h2>
                <p>Join hands with us to create a profitable joint development for you</p>

            </div>

            <!-- Service Cards -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="container pb-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="card">
                                <div class="service-text text-center">
                                    <img src="./assets/img/on-time.png" alt="" width="15%" class="mx-auto m-3" />
                                    <h2>Ontime Guaranteed</h2>
                                    <p>If not delivered on time we pay penalties to the customer</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <div class="card">
                                <div class="service-text text-center">
                                    <img src="./assets/img/guarantee.png" alt="" width="15%" class="mx-auto m-3" />
                                    <h2>Construction Warranty</h2>
                                    <p>We provide 15 years warranty for the construction</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                            <div class="card">
                                <div class="service-text text-center">
                                    <img src="./assets/img/cap.png" alt="" width="15%" class="mx-auto m-3" />
                                    <h2>Material Quality</h2>
                                    <p>Use high-quality construction materials from reputable suppliers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card rounded p-5  bg-image">

                    <form onsubmit="return validateForm();" id="contactForm" action="" method="POST">
                        <div class="form  vstack gap-2 fw-bold">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required />
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required />
                            </div>
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="number" class="form-control" name="number" id="number"
                                    title="Please enter valid phone number" />

                            </div>
                            <div class="form-group">
                                <label class="form-label">Location (We are operating only in Chennai as of now)</label>
                                <input type="text" class="form-control" name="work" id="work" required />
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter Your land area in sq.ft.</label>
                                <input type="text" class="form-control" id="apply" name="apply" required />
                            </div>
                            <div class="form-group mt-2 mb-2">
                                <label class="form-label">Please explain your requirement</label>
                                <textarea class="form-control" name="subject" id="subject" required rows="3"></textarea>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Captcha: <?php echo $num1 . "+" . $num2 . " = ?"; ?>
                            </label>

                                <input type="text" name="captcha_answer" id="captcha_answer" required />
                                <input type="hidden" id="captcha_ans" name="captcha_ans"
                                    value="<?php echo $c ?>" required>
                            </div>
                            <div class="text-center">
                                <button  class="btn btn-primary p-2 fw-bold">
                                    Submit
                                </button>
                            </div>
                            <div id="messageContainer" style="display: none;">
                                <p id="successMessage" style="color: green;"></p>
                                <p id="errorMessage" style="color: red;"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>






    <!-- Footer Area Start -->
    <?php
    include('footer.php');
    ?>
    <!-- Footer Area End -->


    <!-- jQuery -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="assets/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup JS -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- OwlCarousel JS -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- SlickNav JS -->
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- Isotop Js -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/custom-isotop.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/custom.js"></script>
    <!-- Gmap JS -->
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD7CQl6fRhagGok6CzFGOOPne2X1u1spoA"></script>
    <script src="assets/js/gmap.js"></script>
    <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var phone = document.getElementById('number').value;
            var captcha = document.getElementById('captcha_answer').value;
            var captchaAns = document.getElementById('captcha_ans').value;

            var phoneRegex = /^[0-9]{10}$/;
            if (name === '' || captcha === '') {
                displayMessage('errorMessage', 'Name and Captcha are required fields!');
                return false;
            } else if (!phoneRegex.test(phone)) {
                displayMessage('errorMessage', 'Please enter a valid 10-digit phone number.');
                return false;
            } else if (captcha !== captchaAns) {
                displayMessage('errorMessage', 'Captcha verification failed. Please try again.');
                return false;
            } else {
                displayMessage('successMessage', 'Form submitted successfully!');
                submitForm(); // Function to handle form submission
                return true;
            }
        }

        function displayMessage(elementId, message) {
            var element = document.getElementById(elementId);
            element.innerText = message;

            var messageContainer = document.getElementById('messageContainer');

            // Hide both messages initially
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'none';

            // Display the appropriate message based on messageType
            if (elementId === 'successMessage') {
                document.getElementById('successMessage').style.display = 'block';
            } else if (elementId === 'errorMessage') {
                document.getElementById('errorMessage').style.display = 'block';
            }

            // Display the message container
            messageContainer.style.display = 'block';
        }

        function submitForm() {

            document.getElementById('contactForm').submit();
        }
    </script>
</body>

</html>