<?php
include "header2.php";
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <body>

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
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">GONIGONI</a></li>
                                            <?php if($_GET['b'] == 'Sampah di jemput') : ?>
                                                <?php if(isset($_GET['tukar'])) : ?>
                                                    <li class="breadcrumb-item active">Pickup Sampah Dengan Tukar Koin</li>
                                                <?php else : ?>
                                                    <li class="breadcrumb-item active">Pickup Sampah</li>
                                                <?php endif; ?>
                                            <?php elseif($_GET['b'] == 'Setor Mandiri') : ?>
                                                <?php if(isset($_GET['tukar'])) : ?>
                                                    <li class="breadcrumb-item active">Antar Sampah Mandiri Dengan Tukar Koin</li>
                                                <?php else : ?>
                                                    <li class="breadcrumb-item active">Antar Sampah Mandiri</li>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </ol>
                                    </div>
                                    <?php if($_GET['b'] == 'Sampah di jemput') : ?>
                                        <?php if(isset($_GET['tukar'])) : ?>
                                            <h4 class="page-title">Pickup Sampah dengan Tukar Koin</h4>
                                        <?php else : ?>
                                            <h4 class="page-title">Pickup Sampah</h4>
                                        <?php endif; ?>
                                    <?php elseif($_GET['b'] == 'Setor Mandiri') : ?>
                                        <?php if(isset($_GET['tukar'])) : ?>
                                            <h4 class="page-title">Antar Sampah Mandiri Dengan Tukar Koin</h4>
                                        <?php else : ?>
                                            <h4 class="page-title">Antar Sampah Mandiri</h4>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="clearfix">
                                        <div class="float-left mb-2">
                                            <img src="assets/images/logo-dark.png" alt="" height="28">
                                        </div>
                                        <div class="float-right">
                                            <?php if($_GET['b'] == 'Sampah di jemput') : ?>
                                                <?php if(isset($_GET['tukar'])) : ?>
                                                    <h3 class="m-0 d-print-none">Pickup Sampah Dengan Tukar Koin</h3>
                                                <?php else : ?>
                                                    <h3 class="m-0 d-print-none">Pickup Sampah</h3>
                                                <?php endif; ?>
                                            <?php elseif($_GET['b'] == 'Setor Mandiri') : ?>
                                                <?php if(isset($_GET['tukar'])) : ?>
                                                    <h3 class="m-0 d-print-none">Antar Sampah Mandiri Dengan Tukar Koin</h3>
                                                <?php else : ?>
                                                    <h3 class="m-0 d-print-none">Antar Sampah Mandiri</h3>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <p><b><span id="tanggalwaktu"></span></b></p>
                                    <script>
                                        var dt = new Date();
                                        $tgl = document.getElementById("tanggalwaktu").innerHTML = (dt.getFullYear()) +"/"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"/"+ (("0"+dt.getDate()).slice(-2));
                                    </script>
                                    <?php
                                      $profill = "SELECT * FROM konsumen   WHERE id_ksmn = " . $_SESSION["konsumen"]["id_ksmn"] . " ";
                                    $quary = mysqli_query($koneksi, $profill);
                                    $profil = mysqli_fetch_object($quary)?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <p><b><?= $profil->nama; ?></b></p>
                                            </div>

                                        </div><!-- end col -->
                                       
                                    </div>
                                    <?php 
                                    $getAlamat = "Select alamat_setor from setor where id_setor = ".$_GET['id']."";
                          
                                    $resultAlamat = mysqli_query($koneksi,$getAlamat);
                                    $alamatSetor = mysqli_fetch_assoc($resultAlamat);
                                    ?>
                                    <!-- end row -->
                                    <?php if(isset($_GET['tukar'])) : ?>
                                        <div class="row mt-3">
                                        <div class="col-md-6">
                                            <h5> Address</h5>

                                            <address class="line-h-24">
                                            <?php echo $alamatSetor['alamat_setor'];?>
                                            </address>

                                        </div>

                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                    <?php else : ?>
                                        <div class="row mt-3">
                                        <div class="col-md-6">
                                            <h5> Address</h5>

                                            <address class="line-h-24">
                                            <?php echo $alamatSetor['alamat_setor'];?>
                                            </address>

                                        </div>

                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4 table-centered">
                                                    <thead>
                                                        <tr>
                                                            <th>no</th>
                                                            <th>Jenis Sampah</th>
                                                            <th>Berat Sampah</th>
                                                            <th>Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $nomor = 1;
                                                        $ambil = "SELECT * FROM setor INNER JOIN detail_setor ON setor.id_setor=detail_setor.id_setor INNER JOIN sampah_setor ON detail_setor.id_sampahsetor=sampah_setor.id_sampahsetor INNER JOIN sampah ON sampah_setor.id_smph=sampah.id_smph WHERE detail_setor.id_setor='".$_GET['id']."'";
                                                        $resultt = mysqli_query($koneksi, $ambil);
                                                        while ($row = mysqli_fetch_assoc($resultt)) {?>
                                                            <tr>
                                                                <td><?= $nomor; ?></td>
                                                                <td><?= $row['kategori_smph']; ?></td>
                                                                <td><?= $row['berat']; ?></td>
                                                                <td>Rp. <?= number_format($row['harga']); ?></td>
                                                            </tr>
                                                        <?php $nomor++;?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php
                                        $amb = "SELECT * FROM setor WHERE id_setor='".$_GET['id']."'";
                                        $resu = mysqli_query($koneksi, $amb);
                                        $gj = mysqli_fetch_assoc($resu);?>
                                        <?php if ($gj['jenis_setor'] == "Tabung") : ?>
                                            <div class="col-md-6">
                                                <div class="clearfix pt-4">
                                                    <p><b>Jenis Setor&emsp;&nbsp;&emsp;: &nbsp;</b> <?= $gj['jenis_setor']; ?></p>
                                                    <p><b>Berat Total Sampah&emsp;: &nbsp;</b> <?= $gj['total_berat']; ?> gram</p>
                                                    <p><b>Point yang di tabung&emsp;: &nbsp;</b> <?= number_format($gj['total_harga']); ?></p>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="col-md-6">
                                                <div class="clearfix pt-4">
                                                        <p><b>Berat Total Sampah&emsp;&emsp;&nbsp;&ensp;: &nbsp;</b> <?= $gj['total_berat']; ?> gram</p>
                                                        <p><b>Cara Pengambilan Uang : &nbsp;</b> Cash</p>
                                                        <p><b>Uang yang didapat&emsp;&emsp;&nbsp;&ensp;: &nbsp;</b>Rp. <?= number_format($_GET['harga']); ?></p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    <div class="hidden-print mt-4">
                                        <div class="text-right d-print-none">
                                            <a href="dashcus.php" class="btn btn-blue waves-effect waves-light"></i> Kembali</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->
                        
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