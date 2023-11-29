<?php


if(!empty($_POST["from_name"]))
{
	$content_choosed = $_POST["content_type"];
	$from_email = $_POST["from_email"];
	$from_name = $_POST["from_name"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	$headers  = "From: $from_name < $from_email >\n";
	$headers .= "Cc: $from_name < $from_email >\n"; 
	$headers .= 'X-Mailer: PHP/'.phpversion();
	$headers .= "X-Priority: 1\n"; // set message priority
	$headers .= "Return-Path: $from_email\n"; // returned emails sent to this address
	$headers .= "MIME-Version: 1.0\r\n";
	if($content_choosed == 1)
	{
		$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
	}
	$emails = explode("\n", $_POST["to_emails"]);
	$emails_number = count($emails);
	$i = 0;
	
	while($i < $emails_number)
	{
		
		if(mail($emails[$i], $subject, $message, $headers))
		{
			echo "<span style='color:green'>Message has been sent successfully to : ".$emails[$i]."</span><br>";
			
		}else{
			
			echo "<span style='color:red'>Error sending message to : ".$emails[$i]."</span><br>";
		}
		
		$i++;
	}
	
}

?>

<html>

	<head>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	
	</head>

	<form method="post">
	
		<table>
		
			<tr>
			
				<td>From Name : </td> <td><input type="text" name="from_name" style="width:500px"/></td>
			
			</tr>
			
			<tr>
			
				<td>From Email : </td> <td><input type="text" name="from_email" style="width:500px"/></td>
			
			</tr>
			
			<tr>
			
				<td>Subject : </td> <td><input type="text" name="subject" style="width:500px"></td>
			
			</tr>
			
			<tr>
			
				<td>Message : </td> <td><textarea name="message" rows=30 cols=60></textarea></td> <td></td><td>To Email : <br><textarea name="to_emails" rows=29 cols=40></textarea></td>
			
			</tr>

			
			<tr>
			
				<td>Choose content type (1 from html 0 for txt) :</td> <td><input type="text" name="content_type"/></td>
			
			</tr>
			
			<tr>
			
					<td> <input type="submit" value="Start Sending" class="btn btn-primary"/> </td> <td><input type="reset" value="Reset All Fields" class="btn btn-danger"/> </td>
					
			</tr>
		
		</table>
	
	</form>

</html>