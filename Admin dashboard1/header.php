<?php
class board
{
    function __construct()
    {
        $power = $name = '';
        if (isset($_SESSION['login'])) {
            $con = new mysqli('localhost', 'root', '', 'restaurant_management');
            $power = $_SESSION['email'];
            $sql = $con->query(query: "SELECT * FROM user WHERE email='$power'");
            $data = $sql->fetch_array();
            $power = $data['type'];
            $name = $data['name'];
        }
        echo '<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
        
            <title>Hestia Management System</title>
        
            <!-- Custom fonts-->
            <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        
           
            <link href="assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
            <link href="assets/vendor/bootstrap/css/bootstrap-datepicker.css"/>
            <link rel="icon" href="assets/img/icon.png">
            <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="assets/vendor/parsley/parsley.css" />
        
            <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-select/bootstrap-select.min.css" />
            <link href="assets/vendor/jquery/jquery.timepicker.min.css"/>

            <link rel="stylesheet" href="assets/css/style.css">
            <link id="color-switcher" rel="stylesheet" href="assets/css/dark_theme.css">
        
        </head>
        <body id="page-top">
        <div class="pre-loader">
            <div class="sk-fading-circle">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
            </div>
        </div>

        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">
    
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                    <div class="sidebar-brand-icon rotate-n-15">
    
                    </div>
                    <img src="assets/img/logo.png" class="img-fluid" />
                </a>
    
                <!-- Divider -->
                <hr class="sidebar-divider my-0">';
        if ($power == 'Manager') {
            echo '<!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="fas fa-tasks"></i>
                                <span>Dashboard</span>
                            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="employee.php">
                            <i class="fas fa-address-card"></i>
                            <span>Employees</span>
                        </a>
                   </li>
                    <li class="nav-item">
                        <a class="nav-link" href="complaint.php">
                            <i class="far fa-angry"></i>
                            <span>Complaints</span>
                        </a>
                    </li>
';
        }
        if ($power == 'Waiter' || $power == 'Manager') {
            echo '
            <li class="nav-item">
                <a class="nav-link" href="table.php">
                    <i class="fas fa-chair"></i>
                    <span>Table</span>
                </a>
             </li>
            <li class="nav-item">
                <a class="nav-link" href="order.php">
                    <i class="far fa-edit"></i>
                    <span>Order</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="menu.php">
                    <i class="fas fa-utensils"></i>
                    <span>Menu</span>
                </a>
            </li>

';
            if ($power == 'Manager') {
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">
                            <i class="fas fa-user-circle"></i>
                        <span>User</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservation.php">
                        <i class="far fa-clipboard"></i>
                        <span>Reservation</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="billing.php">
                            <i class="fas fa-wallet"></i>
                            <span>Billing</span>
                        </a>
                     </li>';
            }
        }

        if ($power == 'Cashier') {
            echo '
            <li class="nav-item">
                <a class="nav-link" href="billing.php">
                    <i class="fas fa-wallet"></i>
                    <span>Billing</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="reservation.php">
                <i class="far fa-clipboard"></i>
                <span>Reservation</span></a>
            </li>
';
        }

        echo ' <div class="theme-options">
                   <div data-path="assets/css/light_theme.css" id="light-mode" class="theme-mode"></div>
                   <div data-path="assets/css/dark_theme.css" id="dark-mode" class="theme-mode"></div>
                     </div>
                   <!-- Sidebar Toggler (Sidebar) -->
                   <div class="text-center d-none d-md-inline">
                       <button class="rounded-circle border-0" id="sidebarToggle"></button>
                   </div>
       
               </ul>
               <!-- End of Sidebar -->
       
               <!-- Content Wrapper -->
               <div id="content-wrapper" class="d-flex flex-column">
       
                   <!-- Main Content -->
                   <div id="content">
       
                       <!-- Topbar -->
                       <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
       
                           <!-- Sidebar Toggle (Topbar) -->
                           <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                               <i class="fa fa-bars"></i>
                           </button>
       
                           <!-- Topbar Navbar -->
                           <ul class="navbar-nav ml-auto">
       
                               <div class="topbar-divider d-none d-sm-block"></div>
       
       
                               <!-- Nav Item - User Information -->
                               <li class="nav-item dropdown no-arrow">
                                   <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <span class="mr-2 d-none d-lg-inline  middle" id="user_profile_name">' . $name . '</span>
                                       <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg" id="user_profile_image">
                                   </a>
                                   <!-- Dropdown - User Information -->
                                   <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                       <a class="dropdown-item" href="profile.php">
                                           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                           Profile
                                       </a>
                                       ';
                                       if($power == 'Manager'){
                                       echo'
                                       <a class="dropdown-item" href="setting.php">
                                           <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                           Settings
                                       </a>';}
                                       
                                       echo'
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item" id="logout" href="manage action/logout.php"  data-target="#logoutModal">
                                       <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                       Logout
                                       </a>
                                   </div>
                               </li>
       
                           </ul>
       
                       </nav>
                       <!-- End of Topbar -->';
    }

    function title($key)
    {
        echo '<div class="title">
              <span class="subtitle">' . $key . '</span>
              <br>
              <i class="fas fa-utensils"></i>
              <span class="title-bar"></span>
              </div>';
    }
}
