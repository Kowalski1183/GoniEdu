<?php 

// -----------------------------
include "headerAdmin.php";

include "koneksi.php";
$get_temp = "select id_ptgs from petugas limit 1";
$temp_result = mysqli_query($koneksi,$get_temp);
while($temp_row = mysqli_fetch_assoc($temp_result)) :
    $_SESSION['id_ptgs'] = $temp_row['id_ptgs'];
endwhile;


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
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">dashboard</h4>
                                </div>
                            </div>
                        </div>   
                        
                        <!-- start page title -->
                        <div class="row">
                            <!-- end col -->
                            <div class="col-md-12">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <img class="icon-colored" src="assets/images/icons/shipped.svg" title="shipped.svg"/>

                                        <div class="wigdet-two-content media-body">
                                            <span class="pull-center" align="center">
                                            <h2 class="mb-4 text-success"><a href="daftarNasabah.php">List Nasabah</a></h2>
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics"> A B C D</p>
                                            <p class="m-0">Jan - Apr 2019</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <img class="icon-colored" src="assets/images/icons/shipped.svg" title="shipped.svg"/>

                                        <div class="wigdet-two-content media-body">
                                            <span class="pull-center" align="center">
                                            <h2 class="mb-4 text-success"><a href="formMutasi.php">Input Tabungan</a></h2>
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">lihat list request</p>
                                            <p class="m-0">Jan - Apr 2019</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end container-fluid -->

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
            