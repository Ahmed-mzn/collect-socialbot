<?php

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION['permission'] == 'admin'){
        header('location:admin/index.php');
    } elseif($_SESSION['permission'] == 'agent-order'){
        header('location:agent-order/index.php');
    } else {
        header('location:agent-call/index.php');
    }
}


include("includes/connection.php");

$valid = 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $input_email = $_POST['email'];
    $input_password = $_POST['password'];


    if(isset($_POST["login"])){
        $query="SELECT * FROM USERS WHERE email='$input_email' AND password='$input_password'";

        $sth = $connect->prepare($query);
        $sth->execute();
    
        $user = $sth->fetch(PDO::FETCH_ASSOC);
        if($user){
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['permission'] = $user['permission'];
            $_SESSION["loggedin"] = true;

            // get all clients
            $sth = $connect->prepare("SELECT * FROM CLIENTS");
            $sth->execute();
            $clients = $sth->fetchAll();

            $get_first_client = $clients[0];

            $ch = curl_init("http://localhost/khaled/api/get-user-info.php?user_id=".$get_first_client['user_id']);
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => TRUE,
            ));
            
            
            // Send the request
            $response = curl_exec($ch);

            
            // Decode the response
            $responseData = json_decode($response, TRUE);
            
            $user_info = $responseData;

            $_SESSION['store_user_id'] = $user_info['id'];
            $_SESSION['store_user_access_token'] = $user_info['access_token'];
            $_SESSION['store_website'] = $user_info['website'];

            if($_SESSION['permission'] == 'admin'){
                header('location:admin/index.php');
            } elseif($_SESSION['permission'] == 'agent-order'){
                header('location:agent-order/index.php');
            } else {
                header('location:agent-call/index.php');
            }
        } else {
            $valid = 0;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />

    <!-- Title -->
    <title> سوشيال بوت  </title>

    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/x-icon" />

    <!-- Icons css -->
    <link href="assets/css/icons.css" rel="stylesheet">

    <!--  bootstrap css-->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Right-sidemenu css -->
    <link href="assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />

    <!--- Style css --->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-dark.css" rel="stylesheet">
    <link href="assets/css/style-transparent.css" rel="stylesheet">

    <!---Skinmodes css-->
    <link href="assets/css/skin-modes.css" rel="stylesheet" />

    <!--- Animations css-->
    <link href="assets/css/animate.css" rel="stylesheet">

</head>

<body class=" ltr error-page1 bg-primary">

    <!-- Loader -->
    <div id="global-loader">
        <img src="assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <div class="square-box">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-8 col-xs-10 card-sigin-main mx-auto my-auto py-4 justify-content-center">
                        <div class="card-sigin">
                            <!-- Demo content-->
                            <div class="main-card-signin d-md-flex">
                                <div class="wd-100p">
                                    <div class="d-flex mb-4"><a href="index.php"><img src="assets/img/brand/favicon.png" class="sign-favicon ht-40" alt="logo"></a></div>
                                    <div class="">
                                        <div class="main-signup-header">
                                            <h2>مرحبًا بعودتك!</h2>
                                            <h6 class="font-weight-semibold mb-4">من فضلك سجل دخولك للمتابعة.</h6>
                                            <?php if($valid == 0){?>
                                                <div class="alert alert-danger mg-b-0 mb-2 alert-dismissible fade show" role="alert">
                                                    <strong>تنبيه !</strong> البريد الإلكتروني أو كلمة المرور خاطئة.
                                                    <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"><span aria-hidden="true">×</span></button>
                                                </div>
                                            <?php } ?>
											<form action="" method="POST">
												<div class="form-group">
													<label>البريد الإلكتروني</label>
                                                    <input class="form-control" name="email" placeholder="أدخل بريدك الإلكتروني" type="text" required>
												</div>
												<div class="form-group">
													<label>كلمة المرور</label>
                                                    <input class="form-control" name="password" placeholder="ادخل رقمك السري" type="password" required>
												</div>
                                                <button type="submit" name="login" class="btn btn-primary btn-block">تسجيل الدخول</button>
                                                <br>

												<div class="mt-4 d-flex mx-auto text-center justify-content-center">
													<button class="btn btn-icon btn-facebook me-3" type="button">
														<span class="btn-inner--icon"> <i
																class="bx bxl-facebook tx-18 tx-prime"></i> </span>
													</button>
													<button class="btn btn-icon me-3" type="button">
														<span class="btn-inner--icon"> <i
																class="bx bxl-twitter tx-18 tx-prime"></i> </span>
													</button>
													<button class="btn btn-icon me-3" type="button">
														<span class="btn-inner--icon"><a href="https://www.social-bot.io"> <i
																class="bx bxl-facebook tx-18 tx-prime"></a></i> </span>
													</button>
													<button class="btn  btn-icon me-3" type="button">
														<span class="btn-inner--icon"> <i
																class="bx bxl-instagram tx-18 tx-prime"></i> </span>
													</button>
												</div>
											</form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery min js -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Ionicons js -->
    <script src="assets/plugins/ionicons/ionicons.js"></script>

    <!-- Moment js -->
    <script src="assets/plugins/moment/moment.js"></script>

    <!-- eva-icons js -->
    <script src="assets/js/eva-icons.min.js"></script>

    <!-- generate-otp js -->
    <script src="assets/js/generate-otp.js"></script>

    <!--Internal  Perfect-scrollbar js -->
    <script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- Theme Color js -->
    <script src="assets/js/themecolor.js"></script>

    <!-- custom js -->
    <script src="assets/js/custom.js"></script>

</body>

</html>