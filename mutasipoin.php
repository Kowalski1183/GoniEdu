<?php
include "header.php";
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
                                            <li class="breadcrumb-item active">Mutasi Poin</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Mutasi Poin</h4>
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
                                            <h3 class="m-0 d-print-none">Mutasi Poin</h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4 table-centered">
                                                    <thead>
                                                    <tr><th>no</th>
                                                        <th>Tanggal Mutasi</th>
                                                        <th>Debit</th>
                                                        <th>Kredit</th>
                                                        <th>Saldo</th>
                                                        <th>Total Point</th>
                                                        <th>Status</th>
                                                        <th>Detail</th>
                                                    </tr></thead>
                                                    <tbody>
                                                    <?php $nomor = 1;
                                                        $ambil = "SELECT * FROM mutasi_tabungan WHERE id_ksmn='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                                        $resultt = mysqli_query($koneksi, $ambil);?>
                                                        <?php while ($row = mysqli_fetch_assoc($resultt)) { ?>
                                                            <tr>
                                                                <td><?= $nomor; ?></td>
                                                                <td><?= $row['tgl_setor']; ?></td>
                                                                <td><?= $row['cara_setor']; ?></td>
                                                                <td><?= $row['jenis_setor']; ?></td>
                                                                <td><?= $row['total_berat']; ?></td>
                                                                <td><?= $row['total_point']; ?></td>
                                                                <td><?= $row['status']; ?></td>
                                                                <td class="btn btn-info waves-effect waves-light">Detail</td>
                                                            </tr>
                                                        <?php $nomor++; ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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