<?php
include('connection.php');

if (isset($_GET['blog_id'])) {
   $blog_id = $_GET['blog_id'];
   $sql_blog = "SELECT * FROM scs_blog WHERE id='$blog_id' ORDER BY id DESC";
   $result_blog = mysqli_query($conn, $sql_blog);
}

if (isset($_POST['comment'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $content = $_POST['content'];

   $sql = "INSERT INTO scs_comment (blog_id, name, email, comment) VALUES('$blog_id', '$name', '$email', '$content')";
   $result = mysqli_query($conn, $sql);

   if ($result) {
      echo ("<script LANGUAGE='JavaScript'>
    	  window.alert('Comment Posted Sucessfully');
    	  window.location.href='blog_detail.php?blog_id=$blog_id';
    	  </script>");
   } else {
      echo ("<script LANGUAGE='JavaScript'>
    	  window.alert('Comment failed');
    	  window.location.href='blog_detail.php';
    	  </script>");
   }

}


if (isset($_POST['reply1'])) {
   $r_name = $_POST['r_name'];
   $r_email = $_POST['r_email'];
   $r_reply = $_POST['r_reply'];
   $r_comment_id = $_POST['comment_id_1'];

   $sql_r = "INSERT INTO scs_reply (blog_id, comment_id, name, email, reply) VALUES('$blog_id', '$r_comment_id', '$r_name', '$r_email', '$r_reply')";
   $result_r = mysqli_query($conn, $sql_r);

   if ($result_r) {
      echo ("<script LANGUAGE='JavaScript'>
    	  window.alert('Replied Sucessfully');
    	  window.location.href='blog_detail.php?blog_id=$blog_id'+'#comment';
    	  </script>");
   } else {
      echo mysqli_error($conn);
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
</head>

<body>



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
               <div class="col-lg-5 col-md-5 col-sm-5">
                  <div class="construct-logo">
                     <a href="index.php">
                        <img src="assets/img/scs_logo.png" class="img-fluid" alt="site logo"
                           style="width:400px; height:80px;" />
                     </a>
                  </div>
               </div>
               <div class="col-lg-7 col-md-7 col-sm-7">
                  <div class="logoright-section">
                     <div class="single-logo-right">
                        <div class="logo-right-icon">
                           <i class="fa fa-phone"></i>
                        </div>
                        <div class="logo-right-text">
                           <a href="tel:+91 80727 98551">
                              <h4>Call us</h4>
                              <p>+91 80727 98551</p>
                           </a>
                        </div>
                     </div>
                     <div class="single-logo-right">
                        <div class="logo-right-icon">
                           <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="logo-right-text">
                           <a href="mailto:nanandn@gmail.com">
                              <h4>Mail us</h4>
                              <p>nanandn@gmail.com</p>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="mainmenu-area">
         <div class="container">
            <div class="row">
               <div class="col-md-10">
                  <div class="mainmenu">
                     <ul id="construct_navigation">
                        <li><a href="index.php">home</a></li>
                        <li><a href="services.php">Our Services</a></li>
                        <li><a href="portfolia.php">Portfolio</a></li>
                        <li><a href="pricing.php">Pricing</a></li>
                        <li class="current-page-item">
                           <a href="#">More</a>
                           <ul>
                              <li><a href="contact.php">Contact US</a></li>
                              <li class="current-page-item"><a href="blog.php">Blog</a></li>
                           </ul>
                        </li>
                     </ul>
                  </div>
                  <!-- Responsive Menu Start -->
                  <div class="construct-responsive-menu"></div>
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
                                 <img src="<?php echo "admin/images/" . $row_blog['image']; ?>" alt="blog-image" />
                              </div>
                              <div class="blog-heading">
                                 <h3>
                                    <?php echo $row_blog['title']; ?>
                                 </h3>
                              </div>
                              <div class="blog-comnt">
                                 <p><i class="fa fa-user"></i> Admin</p>
                                 <p><i class="fa fa-calendar"></i>
                                    <?php echo $row_blog['date']; ?>
                                 </p>
                              </div>
                              <div class="blog-details">
                                 <p class="text-justify">
                                    <?php echo $row_blog['des']; ?>
                                 </p><br>

                                 <!-----like start------->
                              <script src="https://use.fontawesome.com/fe459689b4.js"></script>
                              <input type="hidden" id="blog_id" value="<?php echo $row_blog['id']; ?>">

                              <button class="btn" id="green"><i class="fa fa-thumbs-up fa-lg"
                                    aria-hidden="true"></i></button>

                              <button class="btn" id="red"><i class="fa fa-thumbs-down fa-lg"
                                    aria-hidden="true"></i></button><br>

                              <?php
                              $ids = $row_blog['id'];
                              ;
                              $sql123 = "SELECT * FROM blog_liked WHERE blog_id='$ids'";
                              $res123 = mysqli_query($conn, $sql123);
                              $count = mysqli_num_rows($res123);
                              $count_fet = mysqli_fetch_assoc($res123);


                              ?>

                              <span style="margin-left:10px;" id="like">
                                 <?php echo $count_fet['likes']; ?>
                              </span> <span style="margin-left:40px;" id="dislike">
                                 <?php echo $count_fet['dislikes']; ?>
                              </span>



                              <style>
                                 button {
                                    cursor: pointer;
                                    outline: 0;
                                    color: #AAA;

                                 }

                                 .btn:focus {
                                    outline: none;
                                 }

                                 .green {
                                    color: green;
                                 }

                                 .red {
                                    color: red;
                                 }
                              </style>

                              <script>
                                 var btn1 = document.querySelector('#green');
                                 var btn2 = document.querySelector('#red');

                                 btn1.addEventListener('click', function () {

                                    if (btn2.classList.contains('red')) {
                                       btn2.classList.remove('red');
                                    }
                                    this.classList.toggle('green');

                                    var blog_id = $('#blog_id').val();

                                    $.ajax({
                                       url: "blog_like.php",
                                       type: "POST",
                                       data: {
                                          blog_id: blog_id


                                       },
                                       cache: false,
                                       success: function (dataResult) {


                                          var dataResult = JSON.parse(dataResult);
                                          //	if(dataResult.statusCode==200){

                                          $('#like').text(dataResult.statusCode);





                                          //	}


                                       }
                                    });


                                 });

                                 btn2.addEventListener('click', function () {

                                    if (btn1.classList.contains('green')) {
                                       btn1.classList.remove('green');
                                    }
                                    this.classList.toggle('red');



                                    var blog_id = $('#blog_id').val();

                                    $.ajax({
                                       url: "blog_dislike.php",
                                       type: "POST",
                                       data: {
                                          blog_id: blog_id


                                       },
                                       cache: false,
                                       success: function (dataResult) {


                                          var dataResult = JSON.parse(dataResult);
                                          $('#dislike').text(dataResult.statusCode);


                                       }
                                    });

                                 });


                              </script>


                              <!------like end------>

                                 <!-----blog comment start----->
                              <br><br><br>
                              <div class="col-md-9">
                                 <div class="construct-contact-form-right">


                                    <form action="" method="post" enctype="multipart/form-data">
                                       <div class="row ">
                                          <div class="col-md-12" style="margin-top: -30px;">
                                             <p>Post Your Comment...</p>
                                             <p>
                                                <input type="text" name="name" placeholder="Your Name..."
                                                   autocomplete="off" required>
                                             </p>
                                          </div>
                                          <div class="col-md-12">
                                             <p>
                                                <input type="email" name="email" placeholder="Your Email Address..."
                                                   required>
                                             </p>
                                          </div>
                                          <div class="col-md-12">
                                             <textarea name="content" rows="3" placeholder="Comment..."></textarea>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12">
                                             <p>
                                                <button type="submit" name="comment"
                                                   class="construct-btn btn btn-sm">comment</button>
                                             </p>
                                          </div>
                                       </div>
                                    </form>

                                 </div>
                              </div><br>
                              <!-----blog comment end----->

                              <div class="container bg-light">
                                 <h5 id="comment">All Comments</h5><br>

                                 <?php
                                 $sql_c = "SELECT * FROM scs_comment WHERE blog_id='$blog_id' ORDER BY id DESC";
                                 $result_c = mysqli_query($conn, $sql_c);

                                 while ($row_c = mysqli_fetch_assoc($result_c)) {
                                    ?>
                                 <p class="pl-5 pr-5 text-danger"><b>
                                       <?php echo $row_c['name']; ?> &nbsp <small>
                                          <?php echo $row_c['date']; ?>
                                       </small>
                                    </b></p>
                                 <p class="pl-5 pr-5 text-justify text-danger">
                                    <?php echo $row_c['comment']; ?> &nbsp
                                 </p> <br>

                                 <!-----blog reply start----->

                                 <div class="container">
                                    <div class="row">
                                       <div class="col-md-8">
                                          <form action="" method="post">
                                             <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-11 ">
                                                   <p>You can reply here...</p>
                                                   </p>
                                                   <div class="form-group">
                                                      <input type="hidden" name="comment_id_1" class="form-control mb-2"
                                                         value="<?php echo $row_c['id']; ?>">
                                                      <input type="text" id="r_name" name="r_name"
                                                         class="form-control mb-2" placeholder="Name..." required>
                                                      <input type="text" id="r_email" name="r_email"
                                                         class="form-control mb-2" placeholder="Email..." required>
                                                      <textarea type="" name="r_reply" class="form-control mb-2"
                                                         placeholder="Reply..."></textarea>
                                                      <button type="submit" name="reply1"
                                                         class="btn btn-info btn-sm">Reply</button><br><br>


                                                   </div>
                                                </div>

                                             </div>


                                          </form>
                                       </div>
                                    </div>
                                 </div>

                                 <!---- reply form end----->






                                 <!---- reply start----->

                                 <div class="container">
                                    <div class="col-md-12">
                                       <div class="row">
                                          <div class="col-md-1">

                                          </div>
                                          <div class="col-md-11">
                                             <h5 id="comment">Replies</h5><br>
                                             <?php
                                             $comment_id_1 = $row_c['id'];
                                             $sql_r1 = "SELECT * FROM scs_reply WHERE blog_id='$blog_id' AND comment_id='$comment_id_1' ORDER BY id DESC";
                                             $result_r1 = mysqli_query($conn, $sql_r1);

                                             while ($row_r1 = mysqli_fetch_assoc($result_r1)) {
                                                ?>

                                             <p style="color: #ce8f00;"><b><i>
                                                      <?php echo $row_r1['name']; ?> &nbsp <small>
                                                         <?php echo $row_r1['date']; ?>
                                                      </small>
                                                   </i></b><br>
                                                <i>
                                                   <?php echo $row_r1['reply']; ?>
                                                </i>
                                             </p>

                                             <?php
                                             }
                                             ?>

                                          </div>
                                       </div>
                                    </div>
                                 </div>


                                 <hr>
                                 <?php
                                 }
                                 ?>

                              </div>
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
                     <h3>Recent Blog</h3>
                     <?php

                     $sql_blog1 = "SELECT * FROM scs_blog ORDER BY id DESC";
                     $result_blog1 = mysqli_query($conn, $sql_blog1);

                     while ($row_blog1 = mysqli_fetch_assoc($result_blog1)) {
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