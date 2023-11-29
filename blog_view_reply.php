<?php 
include('connection.php');

    session_start();
    
    $admin= $_SESSION['login'];
    
    if($admin != 'admin')
    {
         echo "<script>window.location='admin.php'</script>";
    }
    
    $reply_id = $_GET['reply_id'];
    
    
 if(isset($_GET['reply_id']))
	{
	  
	    $reply_id = $_GET['reply_id'];
	     
	    
        $sql = "SELECT * FROM scs_reply WHERE comment_id= '$reply_id' ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
	}
	
	
    if(isset($_GET['delete_id']))
	{

	    $id = $_GET['delete_id'];
	     $comment_id = $_GET['comment_id'];
	    $sql_delete = "DELETE FROM scs_reply WHERE id= '$id'";
	    $result_delete = mysqli_query($conn, $sql_delete);
	    
	    if($result_delete)
		{
		  echo "<script>";
          echo "alert ('Reply Deleted Sucessfully!')";
          echo "</script>";
          echo "<script>window.location='blog_view_reply.php?reply_id='+$comment_id</script>"; 
       	}else
       	{
       	  echo "<script>";
          echo "alert ('Delete Failed')";
          echo "</script>";
          echo "<script>window.location='blog_view_reply.php?reply_id= '+$id</script>";
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
                     <div class="header-top-right" >
                        
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
                        <img src="assets/img/logo_new.png" class="img-fluid" alt="site logo" style="width:350px; height:100px" />
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
                              <h4>call us</h4>
                              <p>+91 80727 98551</p>
                           </div>
                        </div>
                        <div class="single-logo-right">
                           <div class="logo-right-icon">
                              <i class="fa fa-envelope-o"></i>
                           </div>
                           <div class="logo-right-text">
                              <h4>Mail us</h4>
                              <p>scsinconstructions@gmail.com</p>
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
                           <li><a href="index.php">Home</a></li>
                           <li  class="current-page-item"><a href="blog_view.php">Blog List</a></li>
                           <li><a href="add_blog.php">Add Blog</a></li>
                           <li><a href="mail.php">Mail</a></li>
                           <li style="float:right; margin-right:-180px;"><a href="logout.php">Log out</a></li>
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


      <!-- list of blog start -->
        <section class="construct-blog-page-area section_100">
            
         <div class="container">
            <div class="row">
               <div class=" col-lg-12 col-md-12 col-sm-12">
                <h2 style="color:red;">Blog Reply </h2><br><br>
            
            <table class="table table-bordered table-hover">
              <thead>
                <tr class="bg-light">
				   <th>S.No</th>						 
             	   <th>Name</th>	 
                   <th>Email</th>
                   <th>Reply</th>
                   <th>Date</th>
                   <th>Action</th>
                </tr>
              </thead>
              <tbody>   
                  <?php
                    while ($row = mysqli_fetch_array($result))
                    
                    {
                    
                    ?>
                <tr>
				    <td><?php echo $i+1; ?></td>
				   	<td><?php echo $row['name']; ?></td>
				   	<td><?php echo $row['email']; ?></td>
				   	<td><?php echo $row['reply']; ?></td>
				   	<td><?php echo $row['date']; ?></td>
				   	<td>
				   	    <a href="blog_view_reply.php?delete_id=<?php echo $row['id']."&comment_id=" . $row['blog_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete ?');">Delete </a>
				   	</td>
                    
                </tr>
                    <?php
                        $i++;
                        }
                    ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    </section><br><br>
 
      <!-- list of blog end -->
 
      <!-- Footer Area Start -->
             <?php
                include('footer_admin.php');    
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





