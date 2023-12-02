<?php
include('connection.php');
$sql_blog = "SELECT * FROM scs_blog ORDER BY id DESC";
$result_blog = mysqli_query($conn, $sql_blog);
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
   <title>Saraswathi Constructionsss - Engineering and Consultancy</title>
   <!-- Favicon -->
   <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
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
   <link rel="stylesheet" href="assets/css/style1.css">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="assets/css/responsive.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
   <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
   <div class="elfsight-app-c040c6d8-1075-4f3b-a503-35a07699db4b" data-elfsight-app-lazy></div> -->
   <style>
      .flash {
         background-color: #004A7F;
         -webkit-border-radius: 10px;
         border: none;
         color: #FFFFFF;
         cursor: pointer;
         display: inline-block;
         border-radius: 5px;
         font-size: 16px;
         padding: 7px 20px;
         text-align: center;
         text-decoration: none;
         -webkit-animation: glowing 1500ms infinite;
         -moz-animation: glowing 1500ms infinite;
         -o-animation: glowing 1500ms infinite;
         animation: glowing 1500ms infinite;
      }

      @-webkit-keyframes glowing {
         0% {
            background-color: #B20000;
            -webkit-box-shadow: 0 0 3px #B20000;
         }

         50% {
            background-color: #FF0000;
            -webkit-box-shadow: 0 0 10px #FF0000;
         }

         100% {
            background-color: #B20000;
            -webkit-box-shadow: 0 0 3px #B20000;
         }
      }

      @-moz-keyframes glowing {
         0% {
            background-color: #B20000;
            -moz-box-shadow: 0 0 3px #B20000;
         }

         50% {
            background-color: #FF0000;
            -moz-box-shadow: 0 0 10px #FF0000;
         }

         100% {
            background-color: #B20000;
            -moz-box-shadow: 0 0 3px #B20000;
         }
      }

      @-o-keyframes glowing {
         0% {
            background-color: #B20000;
            box-shadow: 0 0 3px #B20000;
         }

         50% {
            background-color: #FF0000;
            box-shadow: 0 0 10px #FF0000;
         }

         100% {
            background-color: #B20000;
            box-shadow: 0 0 3px #B20000;
         }
      }

      @keyframes glowing {
         0% {
            background-color: #B20000;
            box-shadow: 0 0 3px #B20000;
         }

         50% {
            background-color: #FF0000;
            box-shadow: 0 0 10px #FF0000;
         }

         100% {
            background-color: #B20000;
            box-shadow: 0 0 3px #B20000;
         }
      }

      .slide-form {
         padding-left: 20px;
         padding-top: 60px;
         padding-bottom: 60px;
         padding-right: 20px;
      }

      @keyframes blink {

         0%,
         100% {
            background-color: #000000;
            box-shadow: 0 0 3px #020022;
         }

         50% {
            background-color: #FDB825;
            /* Change this to the desired text color */
         }
      }
   </style>
</head>

