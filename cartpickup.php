<?php
include"header2.php";
if (!isset($_SESSION['login'])) {
    header("location: login.php");
} else {
    if (empty($_SESSION["setor_sampah"]) or !isset($_SESSION["setor_sampah"])) {
        echo "<script>alert('anda belum masukkan sampah');</script>";
        echo "<script>location='dashcus.php';</script>";
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
                                            <li class="breadcrumb-item active">Keranjang Sampah</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Keranjang Sampah</h4>
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
                                            <h3 class="m-0 d-print-none">Keranjang Sampah</h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4 table-centered">
                                                    <thead>
                                                    <tr><th>no</th>
                                                        <th>Jenis Sampah</th>
                                                        <th>Berat Sampah</th>
                                                        <th>Harga</th>
                                                        <th>Hapus</th>
                                                    </tr></thead>
                                                    <tbody>
                                                        <?php $nomor = 1;?>
                                                        <?php foreach ($_SESSION["setor_sampah"] as $id_sampahsetor => $jumlah) : ?>
                                                            <tr>
                                                                <!-- menampilkan sampah yang akan di pickup -->
                                                                <?php
                                                                $ambil = "SELECT * FROM sampah_setor JOIN sampah USING (id_smph) WHERE id_sampahsetor='$id_sampahsetor'";
                                                                $resultt = mysqli_query($koneksi, $ambil);
                                                                $row = mysqli_fetch_assoc($resultt);
                                                                ?>
                                                                <td><?= $nomor; ?></td>
                                                                <td><?= $row['kategori_smph']; ?></td>
                                                                <td><?= $row['berat']; ?></td>
                                                                <td><?= $row['harga']; ?></td>
                                                                <td><button class="btn btn-blue waves-effect waves-light" id="hapus" onclick="chkcontrol()">Hapus</button></td>
                                                            </tr>
                                                        <?php $nomor++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- buat hapus -->
                                        <script type="text/javascript">
                                            function chkcontrol() {
                                                var yakin = confirm("Apakah kamu yakin akan menghapus sampah setor?");
                                                if (yakin) {
                                                    window.location = "delpickup.php?id=<?= $id_sampahsetor; ?>";
                                                } else {
                                                    window.location = "cartpickup.php";
                                                }
                                            }
                                        </script>
                                    </div>

                                    <div class="hidden-print mt-4">
                                        <div class="text-right d-print-none">
                                                <a href="formpickup.php" class="btn btn-blue waves-effect waves-light"></i> Kembali</a>
                                                <a href="pickup.php" class="btn btn-info waves-effect waves-light">Submit</a>
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
        <script src="assets/js/sweetalert2.min.js"></script>
        <script>
            Swal.fire({
            title: 'Apakah Anda Ingin Menambah Sampah ?',
            text: "Anda Akan Kembali Ke Halaman Setor",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tambah Sampah'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location = "formpickup.php";
            }
            })
        </script>
        
    </body>
</html>