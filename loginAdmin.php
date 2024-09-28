<?php
include 'koneksi.php';
ob_start();
session_start(); 
include "koneksi.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login | Adminox - Responsive Bootstrap 4 Admin Dashboard</title>
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

</head>

<body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">


    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="dashAdmin.php">
                                            <img src="assets/images/companies/Gonigoni.png" alt="" height="30">
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4" align="center">Sign In Admin</h5>
                                </div>

                                <div class="account-content mt-4">
                                    <form class="form-horizontal" action=""method="POST">
                                        <div class="form-group row">
                                            <div class="col-12">
                                            <a href="login.php" class="text-blue float-right text-da"><small>Login as Nasabah</small></a>
                                                <label for="emailaddress">Email address</label>
                                                <input class="form-control" type="email" id="emailaddress" required="" placeholder="john@deo.com" name="email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="password">
                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" name="login">Sign In</button>
                                            </div>
                                        </div>

                                    </form>
                                    <?php  if(isset($_POST['login'])){
                                            $getPw = "select * from petugas where email_ptgs='".$_POST['email']."'";
                                            $resultPw = mysqli_query($koneksi,$getPw);
                                            if(mysqli_num_rows($resultPw)>0){
                                            $rowPw = mysqli_fetch_assoc($resultPw);
                                                if(password_verify($_POST['password'],$rowPw['pw_ptgs'])){
                                                $_SESSION['id_ptgs']=$rowPw['id_ptgs'];
                                               
                                    
                                                if ($_SESSION['id_ptgs']=$rowPw['id_ptgs']) { echo "<script>alert('login berhasil');</script>";
                                                    header("location: dashAdmin.php");
                                                    exit();
                                                }
                                       
                                                
                                                }else {echo "<script>alert('password salah');</script>";}
                                            }else{echo "<script>alert('email salah');</script>";}}?>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>