<?php
include"header2.php";
if (!isset($_SESSION['login'])) {
    header("location: login.php");exit;
} else {
    if (empty($_SESSION['barang']) or !isset($_SESSION['barang'])) {
        echo "<script>alert('anda belum masukkan barang');</script>";
        if ($_GET['tkr']){
            $tukar = $_GET['tkr'];
            echo "<script>location='formtukar.php?id=$tukar&&pilihan=2';</script>";
        }else{
            echo "<script>location='formtukar.php?pilihan=2';</script>";
        }
    }
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
                                            <li class="breadcrumb-item active">Keranjang</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Keranjang</h4>
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
                                            <h3 class="m-0 d-print-none">Keranjang</h3>
                                        </div>
                                    </div>

                                    <?php if (isset($_GET['tkr'])) : ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                    <p><b>POIN ANDA : <?= $_GET['harga'];?></b></p>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- end row -->
                                    <?php else : ?>
                                        <?php
                                            $mutasi = "SELECT * FROM konsumen WHERE id_ksmn = '".$_SESSION["konsumen"]["id_ksmn"]."'";
                                            $mutasii = mysqli_query($koneksi, $mutasi);
                                            $konsumen =  mysqli_fetch_assoc($mutasii);?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mt-3">
                                                        <p><b>POIN ANDA : <?= number_format($konsumen['poin']);?></b></p>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php endif; ?>
                                    <!-- Start of In--->
                                    

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4 table-centered">
                                                    <thead>
                                                    <tr><th>No</th>
                                                        <th>Barang</th>
                                                        <th>Jenis Barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga / satuan </th>
                                                        <th>Total</th>
                                                        <th>Hapus</th>
                                                    </tr></thead>
                                                    <tbody>
                                                        <?php $nomor = 1;?>
                                                        <?php $total = 0; 
                                                        $jmlh = 0; ?>
                                                        <?php foreach ($_SESSION['barang'] as $id_brg => $jumlah) : ?>
                                                            <tr>
                                                                <!-- menampilkan sampah yang akan di pickup -->
                                                                <?php
                                                                $ambil = "SELECT * FROM barang WHERE id_brg='$id_brg'";
                                                                $result = mysqli_query($koneksi, $ambil);
                                                                $row = mysqli_fetch_assoc($result);
                                                                $totharga = $row["harga_brg"] * $jumlah;?>
                                                                <td><?= $nomor; ?></td>
                                                                <td><?= $row['nama_brg']; ?></td>
                                                                <td><?= $row['jenis_brg']; ?></td>
                                                                <td><?= $jumlah; ?></td>
                                                                <td>Rp.&ensp;<?= number_format($row["harga_brg"]); ?></td>
                                                                <td><span>Rp.&ensp;<?= number_format($totharga); ?></span></td>
                                                                <td class="btn btn-blue waves-effect waves-light"><a href="delpickup.php?brg=<?= $id_brg; ?>&&jumlah=<?= $jumlah; ?>">Hapus</i></a></td>
                                                            </tr>
                                                        <?php $nomor++; ?>
                                                        <?php $total += $totharga;
                                                        $jmlh += $jumlah; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="clearfix pt-4">
                                                <h6 class="text-muted">Notes:</h6>
                                                <?php if (isset($_GET['tkr'])) : ?>
                                                    <?php if (($_GET['harga']-$total) < 0) : ?>
                                                        <small>
                                                            POIN ANDA TIDAK MENCUKUPI !!
                                                        </small>
                                                    <?php else : ?>
                                                        <small>
                                                            Penukaran barang sedang di proses.
                                                        </small>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <?php if (($konsumen['poin']-$total) < 0) : ?>
                                                        <small>
                                                            SALDO POIN ANDA TIDAK MENCUKUPI !!!
                                                        </small>
                                                    <?php else : ?>
                                                        <small>
                                                            Penukaran barang sedang di proses.
                                                        </small>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="text-md-right">
                                                <p><b>Total poin barang: </b> <?= $total; ?></p>
                                                <?php if (isset($_GET['tkr'])) {
                                                    $sisa1 = ($_GET['harga']-$total) >= 0;
                                                }else{
                                                    $sisa2 = ($konsumen['poin']-$total) >=0 ;
                                                } ?>
                                                <?php if (isset($_GET['tkr'])) : ?>
                                                    <p id="sisapoin"><b>Sisa Poin Anda : </b><h3><?= number_format($_GET['harga']-$total); ?></h3></p>
                                                <?php else : ?>
                                                    <p id="sisapoin"><b>Sisa Poin Anda : </b><h3><?= number_format($konsumen['poin']-$total); ?></h3></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <form method="post">
                                        <div class="hidden-print mt-4">
                                            <div class="text-right d-print-none">
                                                <?php if (isset($_GET['tkr'])) : ?>
                                                    <a href="formtukar.php?id=<?php echo $_GET['tkr'];?>&&pilihan=2" class="btn btn-blue waves-effect waves-light"></i> Kembali</a>
                                                <?php else : ?>
                                                    <a href="formtukar.php?pilihan=2" class="btn btn-blue waves-effect waves-light">Kembali</a>
                                                <?php endif; ?>
                                                <button type="submit" class="btn  btn-square btn-primary" name="beli">Checkout</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <?php
                                    if (isset($_POST["beli"])) {
                                        $id_konsumen = $_SESSION["konsumen"]["id_ksmn"];
                                        $tanggal = date("Y-m-d");
                                        $alamat = $_GET['alamat'];

                                        if(isset($_GET['tkr'])){
                                            if($_GET['harga'] > $total){
                                                $sisa = $_GET['harga']-$total;
                                                $up = "UPDATE `setor` SET `total_harga`='$sisa' WHERE `id_ksmn`='$id_konsumen' AND `id_setor`='".$_GET['tkr']."'";
                                                $update = mysqli_query($koneksi, $up);
                                                $Query = "SELECT max(token_pemb) as maxKode FROM pembelian";
                                                $hasul = mysqli_query($koneksi, $Query);
                                                $datas = mysqli_fetch_assoc($hasul);
                                                $maxkode = $datas['maxKode'];
                                                $norut = $maxkode[strlen($maxkode)-1];
                                                $norut++;
                                                $char = "PB";
                                                $kodejadi = $char . sprintf("%04s", $norut);
        
                                                $sqld = "INSERT INTO `pembelian` (`tgl_pemb`, `jumlah_brg`, `total`,`token_pemb`,`id_ksmn`,`pimbol`) VALUES ('$tanggal','$jmlh','$total','$kodejadi','$id_konsumen','1')";
        
                                                $result = mysqli_query($koneksi, $sqld);
        
                                                //mendapatkan id transaksi yang baru saja dilakukan [rumus]
                                                $id_pemb = $koneksi->insert_id;
        
                                                foreach ($_SESSION["barang"] as $id_brg => $jumlah) {
                                                    $sql = mysqli_query($koneksi, "INSERT INTO `detail_pemb`(`jumlah`, `subtotal`, `id_pemb`, `id_brg`) VALUES ('$jumlah','$totharga','$id_pemb','$id_brg')");
                                                }
                                            }else{
                                                echo "<script>alert('Poin Anda Tidak Cukup');</script>";
                                                echo "<script>location='formtukar.php?id=$id_setor&&pilihan=2&&harga=$harga&&alamat=$alamat';</script>";
                                            }
                                        }else{
                                            if($konsumen['poin'] > $total){
                                                $sisa = $konsumen['poin']-$total;
                                                $up = "UPDATE `konsumen` SET `poin`='$sisa' WHERE `id_ksmn`='$id_konsumen'";
                                                $update = mysqli_query($koneksi, $up);
                                                $Query = "SELECT max(token_pemb) as maxKode FROM pembelian";
                                                $hasul = mysqli_query($koneksi, $Query);
                                                $datas = mysqli_fetch_assoc($hasul);
                                                $maxkode = $datas['maxKode'];
                                                $norut = $maxkode[strlen($maxkode)-1];
                                                $norut++;
                                                $char = "PB";
                                                $kodejadi = $char . sprintf("%04s", $norut);
        
                                                $sqld = "INSERT INTO `pembelian` (`tgl_pemb`, `jumlah_brg`, `total`,`token_pemb`,`id_ksmn`,`pimbol`) VALUES ('$tanggal','$jmlh','$total','$kodejadi','$id_konsumen','0')";
        
                                                $result = mysqli_query($koneksi, $sqld);
        
                                                //mendapatkan id transaksi yang baru saja dilakukan [rumus]
                                                $id_pemb = $koneksi->insert_id;
        
                                                foreach ($_SESSION["barang"] as $id_brg => $jumlah) {
                                                    $sql = mysqli_query($koneksi, "INSERT INTO `detail_pemb`(`jumlah`, `subtotal`, `id_pemb`, `id_brg`) VALUES ('$jumlah','$totharga','$id_pemb','$id_brg')");
                                                }
                                            }else{

                                               
                                                
                                                foreach ($_SESSION["barang"] as $id_brg => $jumlah) {
                                                    $stok = "SELECT stock FROM `barang` WHERE id_brg = '".$id_brg."'";
                                                    $result = mysqli_query($koneksi, $stok);
                                                    $row = mysqli_fetch_assoc($result);
                                                    $stock1 = $row['stock'];
                                                    $stockAkhir = $stock1 + $jumlah;
                                                    $sql = mysqli_query($koneksi, "UPDATE `barang` SET `stock` = ".$stockAkhir." WHERE `barang`.`id_brg` = ".$id_brg."");
                                                }
                                                echo "<script>alert('Poin Anda Tidak Cukup');</script>";
                                                unset($_SESSION["barang"]);
                                                echo "<script>location='dashcus.php?';</script>";
                                                exit;
                                                
                                            }
                                        }

                                        //mengosongkan cart Pickup belanja dengan unset session
                                        unset($_SESSION["barang"]);
                                        $pilihan = $_GET['pilihan'];

                                        //tampilan dialihkan ke nota
                                        if(isset($_GET['tkr'])){
                                            $id_setor = $_GET['tkr'];
                                            echo "<script>alert('pembelian sukses');</script>";
                                            echo "<script>location='notpembelian.php?pemb=$id_pemb&&pilihan=$pilihan&&id=$id_setor&&alamat=$alamat';</script>";
                                        }else{
                                            echo "<script>alert('pembelian sukses');</script>";
                                            echo "<script>location='notpembelian.php?pemb=$id_pemb&&pilihan=$pilihan';</script>";
                                        }
                                    } ?>

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