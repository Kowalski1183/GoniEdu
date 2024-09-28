<?php 
include "header.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
   exit;
}
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

                            <div class="col-md-12">
                                <div class="company-card card-box">
                                <!-- <span class="pull-center" align="center"> -->
                                        <div class="float-left mr-3" >
                                                <!-- <img src="koin.png" alt="logo" class="company-logo avatar-md rounded"> -->
                                                
                                                <img class="img-circle" alt="user" src="koin.png"style="width:110px;height:110px;">
                                            </div>
                                        <h2>Goni Poin</h2>
                                    <div class="company-detail mb-3">
                                            <?php
                                            $profill = "SELECT * from konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                            $quary = mysqli_query($koneksi, $profill);
                                            $profil = mysqli_fetch_object($quary)?>
                                            <?php if($profil->poin < 0 || $profil->poin == 0) : ?>
                                                <h3 class="font-weight-medium my-2 text-success"><span data-plugin="counterup">0</span></h3>
                                            <?php elseif($profil->poin > 0) : ?>
                                                <h3 class="font-weight-medium my-2 text-success"><span data-plugin="counterup"><?= number_format($profil->poin);?></span></h3>
                                            <?php endif; ?>
                                            </div>
                                    <div class="btn-group mb-2">
                                        <div class="btn-group">
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="formpickup.php">Pickup Sampah</a>
                                                <a class="dropdown-item" href="formantar.php">Antar Sampah</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="company-2" class="text-center"></div>

                                </div>
                            </div><!-- end col -->

                            <div class="col-md-12">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <div class="media">
                                        <img class="icon-colored" src="assets/images/icons/shipped.svg" title="shipped.svg"/>
                                        <div class="wigdet-two-content media-body">
                                            <span class="pull-center" align="center">
                                            <h2 class="mb-4 text-success"><a href="formpickup.php" id="picksetor">PICKUP / ANTAR SAMPAH</a></h2>
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">sampahmu akan dijemput atau antar sampahmu ke bank sampah</p>
                                            <p class="m-0">Jan - Apr 2019</p>
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
                                            <h2 class="mb-4 text-warning"><a href="pilihjenis.php" id="pikpoin">TUKAR POINT</a></h2>
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Tukarkan poinmu dengan barang di bank sampah</p>
                                            <p class="m-0">Jan - Apr 2019</p>
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
                                            <h2 class="mb-4 text-warning"><a href="pilihriwayat.php">Riwayat</a></h2>
                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Riwayat Anda</p>
                                            <p class="m-0">Jan - Apr 2019</p>
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
            $(document).on('click', '#picksetor', function(e){
                e.preventDefault();
                var link = $(this).attr('href');
                Swal.fire({
                title: 'Anda Tidak Dapat Kembali Sebelum Menyelesaikan Transaksi Setor Sampah !',
                text: "Pastikan Alamat Anda Benar di Profil",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lanjutkan'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;
                }
                })
            })
            $(document).on('click', '#pikpoin', function(e){
                e.preventDefault();
                var link = $(this).attr('href');
                Swal.fire({
                title: 'Lanjutkan Transaksi Poin?',
                text: "Kamu Tidak Dapat Kembali Sebelum Menyelesaikan Transaksi Poin",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lanjutkan'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;
                }
                })
            })
        </script>
    </body>
</html>
            