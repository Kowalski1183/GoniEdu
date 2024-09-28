<?php 

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
                            $get_riwayat= "SELECT * from penyetoran join sampah using(id_smph) where jenis_setor = 'Tabung' and status_setor = 'Pending' ";
                            $temp_riwayat = mysqli_query($koneksi,$get_riwayat);
                            while($riwayat_row = mysqli_fetch_assoc($temp_riwayat)) :
                   
                            ?>
                            <div class="col-md-12">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <!-- GAMBAR SAMPAH **dibawah status pending,tgltrans,jenis atau kaya default gapapa -->
                                        <img class="icon-colored" src="images/koin.png" title="shipped.svg"/>

                                        <div class="wigdet-two-content media-body">
                                            <span class="pull-center" align="left">
                                            <!-- JENIS MENABUNG (TUKAR(CASH) ATAU TABUNG) **atas kiri -->
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics"> <?php echo $riwayat_row['jenis_setor'];?></p>
                                            <!-- TAGGAL TRANSAKSI -->
                                            <p class="m-0"><?php echo $riwayat_row['tgl_req'];?></p>
                                            <span class="pull-center" align="right">
                                            <!-- STATUS TRANSAKSI (PENDING/SELESAI) **atas kanan posisi seharusnya sejajar sama jenis menabung-->
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics"> <?php echo $riwayat_row['status_setor'];?></p>
                                            <span class="pull-center" align="left">
                                            <h2 class="mb-4 text-success"><a href="setoradmin.php"><?php echo $riwayat_row['kategori_smph'];?></a></h2>
                                            <?php
                                            if($riwayat_row['status_setor']=='Pending'):?>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Estimasi Berat: <?php echo $riwayat_row['estimasi_berat'];?> gram</p>
                                                <?php
                                                if($riwayat_row['jenis_setor']=='Tukar'){
                                                ?>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total : Rp.<?php echo ($riwayat_row['harga_cash']*$riwayat_row['estimasi_berat']/1000);?></p>
                                                <?php }else {?>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total : <?php echo ($riwayat_row['harga_poin']*$riwayat_row['estimasi_berat']/1000);?> Goni poin</p>
                                                <?php }?>
                                                
                                            <span class="pull-center" align="right">
                                            <a class="btn btn-primary" href="formApprove.php?transaksi=Tabung&id_ksmn=<?php echo $riwayat_row['id_konsumen'];?>&id_setor=<?php echo $riwayat_row['id_setor'];?>" role="button">Approve</a>
                                            <?php endif;?>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile;?>
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
            