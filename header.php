<?php 
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
   exit;
}
include "koneksi.php";
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Starter page | Adminox - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
        <link href="assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">
            
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <img class="icon-colored" src="assets/images/icons/previous.svg" onclick="history.back(-1)"/>
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <?php                                                
                            $profile = "SELECT * FROM konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                            $result = mysqli_query($koneksi, $profile);
                            $profil = mysqli_fetch_assoc($result);
                            $fotoProfile = $profil['image'];?>
                          

                            <img src="<?php echo $profil['image']?>" alt="user-image" class="rounded-circle">
               
                            <!-- <span class="pro-user-name ml-1">
                                Maxine K  <i class="mdi mdi-chevron-down"></i> 
                            </span> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>
                            <!-- item-->
                            <a href="dashcus.php" class="dropdown-item notify-item">
                                <i class="icon-home"></i>
                                <span>Home</span>
                            </a>
                            <!-- item-->
                            <a href="profil.php" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>Profile</span>
                            </a>


                            <!-- item-->

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="logout.php" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>


                </ul>


            </div>
            <!-- end Topbar -->
