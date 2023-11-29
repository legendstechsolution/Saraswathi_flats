<?php 
include('connection.php');

    
    session_start();
    
    $admin= $_SESSION['login'];
    
    if($admin != 'admin')
    {
         echo "<script>window.location='admin.php'</script>";
    }




    if(isset($_GET['edit_id']))
	{
	    $edit_id = $_GET['edit_id'];
	    
        $sql_edit = "SELECT * FROM scs_blog WHERE id= '$edit_id' ";
        $result_edit = mysqli_query($conn, $sql_edit);
	}
    
    

    if(isset($_POST['update']))
	{
	   
	    $no_image = $_FILES['level_image']['name'];
	    $level_image=rand(0,99999)."_".$_FILES['level_image']['name'];
       
        //Main Image
        $tpath='admin/images/'.$level_image;        
        move_uploaded_file($_FILES["level_image"]["tmp_name"], $tpath);    

        $id = $_POST['id'];
	    $title = $_POST['title'];
	    $description = $_POST['description'];
	    $image = $level_image;
	    
	    if($no_image != '')
        {
     	
    	    $sql_update = "UPDATE scs_blog SET title='$title', des='$description', image='$image' WHERE id= '$id'";
    	    $result_update = mysqli_query($conn, $sql_update);
        }
        else
        {
          echo  $sql_update = "UPDATE scs_blog SET title='$title', des='$description' WHERE id= '$id'";
    	    $result_update = mysqli_query($conn, $sql_update);
        }
        
        if($result_update)
    		{
    		  echo "<script>";
              echo "alert ('Blog Updated Sucessfully!')";
              echo "</script>";
              echo "<script>window.location='blog_view.php'</script>";
           	}else
           	{
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
                        <a href="index.html">
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
                           <li><a href="blog_view.php">Blog List</a></li>
                           <li><a href="add_blog.php">Add Blog</a></li>
                           <li><a href="mail.php">Mail</a></li>
                           <li><a href="logout.php">Logout</a></li>
                        </ul>
                     </div>
                     <!-- Responsive Menu Start -->
                     <div class="construct-responsive-menu"></div>
                     <!-- Responsive Menu End -->
                  </div>
                  <div class="col-md-2">
                     <div class="search_icon"  data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-search"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- Header Area End -->



      <!-- blog Area start -->
       
         <section class="construct-blog-page-area section_100">
         <div class="container">
             <h2 style="color:red;">Edit Blog</h2><br>
            <div class="row">
               <div class="col-md-12">
                 <?php
                    $users_row = mysqli_fetch_array($result_edit);
                ?>   
                   
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $users_row['id']; ?>">
                    
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-1">
                                <b>Title: </b>
                            </div>
                            <div class="col-md-7">
                              <input type="text" name="title" class="form-control" value="<?php echo $users_row['title']; ?>">
                            </div>
                      </div><br>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-1">
                                <b>Description: </b>
                            </div>
                            <div class="col-md-7">
                              <textarea type="text" name="description" rows="4"  class="form-control" > <?php echo $users_row['des']; ?> </textarea>
                        </div>
                      </div><br>
                      
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-1">
                                <b>Image: </b>
                            </div>
                            <div class="col-md-7">
                                <input type="file" name="level_image" value="fileupload" class="form-control" >
                                <img src= "<?php echo "admin/images/".$users_row['image']; ?>" style="width: 100%; height: 300px;" > 
                            </div>
                      </div><br>
                      
                  <button  type="submit" name="update" class="btn btn-warning bg-center">Update</button>
                  
                </form>
              </div>
            </div>
          </div>
        </section>
      <!-- blog Area end -->
      
      
    <!-- Footer Area Start -->
             <?php
                include('footer_admin.php');    
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
                                 <button  type="submit">
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





