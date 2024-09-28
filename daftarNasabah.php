<?php 


// -----------------------------
include "headerAdmin.php";
include "koneksi.php";
$get_temp = "select id_ptgs from petugas limit 1";
$temp_result = mysqli_query($koneksi,$get_temp);
$temp_row = mysqli_fetch_assoc($temp_result);
$_SESSION['id_ptgs'] = $temp_row['id_ptgs'];


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
                            <?php 
                             include 'koneksi.php';
                             $selectNasabah = "SELECT * from konsumen";
                             $resultNasabah = mysqli_query($koneksi,$selectNasabah);
                             foreach($resultNasabah as $listNasabah ) :
                   
                            ?>
                            <div class="col-md-12">
                                <div class="card-box widget-box-two widget-two-custom">
                                        <div class="wigdet-two-content media-body">
                                            <span class="pull-center" align="Left">
                                            <h2 class="mb-4 text-success"><a href=""><?php echo $listNasabah['nama'];?></a></h2>
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Saldo : <?php echo $listNasabah['poin'];?> GoniPoin</p>
                                            <a class="btn btn-primary" href="formMutasi.php?id_ksmn=<?php echo $listNasabah['id_ksmn'];?>" role="button">Input Mutasi </a>
                                            <a class="btn btn-primary" href="listMutasi.php?id_ksmn=<?php echo $listNasabah['id_ksmn'];?>" role="button">Lihat Mutasi </a>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                         <!-- end container-fluid -->

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
            