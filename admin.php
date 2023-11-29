<?php 
include('connection.php');

    session_start();
    
	if(isset($_POST['login']))
	{
	    
	    $username = $_POST['username'];
	    $password = $_POST['password'];

 		$sql = "SELECT * FROM scs_admin WHERE username = '$username' AND password = '$password'";	
        $result = mysqli_query($conn,$sql);
          
        if($result)
		{
		  $_SESSION['login'] = "admin"; 
		    
		  echo "<script>window.location='blog_view.php'</script>";
       	}
       	else
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
   
<style>





.global-container{
    padding: 10px;
	height:100%;
	display: flex;
	align-items: center;
	justify-content: center;
	background: linear-gradient(to bottom, #cc6600 0%, #ffcc00 100%);
	
}


</style>   
    
<body>

    <div class="global-container">
    	<div class="card login-form shadow">
    	<div class="card-body shadow">
    		<h3 class="card-title text-center"><b>Login</b></h3><br>
    		<div class="card-text">
    			<!--
    			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
    			<form action="" method="post" enctype="multipart/form-data">
    				<div class="form-group  mb-4">
    					<h6>Username</h6>
    					<input type="text" name="username" class="form-control">
    				</div>
    				<div class="form-group">
    					<h6>Password</h6>
    					<input type="password" name="password" class="form-control" >
    				</div><br>
    				<button type="submit" name="login" class="btn construct-btn btn-block mb-3">Sign in</button><br>
    			</form>
    		</div>
    	</div>
      </div>
    </div>
  </body>
</html>





