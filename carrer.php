<?php
session_start();

include('connection.php');





// Assuming $conn is your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Validate and sanitize input fields
   $name = $_POST["name"];
   $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
   $number = $_POST["number"];
   $work = $_POST["work"];
   $apply = $_POST["apply"];
   $salary = $_POST["salary"];
   $current_location = $_POST["current_location"];

   // Validate captcha
   if (!isset($_POST['captcha_answer']) || empty($_POST['captcha_answer'])) {
      echo '<script>alert("Captcha answer is required!");</script>';
      // Redirect the user back to the form
   } else {
      $userAnswer = intval($_POST['captcha_answer']);
      $correctAnswer = $_SESSION['captcha_answer'];
      if ($userAnswer !== $correctAnswer) {
         echo '<script>alert("Incorrect captcha answer!");</script>';
         // Redirect the user back to the form
      } else {
         // Capture current date and time
         $dateApplied = date("Y-m-d");
         $timeApplied = date("H:i:s");

         // Check if the table exists
         $checkTableQuery = "SHOW TABLES LIKE 'career_applications'";
         $tableExists = $conn->query($checkTableQuery);

         if ($tableExists->num_rows == 0) {
            // Table doesn't exist, create it
            $createTableQuery = "CREATE TABLE career_applications (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    number VARCHAR(15) NOT NULL,
                    work VARCHAR(255) NOT NULL,
                    apply VARCHAR(255) NOT NULL,
                    resume VARCHAR(255) NOT NULL,
                    salary VARCHAR(255) NOT NULL,
                    current_location VARCHAR(255) NOT NULL,
                    date_applied DATE,
                    time_applied TIME
                )";

            if ($conn->query($createTableQuery) !== TRUE) {
               echo "Error creating table: " . $conn->error;
               $conn->close();
               exit; // Exit the script if table creation fails
            }
         }






         // File Name Handling
         $originalFileName = $_FILES["resume"]["name"];
         $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

         // Construct a unique filename to avoid conflicts
         $resume = "resume_" . time() . "_" . uniqid() . "." . $fileExtension;
         $targetDir = "admin/images/";
         $targetFile = $targetDir . rawurlencode($resume);

         // Move File and Database Insertion
         if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFile)) {
            $insertDataQuery = $conn->prepare("INSERT INTO career_applications (name, email, number, work, apply, resume, salary, current_location, date_applied, time_applied) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $insertDataQuery->bind_param("ssssssssss", $name, $email, $number, $work, $apply, $resume, $salary, $current_location, $dateApplied, $timeApplied);

            if ($insertDataQuery->execute()) {
               // Display success alert using JavaScript
               echo '<script>alert("Record inserted successfully!");</script>';
            } else {
               echo "Error: " . $insertDataQuery->error;
            }
         } else {
            echo "Error uploading file.";
         }

         // Close the database connection
         $conn->close();
      }
   }
}





function generateCaptcha()
{
   $num1 = rand(1, 10);
   $num2 = rand(1, 10);
   $_SESSION['captcha_answer'] = $num1 + $num2;
   return "$num1 + $num2 = ?";
}


// Generate the captcha question
$captchaQuestion = generateCaptcha();

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
                              href="https://api.whatsapp.com/send?phone=918072798551&amp;text=Hi Saraswathi Construction"
                              style="font-size:18px;"><i class="fa fa-whatsapp"></i></a></li>
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
                              <li><a href="OnGoing_Project.php">OnGoing Project</a>

                              </li>
                              <li><a href="portfolia.php">Complete Project</a></li>
                           </ul>
                        </li>


                        <li><a href="services.php">Our Services</a></li>
                        <li><a href="venture.php">Joint Venture</a></li>
                        <li><a href="portfolia.php">Portfolio</a></li>
                        <li><a href="pricing.php">Pricing</a></li>

                        <li class="current-page-item">
                           <a href="#">More</a>
                           <ul>
                              <li class="current-page-item"><a href="carrer.php">Careers</a></li>
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
         <div class="col-lg-6 col-md-6 col-sm-12 col-12 service-text">
            <h2>Join Our Team</h2>
            <h3 class="mt-3">Job Opportunitis</h3>
            <p class="mt-3">“Choose a job you love, and you will never have to work a day in your life”</p>
            <img src="./assets/img/introcareer.png" width="100%" />
         </div>
         <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card rounded p-5 bg-image">
               <form action="" method="post" enctype="multipart/form-data">
                  <div class="form vstack gap-2 fw-bold">
                     <h3 class="text-center">Career Form</h3>
                     <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required />
                     </div>
                     <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" />
                     </div>
                     <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="number" />
                     </div>
                     <div class="form-group">
                        <label class="form-label">Are you available to work in our office in Chennai?</label>
                        <input type="text" class="form-control" name="work" />
                     </div>
                     <div class="form-group">
                        <label class="form-label">Position applying for</label>
                        <input type="text" class="form-control" name="apply" />
                     </div>
                     <div class="form-group mt-2 mb-2">
                        <label class="form-label">Upload your resume</label>
                        <input type="file" class="form-control" name="resume" />
                     </div>
                     <div class="form-group">
                        <label class="form-label">Expected Salary</label>
                        <input type="text" class="form-control" name="salary" />
                     </div>
                     <div class="form-group">
                        <label class="form-label">Are you currently living in Chennai</label>
                        <input type="text" class="form-control" name="current_location" />
                     </div>
                     <div class="form-group mt-2 mb-2">
                        <label class="form-label"> Captcha:
                           <?php echo $captchaQuestion; ?>
                        </label>

                        <input type="text" name="captcha_answer" required />
                     </div>

                     <div class="mt-2 mb-2">
                        <button type="submit" class="btn btn-primary p-2 fw-bold">
                           Submit
                        </button>
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
</body>

</html>