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
                        
                        <a class="btn btn-primary" href="formBarang.php" role="button" style="margin: 5px 0px 15px 15px;">Tambah Barang </a>
                            <!-- end col -->
                            <?php
                            $getBrg = "Select * From barang where status_brg = 'Aktif' ";
                            $resultBrg = mysqli_query($koneksi,$getBrg);
                            while($rowBrg = mysqli_fetch_assoc($resultBrg)){ 
                            ?>
                                <div class="col-md-12">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                        <?php 
                                        $gambar = "Select * from gambar_brg where id_brg =".$rowBrg['id_brg']."";
                                        $result = mysqli_query($koneksi,$gambar);
                                        $row = mysqli_fetch_assoc($result);
                                        if($row['file_brg']==''){
                                        ?>
                                            <img class="icon-colored" src="assets/images/companies/Gonigoni.png" title=""/>
                                        <?php }else{?>
                                            <img class="icon-colored" src="assets/barang/<?php echo $row['file_brg'];?>" title="shop.svg"/>
                                        <?php }?>
                                            <div class="wigdet-two-content media-body">
                                                <span class="pull-center" align="left">
                                                <p class="m-0 text-uppercase text-success font-weight-bold text-truncate"><?php echo $rowBrg['nama_brg'];?></p>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jenis   :<?php echo $rowBrg['jenis_brg'];?> </p>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Harga   : <?php echo $rowBrg['harga_brg']." Goni Poin";?></p>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Stok  : <?php echo $rowBrg['stock'];?></p>
                                                <a class="btn btn-primary" href="editBrg.php?idBrg=<?php echo $rowBrg['id_brg'];?>" role="button">Edit</a>
                                                <a class="btn btn-primary" href="deleteBrg.php?idBrg=<?php echo $rowBrg['id_brg'];?>" role="button">Delete</a>
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
           