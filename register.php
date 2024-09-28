<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register | Adminox - Responsive Bootstrap 4 Admin Dashboard</title>
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

    <div class="home-btn d-none d-sm-block">
        <a href="index.html"><i class="fas fa-home h2 text-white"></i></a>
    </div>

    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="index.html">
                                            <img src="assets/images/logo-dark.png" alt="" height="30">
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4" align="center">Register</h5>
                                </div>

                                <div class="account-content mt-4">
                                    <form class="form-horizontal" action="insertKsmn.php" method="POST" enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="username">Full Name</label>
                                                <input class="form-control" type="text" name="nama" required="" placeholder="Michael Zenaty">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="username">username</label>
                                                <input class="form-control" type="text" name="uname" required="" placeholder="MichZ1">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="emailaddress">Email address</label>
                                                <input class="form-control" type="email" name="email" required="" placeholder="john@deo.com">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <a href="page-recoverpw.html" class="text-muted float-right"><small>Forgot your password?</small></a>
                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="username">no  handphone </label>
                                                <input class="form-control" type="text" name="no_telp" required="" placeholder="085312345678">
                                            </div>
                                        </div>
                                        
                                        <div class="demo-box">
                                            <div class="form-group mb-0">
                                                <label>Foto</label>
                                                <input type="file" name="image" class="filestyle" data-btnClass="btn-primary">
                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign Up Free</button>
                                            </div>
                                        </div>

                                    </form>
                                    <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">
                                                <p class="text-muted">Already have an account?  <a href="login.php" class="text-dark ml-1"><b>Sign In</b></a></p>
                                        </div>
                                    </div>

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