<?php 
include"header.php";
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Adminox</a></li>
                                            <li class="breadcrumb-item active">Nota Pembelian</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Nota Pembelian</h4>
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
                                            <?php if($_GET['pilihan'] == '1') : ?>
                                                <h3 class="m-0 d-print-none">Nota Penukaran</h3>
                                                <?php 
                                                $tgl = "SELECT * FROM penukaran WHERE id_ksmn = '".$_SESSION["konsumen"]["id_ksmn"]."' AND id_tukar = '".$_GET["tukar"]."'";
                                                $tg = mysqli_query($koneksi,$tgl);
                                                $l = mysqli_fetch_assoc($tg);?>
                                                <h5 class="m-0 d-print-none">Tanggal Penukaran : <?= $l['tgl_tukar'];?></h5>
                                            <?php elseif($_GET['pilihan'] == '2') : ?>
                                                <h3 class="m-0 d-print-none">Nota Pembelian</h3>
                                                <?php 
                                                $tgl = "SELECT * FROM pembelian WHERE id_ksmn = '".$_SESSION["konsumen"]["id_ksmn"]."' AND id_pemb = '".$_GET["pemb"]."'";
                                                $tg = mysqli_query($koneksi,$tgl);
                                                $l = mysqli_fetch_assoc($tg);?>
                                                <h5 class="m-0 d-print-none">Tanggal Pembelian : <?= $l['tgl_pemb'];?></h5>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Start of In--->
                                    <?php if(isset($_GET['alamat'])) : ?>
                                        <?php 
                                        $profill = "SELECT * FROM konsumen JOIN alamat_konsumen USING (id_ksmn) WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "' AND id_alamat = '" . $_GET["alamat"]. "'";
                                        $quary = mysqli_query($koneksi, $profill);
                                        $profil = mysqli_fetch_object($quary)?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <p><b><?= $profil->nama; ?></b></p>
                                                </div>

                                            </div><!-- end col -->
                                        
                                        </div>
                                        <!-- end row -->

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <h5> Address</h5>

                                                <address class="line-h-24">
                                                    <?= $profil->jalan; ?><br>
                                                    RT : <?= $profil->RT; ?>&nbsp RW : <?= $profil->RW; ?><br>
                                                    <?= $profil->kecamatan; ?><br>
                                                    <abbr title="Phone">Phone : </abbr> <?= $profil->no_telp; ?>
                                                </address>

                                            </div>

                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <?php 
                                        $profill = "SELECT * FROM konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                        $quary = mysqli_query($koneksi, $profill);
                                        $profil = mysqli_fetch_object($quary)?>
                                        <div class="row">
                                            <?php if($_GET['pilihan'] == '1') : ?>
                                                <div class="col-md-6">
                                                    <div class="mt-3">
                                                        <p><b><?= $profil->nama; ?></b></p>
                                                    </div>
                                                </div>
                                            <?php elseif($_GET['pilihan'] == '2') : ?>
                                                <div class="col-md-6">
                                                    <div class="mt-3">
                                                        <p><b><?= $profil->nama; ?></b></p>
                                                    </div>
                                                    <div class="mt-3">
                                                        <abbr title="Phone">Phone : </abbr> <?= $profil->no_telp; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        
                                        </div>
                                        <!-- end row -->
                                    <?php endif ; ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <?php if($_GET['pilihan'] == '1') : ?>
                                                    <table class="table mt-4 table-centered">
                                                    <thead>
                                                    <tr>
                                                        <th>Jenis Tukar</th>
                                                        <th>Nominal</th>
                                                        <th>No Tujuan</th>
                                                        <th>Status</th>
                                                    </tr></thead>
                                                    <tbody>
                                                            <?php $ambil = "SELECT * FROM penukaran INNER JOIN wallet ON penukaran.id_wallet=wallet.id_wallet WHERE id_tukar='$_GET[tukar]'";
                                                            $resulttt = mysqli_query($koneksi, $ambil);
                                                            while ($row = mysqli_fetch_assoc($resulttt)) { ?>
                                                                <tr>
                                                                    <!-- menampilkan sampah yang akan di pickup -->
                                                                    <td><?= $row['wallet']; ?></td>
                                                                    <td>Rp. <?= number_format($row['nominal']); ?></td>
                                                                    <td><?= $row['telpon']; ?></td>
                                                                    <td><?= $row['status']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                <?php elseif($_GET['pilihan'] == '2') : ?>
                                                    <?php if(isset($_GET['id'])) : ?>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                            <br><br><h1 class="mt-1 mb-1 font-18 ellipsis">SETOR SAMPAH</h1><br>
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
                                                        <br><h1 class="mt-1 mb-1 font-18 ellipsis">PEMBELIAN BARANG</h1><br>
                                                        <table class="table mt-4 table-centered">
                                                        <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Jenis</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Total</th>
                                                        </tr></thead>
                                                        <tbody>
                                                            <?php $ambil = "SELECT * FROM pembelian JOIN detail_pemb ON pembelian.id_pemb=detail_pemb.id_pemb JOIN barang ON detail_pemb.id_brg=barang.id_brg WHERE detail_pemb.id_pemb='$_GET[pemb]'";
                                                            $resulttt = mysqli_query($koneksi, $ambil); ?>
                                                            <?php while ($row = mysqli_fetch_assoc($resulttt)) { ?>
                                                                <tr>
                                                                    <!-- menampilkan sampah yang akan di pickup -->
                                                                    <td><?= $row['nama_brg']; ?></td>
                                                                    <td><?= $row['jenis_brg']; ?></td>
                                                                    <td><?= $row['jumlah']; ?></td>
                                                                    <td>Rp. <?= number_format($row['harga_brg']); ?></td>
                                                                    <td><span>Rp. <?= number_format($row['subtotal']); ?></span></td>
                                                                </tr>
                                                                <?php } ?>
                                                        </tbody>
                                                        </table>
                                                    <?php else : ?>
                                                        <table class="table mt-4 table-centered">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Jenis</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Total</th>
                                                        </tr></thead>
                                                        <tbody>
                                                            <?php $nomor = 1;?>
                                                            <?php $ambil = "SELECT * FROM pembelian JOIN detail_pemb ON pembelian.id_pemb=detail_pemb.id_pemb JOIN barang ON detail_pemb.id_brg=barang.id_brg WHERE detail_pemb.id_pemb='$_GET[pemb]'";
                                                            $resulttt = mysqli_query($koneksi, $ambil); ?>
                                                            <?php while ($row = mysqli_fetch_assoc($resulttt)) { ?>
                                                                <tr>
                                                                    <!-- menampilkan sampah yang akan di pickup -->
                                                                    <td><?= $nomor; ?></td>
                                                                    <td><?= $row['nama_brg']; ?></td>
                                                                    <td><?= $row['jenis_brg']; ?></td>
                                                                    <td><?= $row['jumlah']; ?></td>
                                                                    <td>Rp. <?= number_format($row['harga_brg']); ?></td>
                                                                    <td><span>Rp. <?= number_format($row['subtotal']); ?></span></td>
                                                                </tr>
                                                                <?php $nomor++; ?>
                                                                <?php } ?>
                                                        </tbody>
                                                        </table>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            
                                            <?php if($_GET['pilihan'] == '1') : ?>
                                                <?php $ambil = "SELECT * FROM penukaran WHERE id_tukar='$_GET[tukar]'";
                                                $resulttt = mysqli_query($koneksi, $ambil);
                                                $row = mysqli_fetch_assoc($resulttt); ?>
                                                <p class="m-0 d-print-none"><b>TOKEN TUKAR : <?= $row['token_tukar'];?></b></p>
                                            <?php elseif($_GET['pilihan'] == '2') : ?>
                                                <?php if(isset($_GET['id'])) : ?>
                                                    <?php 
                                                    $tgl = "SELECT * FROM pembelian WHERE id_ksmn = '".$_SESSION["konsumen"]["id_ksmn"]."' AND id_pemb = '".$_GET["pemb"]."'";
                                                    $tg = mysqli_query($koneksi,$tgl);
                                                    $l = mysqli_fetch_assoc($tg);
                                                    $setorr = "SELECT * FROM setor WHERE id_ksmn = '".$_SESSION["konsumen"]["id_ksmn"]."' AND id_setor = '".$_GET["id"]."'";
                                                    $fifi = mysqli_query($koneksi,$setorr);
                                                    $setor = mysqli_fetch_assoc($fifi);?>
                                                    <br><br><br><div class="col-md-6">
                                                        <div class="text-md">
                                                            <p><b>Token&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&emsp;&nbsp;: </b> <?= $l['token_pemb']; ?></p>
                                                            <p><b>Status&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;: </b> <?= $l['status_pemb']; ?></p>
                                                            <p><b>Total poin barang&nbsp;&nbsp;: </b>Rp. <?= number_format($l['total']); ?></p>
                                                            <p><b>Total barang&emsp;&ensp;&emsp;&nbsp;&nbsp;: </b> <?= $l['jumlah_brg']; ?></p>
                                                            <p><b>Sisa Poin di Dapat&nbsp;: </b> <?= number_format($setor['total_harga']); ?></p>
                                                        </div>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <?php 
                                                    $tgl = "SELECT * FROM pembelian WHERE id_ksmn = '".$_SESSION["konsumen"]["id_ksmn"]."' AND id_pemb = '".$_GET["pemb"]."'";
                                                    $tg = mysqli_query($koneksi,$tgl);
                                                    $l = mysqli_fetch_assoc($tg);?>
                                                    <div class="col-md-6">
                                                        <div class="text-md">
                                                            <p><b>Token&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&emsp;: </b> <?= $l['token_pemb']; ?></p>
                                                            <p><b>Status&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: </b> <?= $l['status_pemb']; ?></p>
                                                            <p><b>Total poin barang&nbsp;: </b>Rp. <?= number_format($l['total']); ?></p>
                                                            <p><b>Total barang&emsp;&ensp;&emsp;&nbsp;: </b> <?= $l['jumlah_brg']; ?></p>
                                                        </div>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                    <form method="post">
                                        <div class="hidden-print mt-4">
                                            <div class="text-right d-print-none">
                                                <a href="dashcus.php" class="btn btn-blue waves-effect waves-light"></i> Kembali</a>
                                            </div>
                                        </div>
                                    </form>
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