<body>
   <!-- Google Tag Manager (noscript) -->
   <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ML69RCZS" height="0" width="0"
         style="display:none;visibility:hidden"></iframe></noscript>
   <!-- End Google Tag Manager (noscript) -->
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
      <style>
         .property-listing h1 {
            display: inline-block;
            font-family: 'Montserrat', sans-serif;
            font-size: 18px;
            padding-top: 10px;
            padding-bottom: 18px;
         }

         @keyframes blink-text {
            50% {
               opacity: 0;
            }
         }

         .blink-text {
            animation: blink-text 4s infinite;
            text-shadow: 2px 2px 4px rgb(100, 100, 100);

         }

         .property-listing {
            margin-bottom: 23px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
         }

         .marquee-container {
            overflow: hidden;
            white-space: nowrap;
            ;

         }

         .marquee {

            display: inline-block;
            animation: marquee 20s linear infinite;
            animation-play-state: running;
         }

         @keyframes marquee {
            0% {
               transform: translateX(100%);
            }

            100% {
               transform: translateX(-100%);
            }
         }

         .marquee-container:hover .marquee {
            animation-play-state: paused;
         }

         /* Style the "Book Now" button */
         .book-now-btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #FDB825;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            animation: blink 1s infinite;

            /* Hover effect */
            &:hover {
               background-color: #2980b9;
               color: #FFFFFF
                  /* Change background color on hover */
            }
         }

         .blink {
            background-color: yellow;
            -webkit-animation: blink 800ms step-end infinite;
            animation: blink 800ms step-end infinite;
         }

         @-webkit-keyframes blink {
            50% {
               background-color: red;
            }
         }

         @keyframes blink {
            50% {
               background-color: red;
            }
         }
      </style>
      <div class="property-listing marquee-container container">
         <div class="marquee">
            <h1 class="blink-text ">LOTUS 2 BHK FLAT For Sale@Madipakkam </h1>
            <a class="book-now-btn" href="flats.php" target="_blank">Book
               Now</a>
         </div>
         <a href="pricing.php" type="button" class="flash " style="float:right">Special Offers</a>

      </div>
      <div class="mainmenu-area">
         <div class="" style="background: #121d25 none repeat scroll 0 0;
    min-height: 55px;padding-right: 15px;
    padding-left: 15px;">
            <!-- -->
            <div class="row">
               <div class="col-md-12">
                  <div class="mainmenu">
                     <ul id="construct_navigation">
                        <li class="current-page-item"><a href="index.php">Home</a></li>
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
                        style="width:250px; height:50px;border-radius:5px;float:right;margin-top:-50px;" />
                  </div>
                  <!-- Responsive Menu End -->
               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- Header Area End -->
   <main class=" mainsection">
      <section class="swiper">
         <div class="hero swiper-wrapper">
            <div class="swiper-slide ">
               <div class="overlay-black"></div>
               <img class="hero-img" src="assets/img/slider/slide-1.jpg" alt="Hero">
               <p class="hero-super">NEW<br /><span style="color:#fbb908"> CONSTRUCTION</span><br />
               </p>
            </div>
            <div class="swiper-slide">
               <div class="overlay-black"></div>
               <img class="hero-img" src="assets/img/slider/slide-2.jpg" alt="Hero">
               <p class="hero-super">RENOVATION OF EXISTING <br /><span style="color:#fbb908">HOMES</span> </p>
            </div>
            <div class="swiper-slide">
               <div class="overlay-black"></div>
               <img class="hero-img" src="assets/img/slider/slide-2.jpg" alt="Hero">
               <p class="hero-super">COMPLETE INTERIOR<span style="color:#fbb908"> SOLUTIONS</span> </p>
               <!-- <a href="contact.php" class="construct-btn" style="box-shadow: 2px 2px 10px grey;">Get a
                  Quote</a> -->
            </div>
            <nav class="nav-carousel">
               <button class="button-prev">
                  <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path
                        d="M8 16L7.64645 15.6464L7.29289 16L7.64645 16.3536L8 16ZM23 16.5C23.2761 16.5 23.5 16.2761 23.5 16C23.5 15.7239 23.2761 15.5 23 15.5V16.5ZM13.6464 9.64645L7.64645 15.6464L8.35355 16.3536L14.3536 10.3536L13.6464 9.64645ZM7.64645 16.3536L13.6464 22.3536L14.3536 21.6464L8.35355 15.6464L7.64645 16.3536ZM8 16.5H23V15.5H8V16.5Z"
                        fill="white" />
                     <circle cx="16" cy="16" r="15.5" stroke="white" />
                  </svg>
               </button>
               <div class="pagination">
               </div>
               <button class="button-next">
                  <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path
                        d="M24.6667 16L25.0202 16.3536L25.3738 16L25.0202 15.6464L24.6667 16ZM9.66666 15.5C9.39051 15.5 9.16666 15.7239 9.16666 16C9.16666 16.2761 9.39051 16.5 9.66666 16.5V15.5ZM19.0202 22.3536L25.0202 16.3536L24.3131 15.6464L18.3131 21.6464L19.0202 22.3536ZM25.0202 15.6464L19.0202 9.64645L18.3131 10.3536L24.3131 16.3536L25.0202 15.6464ZM24.6667 15.5L9.66666 15.5V16.5H24.6667V15.5Z"
                        fill="white" />
                     <circle cx="16.6667" cy="16" r="15.5" transform="rotate(180 16.6667 16)" stroke="white" />
                  </svg>
               </button>
            </nav>
         </div>
      </section>
      <section class="sign-up" style="
