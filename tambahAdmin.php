<?php 

// -----------------------------
include "headerAdmin.php";
include "koneksi.php";

// Test 1 (case konsumen)
// unset($_SESSION['id_ptgs']);
// $get_temp = "select id_ksmn from konsumen limit 1";
// $temp_result = mysqli_query($koneksi,$get_temp);
// while($temp_row = mysqli_fetch_assoc($temp_result)) :
//     $_SESSION['id_ksmn'] = $temp_row['id_ksmn'];
// endwhile;

// Test 2 (case admin)
unset($_SESSION['id_ksmn']);



 ?>
        <!-- Begin page -->
        <div id="wrapper">

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <!-- <div class="content-page"> -->
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <form action="insertPtgs.php" method="POST" enctype="multipart/form-data">
                            <!-- HEADER  -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="card"></div> 
                            <div class="card-header"></div>
                            <!-- Start of Input -->
                  

                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="username">Full Name</label>
                                    <input class="form-control" type="text" name="nama_ptgs" required="" placeholder="Michael Zenaty">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="username">username</label>
                                    <input class="form-control" type="text" name="uname_ptgs" required="" placeholder="MichZ1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="emailaddress">Email address</label>
                                    <input class="form-control" type="email" name="email_ptgs" required="" placeholder="john@deo.com">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                 
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="pw_ptgs" id="pw_ptgs" placeholder="Enter your password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="username">no  handphone </label>
                                    <input class="form-control" type="text" name="kontak_ptgs" required="" placeholder="085312345678">
                                </div>
                            </div>


                            <div class="form-group row text-center mt-2">
                                <div class="col-12">
                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" name="submit">Tambah Admin</button>
                                </div>
                            </div>

                           
                                
                                
                                
                            </div>
                        </div>
                        </form> 
                        <?php if(isset($_POST['submit'])){
                            $epassword = password_hash($_POST['pw_ptgs'], PASSWORD_BCRYPT);
                            $insertPtgs ="INSERT INTO `petugas` (`id_ptgs`, `uname_ptgs`, `email_ptgs`, `pw_ptgs`, `nama_ptgs`, `kontak_ptgs`)
                             VALUES (NULL, '".$_POST['uname_ptgs']."', '".$_POST['email_ptgs']."', '".$epassword."', '".$_POST['nama_ptgs']."', '".$_POST['kontak_ptgs']."')";echo $insertPtgs;
                               if ($koneksi->query($insertPtgs) === TRUE) {
                                echo "<script>alert('Berhasil');</script>";
                               } else {
                                echo "<script>alert('Gagal');</script>";
                               }
                            
                            
                            
                        }?>
                        

                    <!-- end container-fluid -->
                    </div> 
                   

                </div> <!-- end content -->

                

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                2017 - 2019 &copy; Adminox theme by <a href="">Coderthemes</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
</html>