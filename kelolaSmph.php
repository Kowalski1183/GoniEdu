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
        <link rel="stylesheet" href="style.css" type="text/css">
        <div id="wrapper">

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <!-- <div class="content-page"> -->
                <div class="content">
                    <!-- <style>
                        p.tgl.m-0.text-uppercase.text-success.text-truncate {
                            padding-left: 12px;
                        }

                    </style> -->
                    
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
                        
                        <a class="btn btn-primary" href="formSampah.php" role="button" style="margin: 5px 0px 15px 15px;">Tambah Sampah </a>
                            <!-- end col -->
                            <?php
                            $getSmph = "Select * From sampah where status_smph  = 'Aktif'";
                            $resultSmph = mysqli_query($koneksi,$getSmph);
                            while($rowSmph = mysqli_fetch_assoc($resultSmph)){ 
                            ?>
                                <div class="col-md-12">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                        <?php 
                                        $gambar = "Select * from gambar_smph where id_smph =".$rowSmph['id_smph']."";
                                        $result = mysqli_query($koneksi,$gambar);
                                        $row = mysqli_fetch_assoc($result);
                                        if($row['file_smph']=='no picture'){
                                        ?>
                                            <img class="icon-colored" src="assets/images/companies/Gonigoni.png" title=""/>
                                        <?php }else{?>
                                            <img class="icon-colored" src="assets/sampah/<?php echo $row['file_smph'];?>" title="shop.svg"/>
                                        <?php }?>
                                            <div class="wigdet-two-content media-body">
                                                <span class="pull-center" align="left">
                                                <p class="m-0 text-uppercase text-success font-weight-bold text-truncate"><?php echo $rowSmph['kategori_smph']?></p>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Kode Sampah   : <?php echo $rowSmph['kode_smph']?></p>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Harga Sampah  : <?php echo $rowSmph['harga_cash']?></p>
                                            
                                                <a class="btn btn-primary" href="editSmph.php?idSmph=<?php echo $rowSmph['id_smph'];?>" role="button">Edit</a>
                                                <a class="btn btn-primary" href="deleteSmph.php?idSmph=<?php echo $rowSmph['id_smph'];?>" role="button">Delete</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php };?>
                        </div> <!-- end container-fluid -->

                </div> <!-- end content -->

                

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- 2017 - 2019 &copy; Adminox theme by <a href="">Coderthemes</a> -->
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
           