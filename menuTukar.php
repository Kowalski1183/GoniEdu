<?php 


// -----------------------------
include "headerAdmin.php";
include "koneksi.php";
$get_temp = "select id_ptgs from petugas limit 1";
$temp_result = mysqli_query($koneksi,$get_temp);
while($temp_row = mysqli_fetch_assoc($temp_result)) :
    $_SESSION['id_ptgs'] = $temp_row['id_ptgs'];
endwhile;

// -----------------------------

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
                        
                        <!-- Margin Top-->
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
                                            <h2 class="mb-4 text-success"><a href="kelolaBrg.php">Kelola Barang</a></h2>

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
                                            <h2 class="mb-4 text-success"><a href="listTukar.php">Pengajuan Penukaran</a></h2>
    
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card-box widget-box-two widget-two-custom ">
                                    <div class="media">
                                        <img class="icon-colored" src="assets/images/icons/sports_mode.svg" title="sports_mode.svg"/>

                                        <div class="wigdet-two-content media-body">
                                            <span class="pull-center" align="center">
                                            <h2 class="mb-4 text-warning"><a href="riwayatTukar.php">Riwayat Penukaran</a></h2>
 
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <img class="icon-colored" src="assets/images/icons/shop.svg" title="shop.svg"/>

                                        <div class="wigdet-two-content media-body">
                                            <span class="pull-center" align="center">
                                            <h2 class="mb-4 text-info"><a href="listBeli.php">Aktivitas Pembelian</a></h2>
         
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <img class="icon-colored" src="assets/images/icons/shop.svg" title="shop.svg"/>

                                        <div class="wigdet-two-content media-body">
                                            <span class="pull-center" align="center">
                                            <h2 class="mb-4 text-info"><a href="riwayatBeli.php">Riwayat Pembelian</a></h2>
         
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
            