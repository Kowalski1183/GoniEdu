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
        <link rel="stylesheet" href="style.css">
      

    </head>

    <body>
        <?php session_start();include 'koneksi.php';
        if (!isset($_SESSION['id_ptgs'])) {
            header("Location: loginAdmin.php");
            exit;}

?>
        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <img class="icon-colored" src="assets/images/icons/previous.svg" onclick="history.back(-1)"/>
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    

                    <?php $getUser= "Select * from petugas where id_ptgs = ".$_SESSION['id_ptgs']." ";
                          $resultUser = mysqli_query($koneksi,$getUser);
                          $rowUser = mysqli_fetch_assoc($resultUser);?>
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <!-- <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle"> -->
                            <span class="pro-user-name ml-1 text-danger">
                                <?php echo $rowUser['nama_ptgs'];?>  <i class="mdi mdi-chevron-down "></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Hello</h6>
                            </div>

                            <!-- item-->
                            <a href="dashAdmin.php" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>Beranda</span>
                            </a>

                            <!-- item-->
                            <a href="tambahAdmin.php" class="dropdown-item notify-item">
                                <span>Tambah Admin</span>
                            </a>
                            <a href="kelolaSmph.php" class="dropdown-item notify-item">
                                <span>Kelola Sampah</span>
                            </a>
                            <a href="kelolaBrg.php" class="dropdown-item notify-item">
                                <span>Kelola barang</span>
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

                <!-- LOGO -->
               <!--  <div class="logo-box">
                    <a href="index.html" class="logo text-center">
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="25">
                             <span class="logo-lg-text-light">UBold</span>
                        </span>
                        <span class="logo-sm">
                            <span class="logo-sm-text-dark">U</span> 
                            <img src="assets/images/logo-sm.png" alt="" height="28">
                        </span>
                    </a>
                </div> -->

                <!-- <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li class="d-none d-sm-block">
                            <form class="app-search">
                                <div class="app-search-box">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit">
                                                <i class="fe-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                </ul> -->
            </div>
            <!-- end Topbar -->