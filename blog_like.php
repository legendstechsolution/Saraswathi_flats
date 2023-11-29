<?php
include_once ('connection.php');
	
	$blog_id=$_POST['blog_id'];
	
	
	
	$sql123 = "SELECT * FROM blog_liked WHERE blog_id='$blog_id'";
	$res123 = mysqli_query($conn, $sql123);
    $count = mysqli_num_rows($res123);
    $count_fet = mysqli_fetch_assoc($res123);
    if($count >=1)
    {
        
        $count_fet = $count_fet['likes']+1;
        $sql123 = "update blog_liked set likes='$count_fet' where blog_id='$blog_id'";
	    $res123 = mysqli_query($conn, $sql123);
    }
    
    else
    {
        
         	$sql_like = "INSERT INTO blog_liked(blog_id,likes) VALUES('$blog_id','1')";
    	$res = mysqli_query($conn, $sql_like);
    	
    	if(!$res)
    	{
    	    echo mysqli_error($conn);
    	}
    }
    
    
    echo json_encode(array("statusCode"=>$count_fet));
       
    
   
	mysqli_close($conn);
?>