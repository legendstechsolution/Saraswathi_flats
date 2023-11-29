<?php
include('connection.php');


$sql_blog = "SELECT * FROM scs_blog ORDER BY id DESC";
$result_blog = mysqli_query($conn, $sql_blog);



if (isset($_POST['submit'])) {
   $search = $_POST['search'];

   $sql123 = "SELECT * FROM scs_blog WHERE title like '%" . addslashes($_POST['search']) . "%' ORDER BY id ASC ";
   $result_blog = mysqli_query($conn, $sql123);
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
                              <li><a href="contact.php">Contact Us</a></li>
                              <li class="current-page-item"><a href="blog.php">Blog</a></li>
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
                  <h2>Blog</h2>
                  <ul>
                     <li><a href="index.php">home</a></li>
                     <li>/</li>
                     <li>blog</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Breadcromb Area End -->

   <!-- Blog Page Area Start -->
   <section class="construct-blog-page-area section_100">
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="blog-page-left">
                  <div class="row">
                     <?php
                     while ($row_blog = mysqli_fetch_array($result_blog)) {
                        ?>
                        <div class="col-md-12">
                           <div class="single-blog blog-page-post">
                              <div class="blog-img">
                                 <a href="blog_detail.php?blog_id=<?php echo $row_blog['id']; ?>"><img
                                       src="<?php echo "admin/images/" . $row_blog['image']; ?>" alt="blog-image" /></a>
                              </div>
                              <div class="blog-heading">
                                 <h3><a href="blog_detail.php?blog_id=<?php echo $row_blog['id']; ?>">
                                       <?php echo $row_blog['title']; ?>
                                    </a></h3>
                              </div>
                              <div class="blog-comnt">
                                 <p><i class="fa fa-user"></i> Admin</p>
                                 <p><i class="fa fa-calendar"></i>
                                    <?php echo $row_blog['date']; ?>
                                 </p>
                              </div>
                              <div class="blog-details">
                                 <?php $description = $row_blog['des']; ?>
                                 <p class="text-justify">
                                    <?php echo $text = implode(' ', array_slice(explode(' ', $description), 0, 50)); ?>
                                    <a href="blog_detail.php?blog_id=<?php echo $row_blog['id']; ?>" class="text-warning">
                                       read more</a>
                                 </p>
                              </div>
                           </div>
                        </div>
                     <?php } ?>

                  </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="construct-shop-right margin-top">
                  <div class="construct-shop-widget">
                     <h3>Search</h3>

                     <form method="post">
                        <input class="border" placeholder="Keywords..." type="search" name="search" />
                        <button type="submit" name="submit">
                           <i class="fa fa-search"></i>
                        </button>
                     </form>

                  </div>


                  <div class="construct-shop-widget">
                     <h3>Recent Blog</h3>
                     <?php

                     $sql_blog1 = "SELECT * FROM scs_blog ORDER BY id DESC";
                     $result_blog1 = mysqli_query($conn, $sql_blog1);

                     while ($row_blog1 = mysqli_fetch_array($result_blog1)) {
                        ?>
                        <ul class="related-shop-pro">
                           <li>
                              <div class="pro-img">
                                 <img src="<?php echo "admin/images/" . $row_blog1['image']; ?>"
                                    style="width:60px; height: 60px;" />
                              </div>
                              <div class="pro-text">
                                 <h4><a href="blog.php?blog_id=<?php echo $row_blog1['id']; ?>">
                                       <?php echo $row_blog1['title']; ?>
                                    </a></h4>
                                 <p class="pro-price"><small>
                                       <?php echo $row_blog1['date']; ?>
                                    </small></p>
                              </div>
                           </li>
                        </ul>
                        <?php
                     }
                     ?>

                  </div>

               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Blog Page Area End -->


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