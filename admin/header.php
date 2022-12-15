<?php

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["permission"] != 'admin'){
    header("location: /boot/");
    exit;
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
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>

		<!-- Title -->
		<title> سوشيال بوت </title>

		<!-- Favicon -->
		<link rel="icon" href="/boot/assets/img/brand/favicon.png" type="image/x-icon"/>

		<!-- Icons css -->
		<link href="/boot/assets/css/icons.css" rel="stylesheet">

		<!--  bootstrap css-->
		<link href="/boot/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        

		<!-- INTERNAL Data table css -->
		<link href="/boot/assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
		<link href="/boot/assets/plugins/datatable/css/buttons.bootstrap5.min.css"  rel="stylesheet">
		<link href="/boot/assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />

		<!--  Right-sidemenu css -->
		<link href="/boot/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="/boot/assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!--Bootstrap-datepicker css-->
		<link rel="stylesheet" href="/boot/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css">

		<!--Internal  Datetimepicker-slider css -->
		<link href="/boot/assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css" rel="stylesheet">
		<link href="/boot/assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css" rel="stylesheet">
		<link href="/boot/assets/plugins/pickerjs/picker.min.css" rel="stylesheet">

		<!-- Internal Spectrum-colorpicker css -->
		<link href="/boot/assets/plugins/spectrum-colorpicker/spectrum.css" rel="stylesheet">

		<!--  colorpicker css -->
		<link href="/boot/assets/plugins/colorpicker/themes/nano.min.css" rel="stylesheet">
		<link href="/boot/assets/plugins/colorpicker/themes/monolith.min.css" rel="stylesheet">
		<link href="/boot/assets/plugins/colorpicker/themes/classic.min.css" rel="stylesheet">

		<!-- style css -->
		<link href="/boot/assets/css/style.css" rel="stylesheet">
		<link href="/boot/assets/css/style-dark.css" rel="stylesheet">
		<link href="/boot/assets/css/style-transparent.css" rel="stylesheet">

		<!-- INTERNAL Select2 css -->
		<link href="/boot/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />

		<!---Skinmodes css-->
		<link href="/boot/assets/css/skin-modes.css" rel="stylesheet" />

		<!--- Animations css-->
		<link href="/boot/assets/css/animate.css" rel="stylesheet">

		<!---Internal  Owl Carousel css-->
		<link href="/boot/assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		
		<!--Internal   Notify -->
		<link href="/boot/assets/plugins/notify/css/notifIt.css" rel="stylesheet"/>

		<!-- Popover -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/introjs.min.css" integrity="sha512-iaYE9B9u4GU8+KkRTOdRdZuzKdYw1X0hOAa4GwDV/uwdXgoX/ffT3ph1+HG1m4LPZD/HV+dkuHvWFLZtPviylQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/introjs-rtl.min.css" integrity="sha512-VwsKKwi99ZnRScgAkJ+ISGNolfoq+ic/mzJfhZWQ1xwfcbLZzLnHDoERYEppL25Okf+wEI/nDhHogudTa/YkWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	</head>

	<body class=" ltr main-body app sidebar-mini">

		<!-- Loader -->
		<div id="global-loader">
			<img src="/boot/assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

		<!-- Page -->
		<div class="page">

			<div>
				<!-- main-header -->
				<div class="main-header side-header sticky nav nav-item">
					<div class=" main-container container-fluid">
						<div class="main-header-left ">
							<div class="responsive-logo">
								<a href="index.html" class="header-logo">
									<img src="/boot/assets/img/brand/logo.png" class="mobile-logo logo-1" alt="logo">
									<img src="/boot/assets/img/brand/logo-white.png" class="mobile-logo dark-logo-1" alt="logo">
								</a>
							</div>
							<div class="app-sidebar__toggle" data-bs-toggle="sidebar">
								<a class="open-toggle" href="javascript:void(0);"><i class="header-icon fe fe-align-left" ></i></a>
								<a class="close-toggle" href="javascript:void(0);"><i class="header-icon fe fe-x"></i></a>
							</div>
							<div class="logo-horizontal">
								<a href="index.html" class="header-logo">
									<img src="/boot/assets/img/brand/logo.png" class="mobile-logo logo-1" alt="logo">
									<img src="/boot/assets/img/brand/logo-white.png" class="mobile-logo dark-logo-1" alt="logo">
								</a>
							</div>
						</div>
						<div class="main-header-right">
							<button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon fe fe-more-vertical "></span>
							</button>
							<div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
								<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
									<ul class="nav nav-item header-icons navbar-nav-right ms-auto">
										<li class="dropdown nav-item">
										<a class="new nav-link theme-layout nav-link-bg layout-setting" >
										<span class="dark-layout"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" width="24" height="24" viewBox="0 0 24 24"><path d="M20.742 13.045a8.088 8.088 0 0 1-2.077.271c-2.135 0-4.14-.83-5.646-2.336a8.025 8.025 0 0 1-2.064-7.723A1 1 0 0 0 9.73 2.034a10.014 10.014 0 0 0-4.489 2.582c-3.898 3.898-3.898 10.243 0 14.143a9.937 9.937 0 0 0 7.072 2.93 9.93 9.93 0 0 0 7.07-2.929 10.007 10.007 0 0 0 2.583-4.491 1.001 1.001 0 0 0-1.224-1.224zm-2.772 4.301a7.947 7.947 0 0 1-5.656 2.343 7.953 7.953 0 0 1-5.658-2.344c-3.118-3.119-3.118-8.195 0-11.314a7.923 7.923 0 0 1 2.06-1.483 10.027 10.027 0 0 0 2.89 7.848 9.972 9.972 0 0 0 7.848 2.891 8.036 8.036 0 0 1-1.484 2.059z"/></svg></span>
										<span class="light-layout"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" width="24" height="24" viewBox="0 0 24 24"><path d="M6.993 12c0 2.761 2.246 5.007 5.007 5.007s5.007-2.246 5.007-5.007S14.761 6.993 12 6.993 6.993 9.239 6.993 12zM12 8.993c1.658 0 3.007 1.349 3.007 3.007S13.658 15.007 12 15.007 8.993 13.658 8.993 12 10.342 8.993 12 8.993zM10.998 19h2v3h-2zm0-17h2v3h-2zm-9 9h3v2h-3zm17 0h3v2h-3zM4.219 18.363l2.12-2.122 1.415 1.414-2.12 2.122zM16.24 6.344l2.122-2.122 1.414 1.414-2.122 2.122zM6.342 7.759 4.22 5.637l1.415-1.414 2.12 2.122zm13.434 10.605-1.414 1.414-2.122-2.122 1.414-1.414z"/></svg></span>
										</a>
										</li>
										<li class="dropdown main-profile-menu nav nav-item nav-link ps-lg-2">
										<a class="new nav-link profile-user d-flex" href="" data-bs-toggle="dropdown"><img alt="" src="/boot/assets/img/faces/2.jpg" class=""></a>
										<div class="dropdown-menu">
										<div class="menu-header-content p-3 border-bottom">
										<div class="d-flex wd-100p">
										<div class="main-img-user"><img alt="" src="/boot/assets/img/faces/2.jpg" class=""></div>
										<div class="ms-3 my-auto">
										<h6 class="tx-15 font-weight-semibold mb-0"><?php echo $_SESSION['full_name'];?></h6><span class="dropdown-title-text subtext op-6  tx-12"><?php echo $_SESSION['full_name'];?></span>
										</div>
										</div>
										</div>
										<a class="dropdown-item" href="index.php"><i class="far fa-user-circle"></i> الملف الشخصي</a>
										<a class="dropdown-item" href="/boot/logout.php"><i class="far fa-arrow-alt-circle-left"></i> خروج</a>
										</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /main-header -->

				<!-- main-sidebar -->
				<div class="sticky">
					<aside class="app-sidebar">
						<div class="main-sidebar-header active">
							<a class="header-logo active" href="index.html">
								<img src="/boot/assets/img/brand/logo.png" class="main-logo  desktop-logo" alt="logo">
								<img src="/boot/assets/img/brand/logo-white.png" class="main-logo  desktop-dark" alt="logo">
								<img src="/boot/assets/img/brand/favicon.png" class="main-logo  mobile-logo" alt="logo">
								<img src="/boot/assets/img/brand/favicon-white.png" class="main-logo  mobile-dark" alt="logo">
							</a>
						</div>
						<div class="main-sidemenu">
							<div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
							<ul class="side-menu">
								<li class="side-item side-item-category">الأساسية</li>
								<li class="slide">
									<a class="side-menu__item" href="index.php"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg><span class="side-menu__label">لوحة القيادة</span></a>
								</li>
                                
                                <li class="side-item side-item-category">الدعم</li>
								<li class="slide">
									<a class="side-menu__item" href="users.php"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg><span class="side-menu__label">المستخدمين</span></a>
								</li>
								<li class="slide">
									<a class="side-menu__item" href="clients.php"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg><span class="side-menu__label">المتاجر</span></a>
								</li>
								
							</ul>
							<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
						</div>
					</aside>
				</div>
				<!-- main-sidebar -->
			</div>

			<!-- main-content -->
			<div class="main-content app-content">
				<!-- container -->
				<div class="main-container container-fluid">
