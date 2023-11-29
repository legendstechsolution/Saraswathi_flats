<?php
include('connection.php');


$sql_blog = "SELECT * FROM scs_blog ORDER BY id DESC";
$result_blog = mysqli_query($conn, $sql_blog);



if (isset($_POST['mail'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $subject = $_POST['subject'];
   $phone = $_POST['phone'];
   $message = $_POST['message'];
   $captcha = $_POST['captcha'];
   $captcha_ans = $_POST['captcha_ans'];

   if ($captcha == $captcha_ans) {


      $msg = " Name : " . $name . "\n Email : " . $email . "\n phone : " . $phone . "\n Subject : " . $subject . "\n Message : " . $message;

      mail("nanandn@gmail.com", "Mail from SCS Request", $msg);

      if ($msg) {
         echo ("<script LANGUAGE='JavaScript'>
	  window.alert('Message Sent Sucessfully');
	  window.location.href='pricing.php';
	  </script>");
      } else {
         echo ("<script LANGUAGE='JavaScript'>
	  window.alert('Message Sent failed');
	  window.location.href='pricing.php';
	  </script>");
      }

      $sql_mail = "INSERT INTO scs_mail (name, email, subject, phone, msg) VALUES('$name', '$email', '$subject', '$phone', '$message')";
      $result_mail = mysqli_query($conn, $sql_mail);
   } else {
      echo ("<script LANGUAGE='JavaScript'>
	  window.alert('Invalid Captcha Please try again');

	  </script>");
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
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="assets/css/responsive.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
   <div class="elfsight-app-c040c6d8-1075-4f3b-a503-35a07699db4b" data-elfsight-app-lazy></div> -->

   <style>
      .flash {
         background-color: #004A7F;
         -webkit-border-radius: 10px;
         border-radius: 10px;
         border: none;
         color: #FFFFFF;
         cursor: pointer;
         display: inline-block;
         font-family: Arial;
         font-size: 20px;
         padding: 5px 10px;
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
                  <a href="pricing.php" type="button" class="flash mt-3" style="float:right;">Special Offers</a>


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
                        <li class="current-page-item"><a href="index.php">Home</a></li>
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


   <!-- Slider Area Start -->
   <section class="construct-slider-area">
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
   </section>
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
                                    <img src="assets/img/portfolia/renovation/renow3.jpg" class="img-responsive"
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

                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-md-6">
                           <p>
                              <label for="name">Name</label>
                              <input type="text" name="name" placeholder="Your Name..." required>
                           </p>
                        </div>
                        <div class="col-md-6">
                           <p>
                              <label for="email">Email</label>
                              <input type="email" name="email" placeholder="Your Email Address...">
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
                              <input type="text" name="phone" minlength="10" placeholder="Your Phone..."
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
                           <input type="number" name="captcha" placeholder="Enter the answer" required>
                           <input type="hidden" name="captcha_ans" value="<?php echo $c; ?>" required>
                        </div>
                     </div><br>


                     <div class="row">
                        <div class="col-md-12">
                           <p>
                              <button type="submit" name="mail">request quote</button>
                           </p>
                        </div>
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
</body>

</html>