">
         <div class="banner-form ">
            <h1>Get started</h1>
            <form onsubmit="return validateForm();" id="contactForm" action="" method="POST">
               <div class="row">
                  <div class="col-md-6">
                     <p>
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name..."
                           required>
                     </p>
                  </div>
                  <div class="col-md-6">
                     <p>
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                           placeholder="Your Email Address...">
                     </p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <p>
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject"
                           placeholder="Your Subject...">
                     </p>
                  </div>
                  <div class="col-md-6">
                     <p>
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                           title="Please enter valid phone number" placeholder="Your Phone..." autocomplete="off"
                           required>
                     </p>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <textarea id="message" type="text" class="form-control" name="message" rows="3" cols="60"
                        placeholder="Write Your Message Here..."></textarea>
                  </div>
               </div>
               <?php
               $a = rand(1, 10);
               $b = rand(1, 10);
               $c = $a + $b;
               ?>
               <div class="row">
                  <div class="col-md-6">
                     <label style="">
                        Captcha
                        <?php echo $a . "+" . $b; ?>
                     </label>
                     <input type="number" class="form-control" id="captcha" name="captcha"
                        placeholder="Enter the answer" required>
                     <input type="hidden" id="captcha_ans" name="captcha_ans" value="<?php echo $c; ?>" required>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <p>
                        <button class="btn btn-success" name="submit">Submit</button>
                     </p>
                  </div>
               </div>
            </form>
            <div id="messageContainer" style="display: none;">
               <p id="successMessage" style="color: green;"></p>
               <p id="errorMessage" style="color: red;"></p>
            </div>
         </div>
      </section>
   </main>
   <!-- Slider Area Start -->
   <!-- <section class="construct-slider-area">
      <div class="construct-slide">
         <div class="construct-main-slide slide-item-1">
            <div class="construct-main-caption">
               <div class="construct-caption-cell">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-6 p-5 d-flex justify-content-center align-items-center flex-column">
                           <div class="align-self-center">
                              <h2>New<span>Construction</span></h2><br>
                              <a href="contact.php" class="construct-btn" style="box-shadow: 2px 2px 10px grey;">Get a
                                 Quote</a>
                           </div>
                        </div>
                        <div class="col-md-6 slide-form ml-auto" style="background-color:black;opacity: 0.7;">
                           <form action="" method="post" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="col-md-6">
                                    <p>
                                       <label for="name">Name</label>
                                       <input type="text" class="form-control" name="name" placeholder="Your Name..."
                                          required>
                                    </p>
                                 </div>
                                 <div class="col-md-6">
                                    <p>
                                       <label for="email">Email</label>
                                       <input type="email" class="form-control" name="email"
                                          placeholder="Your Email Address...">
                                    </p>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <p>
                                       <label for="subject">Subject</label>
                                       <input type="text" class="form-control" name="subject"
                                          placeholder="Your Subject...">
                                    </p>
                                 </div>
                                 <div class="col-md-6">
                                    <p>
                                       <label for="phone">Phone</label>
                                       <input type="text" class="form-control" name="phone" minlength="10"
                                          placeholder="Your Phone..." autocomplete="off" required>
                                    </p>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                    <textarea id="message" name="message" rows="3" cols="60"
                                       placeholder="Write Your Message Here..."></textarea>
                                 </div>
                              </div>
                              <?php
                              $a = rand(1, 10);
                              $b = rand(1, 10);
                              $c = $a + $b;
                              ?>
                              <div class="row">
                                 <div class="col-md-6">
                                    <label style="color:white;font-size:15px;">
                                       <?php echo $a . "+" . $b; ?>
                                    </label>
                                    <input type="number" class="form-control" name="captcha"
                                       placeholder="Enter the answer" required>
                                    <input type="hidden" name="captcha_ans" value="<?php echo $c; ?>" required>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <p>
                                       <button type="submit" class="btn btn-success" name="mail">Submit</button>
                                    </p>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="construct-main-slide slide-item-2">
            <div class="construct-main-caption">
               <div class="construct-caption-cell">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12 text-center">
                           <h2>Renovation of Existing Homes </h2><br>
                           <a href="contact.php" class="construct-btn" style="box-shadow: 2px 2px 10px grey;">Get a
                              Quote</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="construct-main-slide slide-item-3">
            <div class="construct-main-caption">
               <div class="construct-caption-cell">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12 text-center">
                           <h2><span>Complete Interior Solutions</span></h2><br>
                           <a href="contact.php" class="construct-btn" style="box-shadow: 2px 2px 10px grey;">Get a
                              Quote</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section> -->
   <!-- Slider Area End -->
   <!-- About Bottom Area Start -->
   <section class="construct-about-bottom-area">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="about-bottom-left section_100">
                  <h1>We Welcome You</h1><br>
                  <div class="about-bottom-one">
                     <h3>About us and our priorities</h3>
                     <p style="text-align:justify">Saraswathi Constructions an Engineering and Consultancy company
                        handled by Professionals is Building Projects in and around Chennai.
                        House construction in chennai @ affordable price, chat with us and get contractor or builder
                        help.
                        We do interior for your dream house construction and get free interior design planning </p>
                     <br />
                     <p>We are a construction group with an outstanding track record. Our number of constructions using
                        branded products in and around the city speaks volumes about its Perfection, Aesthetic elegance,
                        and user-friendly setup. New House construction contractor or Renovation construction company in
                        Chennai or Professional buildings construction @ affordable price, we are one of best house
                        construction contractors or builders in Chennai near Velachery, Madipakkam, Chrompet, Tambaram,
                        Pallavaram
                     <ul style="  list-style: square outside none;">
                        <li><span>&#10003;</span>
                           Assured Quality </li>
                        <li><span>&#10003;</span>
                           Quick Turnaround </li>
                        <li><span>&#10003;</span>
                           Best Service </li>
                     </ul>
                     </p><br />
                     <p><b>Mission : </b>To Deliver Quality Buildings</p>
                     <p><b>Vission &nbsp: </b>To Serve the Humankind</p>
                  </div>
                  <div class="about-bottom-right clearfix row">
                     <div class="col-md-6 col-sm-6">
                        <div class="about_list">
                           <div class="single-about-list">
                              <div class="about_icon">
                                 <i class="fa fa-building-o"></i>
                              </div>
                              <div class="about_text">
                                 <h4>New Modern Technologies</h4>
                                 <p>New Model Homes</p>
                              </div>
                           </div>
                           <div class="single-about-list">
                              <div class="about_icon">
                                 <i class="fa fa-users"></i>
                              </div>
                              <div class="about_text">
                                 <h4>Best Customer Reviews</h4>
                                 <p>Assured Reviews</p>
                              </div>
                           </div>
                           <div class="single-about-list">
                              <div class="about_icon">
                                 <i class="fa fa-sitemap"></i>
                              </div>
                              <div class="about_text">
                                 <h4>Professional Team Work</h4>
                                 <p>120+ workers</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-6">
                        <div class="about_list">
                           <div class="single-about-list">
                              <div class="about_icon">
                                 <i class="fa fa-trophy"></i>
                              </div>
                              <div class="about_text">
                                 <h4>Quality is Our Pride</h4>
                                 <p>Best Quality in the Market</p>
                              </div>
                           </div>
                           <div class="single-about-list">
                              <div class="about_icon">
                                 <i class="fa fa-shield"></i>
                              </div>
                              <div class="about_text">
                                 <h4>Awesome Stuff</h4>
                                 <p>High End Specification</p>
                              </div>
                           </div>
                           <div class="single-about-list">
                              <div class="about_icon">
                                 <i class="fa fa-cogs"></i>
                              </div>
                              <div class="about_text">
                                 <h4>Good Planning</h4>
                                 <p>Best Architecture Plan and Elevation</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- About Bottom Area End -->
   <!-- Service Area Start -->
   <section class="construct-service-area section_100">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="section-heading ">
                  <h2>Our Services</h2>
                  <p>We take up Projects from scratch to finish, from discussion to design, coordination with our
                     Architect / Consultant and implementation of ideas at site. We bring into our Engineering Expertise
                     to make the whole process simple and cost effective.</p>
               </div>
            </div>
         </div>
         <div class="row ">
            <div class="col-md-4 ">
               <div class="single-service">
                  <div class="service-image ">
                     <a href="services.php">
                        <img src="assets/img/our_services/service-1.jpg" />
                     </a>
                  </div>
                  <div class="service-text">
                     <h3><a href="services.php">New Residential Buildings</a></h3><br><br>
                     <p class="text-justify">'New build' is a term that denotes new construction of all types of
                        structures such as houses, apartments, office blocks and so on.</p>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="single-service">
                  <div class="service-image">
                     <a href="services.php">
                        <img src="assets/img/our_services/service-2.jpg" />
                     </a>
                  </div>
                  <div class="service-text">
                     <h3><a href="services.php">Renovation of Existing Homes</a></h3>
                     <p class="text-justify">Renovation is the process of improving a broken or outdated structure.
                        Renovations are of commercial or residential type. </p>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="single-service">
                  <div class="service-image">
                     <a href="services.php">
                        <img src="assets/img/our_services/service-3.jpg" />
                     </a>
                  </div>
                  <div class="service-text">
                     <h3><a href="services.php">Complete Interior Solutions</a></h3><br>
                     <p class="text-justify">At Interior Solutions, our services represent our investment in excellence.
                        Well design to your specifications, cater to your success.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Service Area End -->
   <!-- Recent Project Area Start -->
   <section class="construct-project-page-area section_100">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="section-heading">
                  <h2>Portfolio</h2>
                  <p>We are committed to serve in order to fit your needs.<br>Have a look at some of our recent project
                     and greatest jobs below.</p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="construct-isotope-project">
                  <div class="projectFilter project-btn">
                     <a href="#" data-filter="*" class="current">show all</a>
                     <a href="#" data-filter=".new">New construction</a>
                     <a href="#" data-filter=".renovation">Renovation</a>
                     <a href="#" data-filter=".interior">Interior Solution</a>
                  </div>
                  <div class="row">
                     <div class="col-md-12 mb-4">
                        <div class="clearfix projectContainer projectContainer3column">
                           <div class="element-item new">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/building/new_4.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item new">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/building/new_5.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item new">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/building/new_1.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item new">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/building/new_2.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item new">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/building/new_3.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/1.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior ">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/2.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/3.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/4.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/6.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/7.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/8.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/9.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/10.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/11.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/12.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/13.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item interior">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/interior/14.jpg" class="img-responsive" alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item renovation">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/renovation/renow1.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item renovation">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/renovation/renow2.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item renovation">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/renovation/renow4.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item renovation">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/renovation/renow5.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                           <div class="element-item renovation">
                              <div class="project-single-item img-contain-isotope">
                                 <a href="portfolia.php">
                                    <img src="assets/img/portfolia/renovation/renow6.jpg" class="img-responsive"
                                       alt="Image">
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Recent Project Area End -->
   <!-- Hire Area Start -->
   <header class="construct-hire-area">
      <div class="hire-bg"></div>
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="construct-hire-left">
                  <div class="hire-overlay"></div>
                  <br>
                  <h3><strong>13+</strong> Years Experience in Constructions Industry</h3>
                  <div class="hire-icon">
                     <br> <br> <i class="fa fa-trophy" aria-hidden="true" style="margin-top:25px;"></i>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="construct-hire-right">
                  <div class="review-widget_net" data-uuid="2c812762-98b9-4de2-9a02-60fc40fcbe97" data-template="8"
                     data-filter="" data-lang="en" data-theme="light">
                     <center>
                  </div>
                  <script async type="text/javascript" src="https://grwapi.net/widget.min.js"></script>
               </div>
            </div>
         </div>
      </div>
   </header>
   <!-- Hire Area End -->
   <!-- Quote Area Start -->
   <section class="construct-quote-area section_100">
      <div class="container">
         <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-7">
               <div class="quote-right">
                  <div class="section-heading">
                     <h3> Our Service Area </h3>
                     <p> Adambakkam, Madipakkam, Ullagarm, Pallikaranai, Velachery, Medavakkam, Puzhutivakkam, Tambaram
                        and All Over Chennai city </p><br />
                     <h4>contact us soon</h4>
                     <h3 style="font-size: 30px;"><b>Quality.Safety.Experience </b></h3><br>
                     <p class="text-justify">Saraswathi Constructions have plenty of opportunity to expand our
                        procedures based on industry experience. Saraswathi Constructions has a reputation for quality
                        building. The key to attain the results you desire is by the support of our clients throughout
                        the process. Saraswathi Constructions is a true partner in the constructions process since your
                        goals become our aims. To complete the work, we collaborate with skilled local trade partners
                        and ensure that our safety and quality requirements are met.</p>
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
                  <form onsubmit="return validateForm1();" id="contactForm1" action="" method="POST">
                     <div class="row">
                        <div class="col-md-6">
                           <p>
                              <label for="name">Name</label>
                              <input type="text" name="name" id="name1" placeholder="Your Name..." required>
                           </p>
                        </div>
                        <div class="col-md-6">
                           <p>
                              <label for="email">Email</label>
                              <input type="email" name="email" id="email1" placeholder="Your Email Address...">
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
                              <input type="number" id="phone1" name="phone" minlength="10" placeholder="Your Phone..."
                                 autocomplete="off" required>
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
                           <input type="number" name="captcha" id="captcha1" placeholder="Enter the answer" required>
                           <input type="hidden" name="captcha_ans" id="captcha_ans1" value="<?php echo $c; ?>" required>
                        </div>
                     </div><br>
                     <div class="row">
                        <div class="col-md-12">
                           <p>
                              <button>request quote</button>
                           </p>
                        </div>
                     </div>
                     <div id="messageContainer1" style="display: none;">
                        <p id="successMessage1" style="color: green;"></p>
                        <p id="errorMessage1" style="color: red;"></p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Quote Area End -->
   <section>
   </section>
   <div id="wpac-comment"></div>
   <section class="construct-latest-blog-area section_t_100 section_b_70">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="section-heading">
                  <h2>Latest Blog Post</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <?php
            while ($row_blog = mysqli_fetch_array($result_blog)) {
               ?>
               <div class="col-md-4 text-justify">
                  <div class="single-blog ">
                     <div class="blog-img">
                        <a href="blog_detail.php?blog_id=<?php echo $row_blog['id']; ?>"><img
                              src="<?php echo "admin/images/" . $row_blog['image']; ?>" alt="blog-image"
                              style="width: 100%; height: 200px;" /></a>
                     </div>
                     <div class="blog-heading">
                        <h3><a href="blog_detail.php?blog_id=<?php echo $row_blog['id']; ?>">
                              <?php echo $row_blog['title']; ?>
                           </a></h3>
                     </div>
                     <div class="blog-comnt">
                        <p style="font-size:14px;"><i class="fa fa-user"></i> Admin</p>
                        <p style="font-size:14px;"><i class="fa fa-calendar"></i>
                           <?php echo $row_blog['date']; ?>
                        </p>
                     </div>
                     <div class="blog-details">
                        <?php $description = $row_blog['des']; ?>
                        <p class="text-justify">
                           <?php echo $text = implode(' ', array_slice(explode(' ', $description), 0, 26)); ?><a
                              href="blog_detail.php?blog_id=<?php echo $row_blog['id']; ?>" class="text-warning"> read
                              more</a>
                        </p>
                     </div>
                  </div>
               </div>
               <?php
            }
            ?>
         </div>
      </div>
      <br>
      <h2 align="center">Thanking You All..!</h2>
   </section>
   <!-- Latest Blog Area End -->
   <!-- Footer Area Start -->
   <?php
   include('footer.php');
   ?>
   <!-- Footer Area End -->
   <!-- Modal -->
   <div style="margin-top: -50px;" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header bg-light">
               <h4 class="modal-title" id="exampleModalLabel"> <i class="fa fa-pencil" aria-hidden="true"></i><span>
                     Saraswathi Constructions </span></h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="construct-contact-form-right">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-md-6">
                           <p>
                              <label for="name">Name</label>
                              <input type="text" name="name" autocomplete="off" required>
                           </p>
                        </div>
                        <div class="col-md-6">
                           <p>
                              <label for="email">Email</label>
                              <input type="email" name="email">
                           </p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <p>
                              <label for="subject">Subject</label>
                              <input type="text" name="subject">
                           </p>
                        </div>
                        <div class="col-md-6">
                           <p>
                              <label for="phone">Phone</label>
                              <input type="text" name="phone" minlength="10" autocomplete="off" required>
                           </p>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <p>
                              <label for="msg">How can we help you...</label>
                              <textarea id="message" name="message"></textarea>
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
                           <label for="msg">Solve </label> <br>
                           <h2>
                              <?php echo $a . "+" . $b; ?>
                           </h2>
                           <input type="number" name="captcha" placeholder="Enter the answer" required>
                           <input type="hidden" name="captcha_ans" value="<?php echo $c; ?>" required>
                        </div>
                     </div><br>
                     <div class="row">
                        <div class="col-md-12">
                           <p>
                              <button type="submit" name="mail" class="btn-block shadow-sm">Get a Quote</button>
                           </p>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
         integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
         crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
         integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
         crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
         integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
         crossorigin="anonymous"></script>
      <script>
         $(document).ready(function () {
            $('#exampleModal').modal('hide');
         });
      </script>

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
      <script>const swiper = new Swiper(".swiper", {
            pagination: {
               el: ".pagination",
            },
            navigation: {
               nextEl: ".button-next",
               prevEl: ".button-prev",
            }, autoplay: {
               delay: 5000, // Adjust the delay (in milliseconds) between slides
               disableOnInteraction: false, // Autoplay will not be disabled after user interactions
            },
            effect: "fade",
            loop: true,
         });
      </script>
      <script>
         function validateForm() {
            var name = document.getElementById('name').value;
            var phone = document.getElementById('phone').value;
            var captcha = document.getElementById('captcha').value;
            var captchaAns = document.getElementById('captcha_ans').value;
            var message = document.getElementById('message').value;
            var subject = document.getElementById('subject').value;
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

      <script>
         function validateForm1() {

            var name = document.getElementById('name1').value;
            var phone = document.getElementById('phone1').value;
            var captcha = document.getElementById('captcha1').value;
            var captchaAns = document.getElementById('captcha_ans1').value;

            var phoneRegex = /^[0-9]{10}$/;

            if (name === '' || captcha === '') {
               displayMessage1('errorMessage1', 'Name and Captcha are required fields!');
               return false;
            } else if (!phoneRegex.test(phone)) {
               displayMessage1('errorMessage1', 'Please enter a valid 10-digit phone number.');
               return false;
            } else if (captcha !== captchaAns) {
               displayMessage1('errorMessage1', 'Captcha verification failed. Please try again.');
               return false;
            } else {
               displayMessage1('successMessage1', 'Form submitted successfully!');
               submitForm1(); // Function to handle form submission
               return true;
            }
         }

         function displayMessage1(elementId, message) {
            var element = document.getElementById(elementId);
            element.innerText = message;

            var messageContainer1 = document.getElementById('messageContainer1');

            // Hide both messages initially
            document.getElementById('successMessage1').style.display = 'none';
            document.getElementById('errorMessage1').style.display = 'none';

            // Display the appropriate message based on messageType
            if (elementId === 'successMessage1') {
               document.getElementById('successMessage1').style.display = 'block';
            } else if (elementId === 'errorMessage1') {
               document.getElementById('errorMessage1').style.display = 'block';
            }

            // Display the message container
            messageContainer1.style.display = 'block';
         }

         function submitForm1() {
            document.getElementById('contactForm1').submit();
         }
      </script>


</body>

</html>