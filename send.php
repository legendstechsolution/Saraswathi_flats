<?php
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
        $msg = " Name : " . $name . "\n Email : " . $email . "\n phone : " . $phone . "\n Subject : " . $subject . "\n Message : " . $message;
        mail("nanandn@gmail.com", "Mail from SCS Request", $msg);
        if ($msg) {
            $alert_class = "alert-success";
            $alert_message = "Message Sent Successfully";
            $success = true;
        } else {
            $alert_class = "alert-danger";
            $alert_message = "Message Sent Failed";
        }
    } else {
        $alert_class = "alert-danger";
        $alert_message = "Invalid Captcha. Please try again.";

    }
    $sql_mail = "INSERT INTO scs_mail (name, email, subject, phone, msg) VALUES('$name', '$email', '$subject', '$phone', '$message')";
    $result_mail = mysqli_query($conn, $sql_mail);
}

?>