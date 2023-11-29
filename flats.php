<?php
session_start();
include('connection.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $userAnswer = isset($_POST['captcha']) ? intval($_POST['captcha']) : 0;

    // Validate CAPTCHA
    if ($userAnswer !== $_SESSION['captcha_answer']) {
        echo '<script>alert("Incorrect CAPTCHA answer!");</script>';
    } else {
        // Create the brochure_requests table if not exists
        $createTableQuery = "CREATE TABLE IF NOT EXISTS brochure_requests (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            mobile VARCHAR(15) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($conn->query($createTableQuery) !== TRUE) {
            echo "Error creating table: " . $conn->error;
            $conn->close();
            exit;
        }

        // Insert data into the brochure_requests table
        $insertDataQuery = "INSERT INTO brochure_requests (name, email, mobile) VALUES ('$name', '$email', '$mobile')";

        if ($conn->query($insertDataQuery) === TRUE) {
            $filename = "http://localhost/saraswathimain/brochure.pdf";

            echo '<script>alert("Record inserted successfully! Click the link to download the brochure.");
                  window.location.href = "' . $filename . '";</script>';
        } else {
            echo "Error: " . $insertDataQuery . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
function generateCaptcha()
{
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $_SESSION['captcha_answer'] = $num1 + $num2;
    return "$num1 + $num2 = ?";
}

$captchaQuestion = generateCaptcha();

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
    <!-- Responsive CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <title>Saraswathi Constructionsss - Engineering and Consultancy | 2BHK Flats for Sale in Madipakkam</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
    <link rel="manifest" href="assets/favicons/manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .btntoTop {
            display: none;
        }

        .onlygclid {
            display: none;
        }

        .onlygclid2 {
            display: none;
        }

        .demoInputBox {
            border: solid 1px #5f7d8b !important;
            width: 100%;
            margin-bottom: 6px !important;
            padding: 0px 7px !important;
            border-radius: 5px;
            display: block;
            height: 34px !important;
            font-size: 17px;
        }

        #form-outer-contact {
            z-index: 99999;
            background: #f7f7f700;
            width: 98%;
            height: 100%;
            margin: auto;
            padding-top: 10px;
        }

        @media only screen and (max-width: 767px) {
            .fullscreen12 {
                height: unset !important;
            }
        }
    </style>



    <link rel="icon" href="" sizes="32x32" />
    <link rel="icon" href="" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="" />
    <meta name="msapplication-TileImage" content="favicon.ico" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="./assets/assets/Swiper/4.4.6/css/swiper.min.css">
    <link rel="stylesheet" href="./assets/assets/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link href="./assets/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/assets/css/style.css">
    <link rel="stylesheet" href="./assets/assets/css/input.css">
    <link rel="stylesheet" href="./assets/assets/css/intelinput.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="./assets/assets/css/responsive.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <div class="header-logo-area" style="padding-bottom: 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <div class="construct-logo">
                            <a href="index.php">
                                <img src="assets/img/scs_logo.png" class="img-fluid" alt="site logo"
                                    style="width:400px; height: 80px;" />
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <div class="logoright-section">
                            <div class="single-logo-right">
                                <div class="logo-right-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="logo-right-text pt-3">
                                    <a href="tel:+91 80727 98551">

                                        <p class="d-inline">+91 80727-98551,</p>

                                    </a>
                                    <a href="tel:+91 88382-45070">

                                        <p class="d-inline"> +91 88382-45070</p>

                                    </a>
                                </div>
                            </div>
                            <div class="single-logo-right ">
                                <div class="logo-right-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="logo-right-text pt-3">
                                    <a href="mailto:scsinconstructions@gmail.com">
                                        <p>scsinconstructions@gmail.com</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- Header Area End -->
    <div class="fixed-feedback">
        <div class="fixed-feedback-button">Download Brochure</div>
        <div class="fixed-feedback-form " style="min-height: 100px;">
            <div class="fixed-feedback-crossbutton text-right">X</div>
            <div style="padding-top: 0px;" id="form-outer-contact">



                <div id="frm-contact">


                    <div id="btn-logo-rest-body">
                        <form action="" method="post">

                            <input id="first_name" name="name" placeholder="Name" type="text" autocomplete="off"
                                class="demoInputBox" onpaste="return false" required="">

                            <input id="email" name="email" placeholder="Email" type="email" autocomplete="off"
                                class="demoInputBox" onpaste="return false" required="">


                            <input id="mobile" name="mobile" placeholder="Mobile e.g. 8186766666" type="number"
                                onpaste="return false;" class="mobvalid demoInputBox"
                                onkeypress="return isNumberKey(event)" autocomplete="off" required="">
                            <label style="color:blue;font-size:15px;">
                                solve
                            </label>


                            <label style="color:blue;font-size:15px;">
                                <?php echo $captchaQuestion; ?>
                            </label>
                            <input class="mobvalid demoInputBox" style="margin-bottom:5px" type="number" name="captcha"
                                placeholder="Enter the answer" required>
                            <input type="submit" name="submit" value="Download Brochure"
                                class="sbclear contactbuttonsubmit formbuttonstyler">


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .ban_sec {
            width: 100%;
        }

        .ban_img {
            width: 100%;
            position: relative;
        }

        .ban_img img {
            width: 100%;
        }


















        @media only screen and (max-width: 767px) {
            .ban_img img {

                object-fit: cover;
            }
        }




        ul {
            list-style: none;
            padding-left: 0;
        }

        li {
            position: relative;
            padding-left: 1.5em;
            /* space to preserve indentation on wrap */
        }

        .lead li:before {
            content: '✅';
            /* placeholder for the SVG */
            position: absolute;
            left: 0;
            /* place the SVG at the start of the padding */
            width: 1em;
            height: 1em;
        }

        .fixed-feedback {
            position: fixed;
            top: 35% !important;
            right: -300px;
            width: 300px;
            height: auto;
            z-index: 299;
            background-color: #fff;
            -webkit-transition: right .3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            -o-transition: right .3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            transition: right .3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            -webkit-backface-visibility: hidden;
        }

        .fixed-feedback .fixed-feedback-button {
            position: absolute;
            left: -32px;
            color: #fff;
            font-weight: bold;
            writing-mode: vertical-rl;
            font-size: 1rem;
            background-color: #000;
            padding: 10px 5px;
            cursor: pointer;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .fixed-feedback .fixed-feedback-form {
            opacity: 0;
            padding: 10px 10px;
            transition: opacity .3s .15s cubic-bezier(0.645, 0.045, 0.355, 1.000);
        }

        .fixed-feedback.fixed-feedback-open {
            right: 0;
        }

        .fixed-feedback.fixed-feedback-open .fixed-feedback-form {
            opacity: 1;
            background-color: #F1F1F1;
        }

        .fixed-feedback {
            position: fixed;
            top: 35%;
            right: -300px;
            width: 300px;
            height: auto;
            z-index: 299;
            background-color: #fff;
            -webkit-transition: right .3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            -o-transition: right .3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            transition: right .3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
            -webkit-backface-visibility: hidden;
        }

        .fixed-feedback .fixed-feedback-button {
            position: absolute;
            left: -32px;
            color: #fff;
            font-weight: bold;
            writing-mode: vertical-rl;
            font-size: 1rem;
            background-color: #000;
            padding: 10px 5px;
            cursor: pointer;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .fixed-feedback-crossbutton.text-right {
            font-weight: bold;
        }

        .fixed-feedback .fixed-feedback-form {
            opacity: 0;
            padding: 10px 10px;
            transition: opacity .3s .15s cubic-bezier(0.645, 0.045, 0.355, 1.000);
        }

        .fixed-feedback.fixed-feedback-open {
            right: 0;
        }

        .fixed-feedback.fixed-feedback-open .fixed-feedback-form {
            opacity: 1;
        }

        #feedback-rating,
        .feedback-rating-loader {
            -webkit-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
        }

        .feedback-rating-loader {
            background: transparent;
        }

        .feedback-rating-loader>div {
            background-color: #999;
        }

        .feedback-rating-loader,
        .feedback-rating-processing #feedback-rating,
        #feedback-rating-submitted,
        .feedback-rating-complete .feedback-rating-loader {
            display: none;
            opacity: 0;
        }

        .feedback-rating-processing .feedback-rating-loader,
        .feedback-rating-complete #feedback-rating {
            display: block;
            opacity: 1;
        }

        /* Add these styles to your CSS */

        .bnr_slide {
            position: relative;
        }

        .main_slide .item {
            position: relative;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #fff;
            /* Set your text color */
        }

        .banner-text {
            max-width: 500px;
            /* Adjust the maximum width of your text */
            margin: 0 auto;
        }



        .btn:hover {
            background-color: #0056b3;
            /* Set your button background color on hover */
        }

        /* Add this style to your CSS */


        .btn {
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

        @media screen and (max-width: 768px) {
            .banner-text {
                max-width: 100%;
                /* Adjust the maximum width for smaller screens */
            }
        }
    </style>
    <section class="ban_sec">
        <div class="">
            <div class="ban_img">
                <img src="./assets/assets/img/cons.png" style="max-width:100%;height:auto;" alt="banner" border="0">

            </div>
        </div>
    </section>

    <section class="bg_brand">
        <div class="container">
            <div class="text-center">
                <br />
                <h3 class="mb16 uppercase bold uppercase color-primary"><b> Book an LOTUS 2BHK FLATS
                    </b></h3>

            </div>
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center">

                    <button class="btn btn-primary btn-custom" data-toggle="modal" data-target="#callnow">
                        <i class="fa fa-phone"></i> Call Us
                    </button>
                    <div class="modal fade" id="callnow" role="dialog" style="background-color: #0D498087;">
                        <div class="modal-dialog">
                            <!-- Modal content -->
                            <div class="modal-content clearfix"
                                style="background-color: #ffffff; max-width: 450px; margin: auto; border-radius: 0px !important;">
                                <div class="modal-body">
                                    <div class="sidebar-widget">
                                        <div class="heading-properties main-title-2">
                                            <h3
                                                style="text-align: center; font-weight: 800; font-size: 22px; color: #0D4980;">
                                                Book
                                                A
                                                Site Visit</h3>
                                        </div>
                                        <div class="contact-form mainpopup">
                                            <div style="padding-top: 0px;" id="form-outer-contact">
                                                <div id="frm-contact">
                                                    <div id="btn-logo-rest-body">
                                                        <form action="" method="post">
                                                            <input id="first_name" name="name" placeholder="Name"
                                                                type="text" autocomplete="off" class="demoInputBox"
                                                                onpaste="return false" required="">
                                                            <input id="email" name="email" placeholder="Email"
                                                                type="email" autocomplete="off" class="demoInputBox"
                                                                onpaste="return false" required="">
                                                            <input id="mobile" name="mobile"
                                                                placeholder="Mobile e.g. 8186766666" type="number"
                                                                onpaste="return false;" class="mobvalid demoInputBox"
                                                                onkeypress="return isNumberKey(event)"
                                                                autocomplete="off" required="">
                                                            <label for="captcha">
                                                                Captcha
                                                                <?php echo $captchaQuestion; ?>
                                                            </label>
                                                            <input type="number" id="captcha" name="captcha"
                                                                placeholder="Enter the result" required>

                                                            <input type="submit" name="submit" value="Know More"
                                                                class="sbclear contactbuttonsubmit formbuttonstyler">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="close_div" style="position: absolute; top: 10px; right: 20px;">
                                                <div id="popupclose"
                                                    style="font-size: 20px; font-weight: 800; cursor: pointer; color: #0D4980;"
                                                    class="button-md button-theme close_btn_popup" data-dismiss="modal">
                                                    X</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <button class="btn btn-success btn-custom">
                        <a target="_blank" href="brochure.pdf" download><i class="fa fa-download"></i> Get Brochure</a>
                    </button>
                </div>
            </div>
        </div>
        <br />
        </div>
    </section>
    <!-- Breadcromb Area End -->
    <section style="padding-top: 18px;">

        <div class="container">
            <h3 class="mb16 uppercase bold uppercase color-primary  text-center"><b>Lotus 2bhk Flats
                    Facilites</b></h3>
            <p class="lead mb32 text-center">
                Modern Amenities and Features for Comfortable Living at Lotus 2BHK Flats.
            </p>
            <section>
                <div class="row mt40 mmtb0" style="max-width:1000px;margin:auto;">
                    <div class="col-xl-12 col-md-12" style="align-items: center">

                        <img class="onlydesktop" src="./assets/assets/img/Connection_nodes.jpg">


                    </div>
                </div>

            </section>

            <div class="row">
                <div class="col-sm-6 ">

                    <div class="text-center">
                        <h3 class="uppercase color-primary mb10 mt16"
                            style=" font-size: 26px !important; line-height:1.45 !important;"><b>STRUCTURE</b>
                        </h3>
                    </div>
                    <ul class="lead">
                        <li class=""> R.C.C Framed Structure With Pile Foundation Rcc Columns, Beams And Slab.</li>
                        <li> Quality Brick Masonry (Red Brick) Walls Using M Sand.</li>
                        <li> Covered Car Parking In Stilt Floor With Three Floors.</li>
                        <li> Earth Quake Resistant Design As Per Structural Consultant Based On Soil Test Report
                        </li>
                        <li> Colour, Elevation And Designs As Per Builder Choice.</li>
                    </ul>

                    <div class="text-center">
                        <h3 class="uppercase color-primary mb10 mt16"
                            style=" font-size: 26px !important; line-height:1.45 !important;"><b>SPECIAL
                                FEATURES
                            </b></h3>
                    </div>

                    <ul class="lead">
                        <li> Internal Minor Alterations, Electrical Points, Plumbing Fittings, Tile, Main Doors
                            &Other Doors And Painting Shall Be Of Customers Choice.</li>
                        <li> Tile Provided For Ground Floor Car Park Areas For Easy Maintenance.</li>
                        <li> Step Tile Shall Be Provided For Staircase And Stainless Steel Hand Rails.</li>
                        <li> Rain Water Harvesting.</li>
                        <li> Pest Control Treatment.</li>
                        <li> Fixed Supports For Drying Clothes In Terrace.
                        </li>
                        <li> All Bed Rooms And Kitchen Shall Be Provided With Lofts.</li>
                        <li> White Tile In Terrace (Heat Proof Tile) > Six Passenger Automatic Lift Will Be
                            Provided

                        </li>
                        <li> Cctv Provision.</li>
                    </ul>
                    <div class="text-center">
                        <h3 class="uppercase color-primary mb10 mt16"
                            style=" font-size: 26px !important; line-height:1.45 !important;"><b>SANITARY WARES
                                AND
                                FITTINGS </b></h3>
                    </div>
                    <ul class="lead">
                        <li> Ewc Floor Mounted Closet With Parry Ware Brand For All Toilets.</li>
                        <li> Wash Basin With Parryware Brand In Dining And Master Bedroom Toilet.</li>
                    </ul>





                </div>
                <div class="col-sm-6">
                    <img src="./assets/assets/img/COLUMN-SIZE-FLOOR_-layout.jpg" />
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="text-center">
                        <h3 class="uppercase color-primary mb10 mt16"
                            style=" font-size: 26px !important; line-height:1.45 !important;"><b>DOORS AND
                                WINDOWS</b></h3>
                    </div>
                    <ul class="lead">
                        <li> Main Door With Teak Wood, Lock, Viewing
                            Lens, Ss Hinges,Ss Handles, And Tower Bolts
                        </li>
                        <li> Bed Room Doors With Teak Wood Frames And Single Leaf Masonite Shutter.</li>
                        <li> Open Type / Sliding Upvc Window And Safety Grills</li>
                        <li> French Door With Upvc Sliding Type.</li>
                        <li> Ventilators With Teak Wood Frames, Ms Grill And Provision For Exhaust Fan.</li>
                    </ul>

                    <div class="text-center">
                        <h3 class="uppercase color-primary mb10 mt16"
                            style=" font-size: 26px !important; line-height:1.45 !important;"><b>TILES AND
                                GRANITE</b></h3>
                    </div>
                    <div class="imgbrand"></div>
                    <ul class="lead">

                        <li> Living, Dining, Kitchen And Bedrooms Floorings Shall Be Provided With 2 X 21
                            Vitrified
                            Tiles.</li>
                        <li> Bathroom Wall Tile For 71 0" Height,
                            Kitchen Wall Tile Up To 210" Height
                        </li>
                        <li> Anti-Skid Bathroom Floor Tiles.</li>
                        <li> Kitchen Platform With High Grade Polished Black Granite Top.</li>
                        <li> Stainless Steel Single Bowl Sink In Kitchen.</li>
                    </ul>

                    <div class="text-center">
                        <h3 class="uppercase color-primary mb10 mt16"
                            style=" font-size: 26px !important; line-height:1.45 !important;"><b>PLUMBING </b>
                        </h3>
                    </div>
                    <div class="imgbrand"></div>
                    <ul class="lead">
                        <li> Two Taps In The Kitchen For Metro Water And Bore Water Each.</li>
                        <li> 2 In 1 Wall Mixer With Shower Head
                        </li>
                        <li> All Internal Plumbing Water Lines Cpvc Pipes And For External Plumbing Water Lines
                            Pvc
                            Pipes Are Used.</li>
                        <li> All Plumbing Fittings With Parryware Brand.</li>
                    </ul>

                </div>
                <div class="col-sm-6 ">
                    <style>
                        .imgbrand {
                            display: flex;
                            justify-content: space-around;
                            align-items: center;



                        }
                    </style>
                    <div class="text-center">
                        <h3 class="uppercase color-primary mb10 mt16"
                            style=" font-size: 26px !important; line-height:1.45 !important;"><b>PAINTING </b>
                        </h3>
                    </div>
                    <div class="imgbrand ">
                    </div>

                    <ul class="lead">
                        <li> Internal Walls And Ceiling Finished With 2 Coats Of Putty, 1 Coat Of Primer & 2
                            Coats
                            Of Asian Premium Emulsion Paint.</li>
                        <li> External Walls Finished With 1 Coat Of White Cement, 1 Coat Of Primer & 2 Coat Of
                            Asian
                            Exterior Emulsion Paint.
                        </li>
                        <li> Doors Other Than Entrance Door With Enamel Paint.</li>
                        <li> Main Door Will Be Finished With Varnish.</li>
                        <li> M.S. Grills With Two Coats Of Enamel Paint.</li>
                    </ul>


                    <div class="text-center">
                        <h3 class="uppercase color-primary mb10 mt16"
                            style=" font-size: 26px !important; line-height:1.45 !important;"><b>ELECTRICAL </b>
                        </h3>
                    </div>
                    <div class="imgbrand ">
                    </div>
                    <ul class="lead">
                        <li> 3 Phase Electric Supply Connection With Manual Phase Change Over Facility For Each
                            Flat.</li>
                        <li> Mcb / Rccb / Modular Switches & Sockets Of Gm / Equivalent Brand.
                        </li>
                        <li> Wiring Is Of Orbit / Norwood Or Equivalent.</li>
                        <li> Split A/C Provision For All Bedrooms.</li>
                        <li> TV Provision For Hall And All Bedrooms.</li>
                        <li> Exhaust Fan Point In All Bathrooms And Kitchen.</li>
                        <li> Geyser Point In All Toilets.</li>
                        <li> Inverter Wiring In All Rooms.</li>
                        <li> Water Purifier & Chimney Point In Kitchen.</li>
                        <li> Inverter Provision.</li>
                    </ul>
                </div>

            </div>
        </div>
        <style>
            .bg_brand {
                background: rgb(248, 246, 246);
                background: linear-gradient(90deg, rgba(248, 246, 246, 1) 0%, rgba(245, 245, 251, 1) 35%, rgba(228, 232, 233, 1) 100%);

            }
        </style>
        <section class="bg_brand">
            <div class="container">
                <div class="text-center">
                    <br />
                    <h3 class="mb16 uppercase bold uppercase color-primary"><b>Our Brands
                        </b></h3>
                    <p class="lead mb32 text-center">
                        Elevate Your Lifestyle with Our Premium Selection.
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-md-12 d-flext align-item-center">
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            <img class="img-fluid equal-size" src="./assets/assets/img/paints/asianpaint.png" />
                            <!-- <img src="./assets/assets/img/paints/bergerpaint.png" width="100px"  /> -->
                            <!-- <img src="./assets/assets/img/paints/duluxpaint.png" width="100px"  /> -->
                            <img class="img-fluid equal-size" src="./assets/assets/img/tiles/bajaji.png" />
                            <img src="./assets/assets/img/tiles/kajaria.png" class="img-fluid equal-size" />
                            <img src="./assets/assets/img/tiles/somany.png" class="img-fluid equal-size" />
                            <!-- <img src="./assets/assets/img/plumping/ashirvad.jpg" class="img-fluid" /> -->
                            <img src="./assets/assets/img/plumping/astral.png" class="img-fluid equal-size" />
                            <!-- <img src="./assets/assets/img/plumping/supreme.jpg" width="100px"  /> -->
                            <img src="./assets/assets/img/electrical/crompton.jpg" class="img-fluid equal-size" />
                            <img src="./assets/assets/img/electrical/havells.png" class="img-fluid equal-size" />
                            <img src="./assets/assets/img/electrical/polycab.png" class="img-fluid equal-size" />
                        </div>
                    </div>
                </div>
                <br />
            </div>
        </section>
        <style>
            #owl-demo .equal-size {
                height: 100px;
                /* Set the desired height for your images */
                width: auto;
                /* Maintain the aspect ratio */
                margin: auto;
                padding: 2px;
            }
        </style>
        <section style="background-color:#FEFEFE;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <br />
                        <h3 class="mb16 uppercase bold uppercase color-primary"><b>UNIQUELY CRAFTED HOME &
                                PARKING
                            </b></h3>
                        <p class="lead mb32 text-center">
                            Uniquely Crafted Homes with Thoughtful Design and Convenient Parking Facilities.
                        </p>

                        <div class="fotorama " data-width="100%" data-height="100%" data-arrows="always"
                            data-click="true" data-swipe="true" data-swipe="true" data-nav="thumbs"
                            data-autoplay="false" style=" border: 1px solid #c7c7c7; ">


                            <img
                                src="./assets/assets/img/3d-rendering-modern-kitchen-counter-with-white-biege-design.jpg"></img>
                            <img
                                src="./assets/assets/img/3d-rendering-loft-luxury-living-room-with-bookshelf-near-bookshelf.jpg"></img>

                            <img src="./assets/assets/img/luxury-classic-modern-bedroom-suite-hotel.jpg"></img>
                        </div>

                        <br><br>
                    </div>
                </div>

            </div>

        </section>







        <section style=" padding-top:12px; padding-bottom: 30px; ">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3 class="mb16 uppercase bold color-primary line"><b>CONTACT US</b></h3>
                        <p class="lead mb32 text-center">
                            When you're in need of a dependable Construction Company,
                            don’t hesitate to Contact us.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="mapouter">
                            <div class="gmap_canvas embed-responsive embed-responsive-16by9">
                                <iframe width="100%" height="400px" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=27 /15, Shanthi Nagar Main Road, Adambakkam, Chennai - 600 088.&t=&z=10&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                <br>
                                <a href="https://embedgooglemap.2yu.co">html embed google map</a>
                                <style>
                                    .gmap_canvas {
                                        overflow: hidden;
                                        background: none !important;

                                        width: 100%;
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    <style>
                        .dbox {
                            background-color: #fff;
                            border: 1px solid #e0e0e0;
                            padding: 20px;

                            border-radius: 5px;
                            transition: box-shadow 0.3s ease;
                        }

                        .dbox:hover {
                            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
                        }

                        .icon {
                            width: 50px;
                            height: 50px;
                            background-color: #F0542C;
                            border: 2px solid yellow;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-right: 20px;
                        }

                        .icon2 {
                            font-size: 30px;
                        }

                        .text {
                            width: calc(100% - 70px);
                        }

                        .text p {
                            margin: 0;
                        }

                        .text a {
                            color: #007bff;
                            text-decoration: none;
                        }

                        .text a:hover {
                            text-decoration: underline;
                        }
                    </style>

                    <div class="col-md-4 d-flex pl-md-5">
                        <div class="row dbox">
                            <div class=" w-100 d-flex ftco-animate my-3">
                                <div class="icon ">
                                    <i class="fa fa-phone icon2" aria-hidden="true"></i>
                                </div>
                                <div class="text">


                                    <p class="uppercase bold italic ">For Bookings:</p>
                                    <p class="lead">


                                        <a class="text-nowrap fw-bold" href="tel:+918072798551">+91-80727-98551,</a>
                                        <br />
                                        <a class="text-nowrap fw-bold" href="tel:+918838245070">+91-88382-45070</a>

                                    </p>



                                </div>

                            </div>
                            <div class=" w-100 d-flex ftco-animate">
                                <div class="icon">
                                    <span class="fa fa-map-marker icon2"></span>
                                </div>
                                <div class="text">
                                    <p class="uppercase bold italic">Address:</p>
                                    <p class="lead"> #27 /15, Shanthi Nagar Main Road<br />
                                        Adambakkam,<br /> Chennai - 600 088. </p>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>

            </div>
        </section>






















    </section>
    </div>






    <!-- jQuery 1.8 or later, 33 KB -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


    <script src="./assets/assets/Swiper/4.4.6/js/swiper.min.js"></script>
    <script src="./assets/assets/fancybox/3.5.7/jquery.fancybox.min.js"></script>



    <script src="./assets/assets/js/combined.js"></script>
    <script src="./assets/assets/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>












    <style>
        #b_f2e23655_47::after {
            display: none;
        }

        .mobilelivesquare {
            display: none;
        }

        #b_f2e23655_47 {
            display: none;
        }

        @media all and (min-width:350px) and (max-width:768px) {
            .mobileheading {
                padding-bottom: 5px;
            }

            .mobileheading>h1 {
                font-size: 16px !important;
            }

            div.container.v-align-transform.mobileheading>h1 {
                font-size: 15px !important;
            }

            .brochurebutton {
                font-size: 18px !important;
            }
        }

        @media all and (min-width:300px) and (max-width:350px) {
            .mobileheading {
                padding-bottom: 5px;
            }

            .mobileheading>h1 {
                font-size: 13px !important;
            }

            div.container.v-align-transform.mobileheading>h1 {
                font-size: 13px !important;
            }

            .brochurebutton {
                font-size: 18px !important;
            }

            .formsecondrow {
                padding-top: calc(100vh + 65px) !important;
            }
        }

        @media all and (max-width:768px) {
            #contactformid {
                min-height: 260px !important;
            }
        }

        @media all and (max-width:350px) {
            #topform>div>ul>li:nth-child(n) {
                font-size: 12px !important;
            }
        }

        .ctanow {
            color: #0D4980;
        }

        #topform>p>span>b {
            color: #0D4980;
        }

        @keyframes blinker {
            50% {
                color: #0D4980;
            }
        }

        .unlockbuttonstyler:hover {
            background-color: #ce9600 !important;
            background-image: linear-gradient(315deg, #ce9600 0%, #ce9600 74%) !important;
            background: #ce9600;
            color: black !important;
        }

        #topform>ul>li:nth-child(n) {
            font-weight: 600;
            font-size: 14.5px;
            line-height: 23.5px;
        }

        nav.absolute.transparent.fixed.outOfSight.scrolled {
            display: none;
        }


        body>div.main-container>section.cover.bluebackground.fullscreen12increase.onlydesktop>img {
            width: 100%;
        }

        @media (max-width: 768px) {
            .LandbotLivechat:not(is-open) {
                bottom: 60px;
            }

            .LandbotLivechat.is-open {
                bottom: 50px !important;
            }
        }

        mark {
            padding-left: 3px;
            padding-right: 3px;
            background-color: #F4B40A;
        }

        @media (max-height: 680px) and (min-width: 769px) {

            #topform>ul>li:nth-child(n) {
                font-size: 13px;
                line-height: 19px;
            }

            .hidesmall {
                display: none;
            }

            .formbackground {
                padding-top: 10px !important;
            }

            iframe#contactformid {
                min-height: 230px !important;
            }

            .lh20 {
                line-height: 20px !important;
            }

        }

        @media all and (min-width: 768px) {

            .onlymobile {
                display: none !important;
            }

            #topform2 {
                display: flexaaaa;
                box-shadow: 0 0 0 2px #a1a1a1, 0 0 0 3px #ffffff, 0 0 15px 15px #0000004f;
            }
        }

        .onlymobile .background-image-holder.imageheightadjuster.fadeIn {
            background: url('');
            background-size: 100% auto !important;
            background-position: top !important;
            background-repeat: no-repeat !important;
        }


        body>div.main-container>section.cover.parallax.bluebackground.fullscreen12increase.onlydesktop>img {
            width: 100%;
        }

        .fotorama__caption__wrap {
            font-weight: bold;
            font-size: 18px;
            color: white;
            background: #0D4980;
        }

        .fotorama__caption {
            top: 0px !important;
        }

        .fotorama__thumb-border {
            border-color: #18407D;
        }

        #amenitiesrow>div:nth-child(n) {
            text-align: center !important;
        }

        @media all and (max-width: 768px) {
            #amenitiesrow>div:nth-child(n) {
                max-width: 50%;
                flex: 0 0 50%;
            }

            #amenitiesrow>div:nth-child(n)>div>p {
                text-align: center;
                font-weight: 600 !important;
                padding-top: 5px;
            }

            #amenitiesrow {
                display: flex;
                flex-wrap: wrap;
            }
        }

        #myVideo {
            width: 100%;
            /* height: 100vh; */
            object-fit: fill;

        }

        @media all and (max-width: 768px) {
            .mmtb0 {
                margin-top: 0px;
                margin-bottom: 0px;
                padding-top: 0px;
                padding-bottom: 0px !important;
            }
        }

        @media only screen and (min-width: 768px) {
            .logoresizer {
                max-width: 400px;
                width: 400px;
            }

            .logoresizer2 {
                display: none;
            }
        }

        @media only screen and (max-width: 768px) {
            .logoresizer {
                display: none
            }

            .logoresizer2 {
                display: block;
            }
        }

        .altogether {
            white-space: nowrap;
        }

        nav.absolute.transparent.fixed {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#owl-demo").owlCarousel({
                loop: true,
                autoplay: true,
                autoPlayTimeout: 100,
                rtl: true,
                animateIn: 'fadeInRight',
                items: 7,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                responsive: {
                    0: {
                        items: 2// Number of items to show on screens smaller than 600px
                    },
                    600: {
                        items: 3 // Number of items to show on screens between 600px and 992px
                    },
                    992: {
                        items: 5 // Number of items to show on screens between 992px and 1199px
                    },
                    1200: {
                        items: 7 // Number of items to show on screens larger than 1200px
                    }
                }
            });

            // Trigger autoplay immediately after initialization
            $("#owl-demo").trigger('play.owl.autoplay', [100]); // Set the autoplay interval
        });


        $(document).ready(function () {
            setTimeout(function () {
                $('#myModal-visit').modal('show');
            }, 5000);


            // Fixed Feedback Form


            $('.fixed-feedback').removeClass('fixed-feedback-open');



            $('.fixed-feedback-button').off('click').on('click', function () {
                $(this).parents('.fixed-feedback').toggleClass('fixed-feedback-open');
            });

            $('.fixed-feedback-crossbutton').off('click').on('click', function () {
                $(this).parents('.fixed-feedback').toggleClass('fixed-feedback-open');
            });


            $('.form-open').off('click').on('click', function () {
                $('.fixed-feedback-button').parents('.fixed-feedback').toggleClass('fixed-feedback-open');
            });





        });

        $('.mobile-amenities').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>


    <script>
        var userNameinput = document.getElementById("userName");
        var userEmailinput = document.getElementById("userEmail");
        var phonenumbinput = document.getElementById("phonenumb");
        var otpfieldinput = document.getElementById("otpfield");

        userNameinput.addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("myBtn").click();
            }
        });
        userEmailinput.addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("myBtn").click();
            }
        });
        phonenumbinput.addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("myBtn").click();
            }
        });
        otpfieldinput.addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("myOTPBtn").click();
            }
        });

        function addCss(cssCode) {
            var styleElement = document.createElement("style");
            styleElement.type = "text/css";
            if (styleElement.styleSheet) {
                styleElement.styleSheet.cssText = cssCode;
            } else {
                styleElement.appendChild(document.createTextNode(cssCode));
            }
            document.getElementsByTagName("head")[0].appendChild(styleElement);
        }
        if (window.location.href.indexOf("gclid") > -1 || window.location.href.indexOf("google") > -1) {
            addCss(".onlygclid { display: table-row; };");
            addCss(".onlygclid2 { display: block;}");
        }

    </script>



    <script>

        $(' .main_slide').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>



    <!-- Hire Area Start -->

    <!-- Hire Area End -->

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