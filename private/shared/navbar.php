 <?php
  ob_start();
  require_once("../private/initialize.php");
  $query_command = "SELECT * FROM class ";
  $class_result = mysqli_query($database_connection, $query_command);

  if (!empty($_SESSION["admin_id"])) {
    $admin_id = $_SESSION["admin_id"];
    $query_command = "SELECT * FROM admin WHERE admin_id = $admin_id";
    $result = mysqli_query($database_connection, $query_command);
    $fetch_admin = mysqli_fetch_assoc($result);
  }
  ?>

 <!DOCTYPE html>

 <html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../bootstrap-config/assets/" data-template="vertical-menu-template-free">

 <head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

   <title>
     School Management System
   </title>

   <meta name="description" content="" />

   <!-- Favicon -->
   <link href="https://fonts.cdnfonts.com/css/unicorns-are-awesome" rel="stylesheet">
                
   <!-- <link rel="icon" type="image/x-icon" href="../bootstrap-config/assets/img/favicon/favicon.ico" /> -->
   <link rel="icon" type="" href="schoollogo.png" />

   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
   <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

   <link rel="stylesheet" href="../bootstrap-config/assets/vendor/fonts/boxicons.css">

   <!-- Core CSS -->
   <link rel="stylesheet" href="../bootstrap-config/assets/vendor/css/core.css" class="template-customizer-core-css" />
   <link rel="stylesheet" href="../bootstrap-config/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
   <link rel="stylesheet" href="../bootstrap-config/assets/css/demo.css">

   <!-- Vendors CSS -->
   <link rel="stylesheet" href="../bootstrap-config/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
   <link rel="stylesheet" href="../bootstrap-config/assets/vendor/libs/apex-charts/apex-charts.css">

   <!-- Page CSS -->

   <!-- Helpers -->
   <script src="../bootstrap-config/assets/vendor/js/helpers.js"></script>
   <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
   <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
   <script src="../bootstrap-config/assets/js/config.js"></script>
 </head>

 <body>
   <!-- Layout wrapper -->
   <div class="layout-wrapper layout-content-navbar ">
     <div class="layout-container">
       <!-- Menu -->

       <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
         <div class="app-brand demo h-auto align-middle mb-4">
           <a href="index.php" class="app-brand-link">
             <span class="app-brand-logo demo">
               <img src="schoollogo.png" alt="" class="w-px-200 h-px-200 rounded-circle" />
             </span>
           </a>
         </div>

         <ul class="menu-inner py-1 ">
           <!-- Dashboards -->
           <li class="menu-item">
             <a href="index.php" class="menu-link ">
               <i class="menu-icon tf-iqcons bx bx-home-circle"></i>
               <div data-i18n="Dashboards" class="fs-5">Dashboard</div>
             </a>
           </li>


           <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-box"></i>
               <div data-i18n="Front Pages" class="fs-5">Academics</div>
             </a>

             <ul class="menu-sub">
               <li class="menu-item">
                 <a href="subject.php" class="menu-link">
                   <i class="menu-icon tf-icons bx bx-credit-card"></i>
                   <div data-i18n="Email" class="fs-5">Subject</div>
                 </a>
               </li>

               <li class="menu-item">
                 <a href="exams.php" class="menu-link">
                   <i class="menu-icon tf-icons bx bx-credit-card"></i>
                   <div data-i18n="Email" class="fs-5">Exams</div>
                 </a>
               </li>
               <li class="menu-item">
                 <a href="result.php" class="menu-link">
                   <i class="menu-icon tf-icons bx bx-credit-card"></i>
                   <div data-i18n="Email" class="fs-5">Result</div>
                 </a>
               </li>
             </ul>
           </li>

           <li class="menu-item">
             <a href="pay_fees.php" class="menu-link">
               <i class="menu-icon tf-icons bx bx-credit-card"></i>
               <div data-i18n="Email" class="fs-5">Pay Fees</div>
             </a>
           </li>

           <!-- Layouts -->
           <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-group"></i>
               <div data-i18n="Layouts" class="fs-5">Staffs</div>
             </a>

             <ul class="menu-sub">
               <li class="menu-item">
                 <a href="teachers.php" class="menu-link">
                   <div data-i18n="Without menu" class="fs-5">Teachers</div>
                 </a>
               </li>
               <li class="menu-item">
                 <a href="drivers.php" class="menu-link">
                   <div data-i18n="Without navbar" class="fs-5">Drivers</div>
                 </a>
               </li>
               <li class="menu-item">
                 <a href="securities.php" class="menu-link">
                   <div data-i18n="Container" class="fs-5">Securities</div>
                 </a>
               </li>
               <li class="menu-item">
                 <a href="cleaners.php" class="menu-link">
                   <div data-i18n="Fluid" class="fs-5">Cleaners</div>
                 </a>
               </li>
             </ul>
           </li>

           <!-- Front Pages -->
           <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-male-female"></i>
               <div data-i18n="Front Pages" class="fs-5">Students</div>
             </a>

             <ul class="menu-sub">
               <li class="menu-item">
                 <a href="admission.php" class="menu-link">
                   <div data-i18n="Landing" class="fs-5">Admissions Pricing</div>
                 </a>
               </li>
               <li class="menu-item">
                 <a href="student.php" class="menu-link">
                   <div data-i18n="Pricing" class="fs-5">Enroll Now</div>
                 </a>
               </li>
               <li class="menu-item">
                 <a href="all_student.php" class="menu-link">
                   <div data-i18n="Payment" class="fs-5">All Students</div>
                 </a>
               </li>

             </ul>
           </li>



           <li class="menu-item">
             <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class="menu-icon tf-icons bx bx-building"></i>
               <div data-i18n="Front Pages" class="fs-5">Class Rooms</div>
             </a>
             <ul class="menu-sub">
               <?php while ($class_data = mysqli_fetch_assoc($class_result)) { ?>
                 <li class="menu-item">
                   <a href="<?php echo url_for('class.php?class_id=' . $class_data['class_id']) ?>" class="menu-link">
                     <div data-i18n="Landing" class="fs-5"><?php echo $class_data['class_name'] ?></div>
                   </a>
                 </li>
               <?php } ?>

             </ul>
           </li>

           <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Preference &amp; Settings</span>
           </li>
           <!-- Apps -->
           <li class="menu-item">
             <a href="my_profile.php" class="menu-link">
               <i class="menu-icon tf-icons bx bx-user"></i>

               <div data-i18n="Email" class="fs-5">My Profile</div>

             </a>
           </li>
           <li class="menu-item">
             <a href="#" class="menu-link">
               <i class="menu-icon tf-icons bx bx-cog"></i>
               <div data-i18n="Chat" class="fs-5">Settings</div>

             </a>
           </li>
           <li class="menu-item">
             <a href="logout.php" class="menu-link">
               <i class="menu-icon tf-icons bx bx-power-off"></i>
               <div data-i18n="Calendar" class="fs-5">Log Out</div>

             </a>
           </li>
       </aside>
       <!-- / Menu -->

       <!-- Layout container -->
       <div class="layout-page">
         <!-- Navbar -->

         <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
           <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
             <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
               <i class="bx bx-menu bx-sm"></i>
             </a>
           </div>

           <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
             <!-- Search -->
             <div class="navbar-nav align-items-center">
               <div class="nav-item d-flex align-items-center">

               </div>
             </div>
             <!-- /Search -->

             <ul class="navbar-nav flex-row align-items-center ms-auto">

               <!-- User -->
               <li class="nav-item navbar-dropdown dropdown-user dropdown">
                 <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                   <div class="avatar avatar-online">
                     <img src="../images/admin_pictures/<?php echo $fetch_admin['images'] ?>" alt class="w-px-40 h-px-40 rounded-circle" />
                   </div>
                 </a>
                 <ul class="dropdown-menu dropdown-menu-end">
                   <li>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex">
                         <div class="flex-shrink-0 me-3">
                           <div class="avatar avatar-online">
                             <img src="../images/admin_pictures/<?php echo $fetch_admin['images'] ?>" alt class="w-px-40 h-px-40 rounded-circle" />
                           </div>
                         </div>
                         <div class="flex-grow-1">
                           <span class="fw-medium d-block"><?php echo $fetch_admin['surname'] . " " . $fetch_admin['lastname'] ?></span>
                           <small class="text-muted">Admin</small>
                         </div>
                       </div>
                     </a>
                   </li>
                   <li>
                     <div class="dropdown-divider"></div>
                   </li>
                   <li>
                     <a class="dropdown-item" href="my_profile.php">
                       <i class="bx bx-user"></i>
                       <span class="align-middle">My Profile</span>
                     </a>
                   </li>
                   <li>
                     <a class="dropdown-item" href="#">
                       <i class="bx bx-cog me-2"></i>
                       <span class="align-middle">Settings</span>
                     </a>
                   </li>

                   <li>
                     <div class="dropdown-divider"></div>
                   </li>
                   <li>
                     <a class="dropdown-item" href="../public/logout.php">
                       <i class="bx bx-power-off me-2"></i>
                       <span class="align-middle">Log Out</span>
                     </a>
                   </li>
                 </ul>
               </li>
               <!--/ User -->
             </ul>
           </div>
         </nav>

         <!-- / Navbar -->