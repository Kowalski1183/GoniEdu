<?php
include "header.php";
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;}
?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <form method="POST">
                <div class="col-md-12">
                    <div class="card-box widget-box-two widget-two-custom">
                        <div class="media">
                            <img class="icon-colored" src="assets/images/icons/shipped.svg" title="shipped.svg"/>
                            <div class="wigdet-two-content media-body">
                                <span class="pull-center" align="center">
                                    <h2 class="mb-4 text-success">Riwayat Setor Sampah</h2>
                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">sampahmu akan dijemput petugas bank sampah</p>
                                    <p class="m-0">Jan - Apr 2019</p>
                                    <button name="pilihan" type="submit" value="1" class="btn  btn-square btn-primary">Lihat</button>
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
                                    <h2 class="mb-4 text-warning">Riwayat Penukaran Poin</h2>
                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Antarkan Sendiri Sampahmu ke BANK Sampah</p>
                                    <p class="m-0">Jan - Apr 2019</p>
                                    <button name="pilihan" type="submit" value="2" class="btn  btn-square btn-primary">Lihat</button>
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
                                    <h2 class="mb-4 text-success">Riwayat Pembelian Barang</h2>
                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Antarkan Sendiri Sampahmu ke BANK Sampah</p>
                                    <p class="m-0">Jan - Apr 2019</p>
                                    <button name="pilihan" type="submit" value="3" class="btn  btn-square btn-primary">Lihat</button>
                            </div>
                        </div>
                    </div>
                </div><div class="col-md-12">
                    <div class="card-box widget-box-two widget-two-custom ">
                        <div class="media">
                            <img class="icon-colored" src="assets/images/icons/sports_mode.svg" title="sports_mode.svg"/>
                            <div class="wigdet-two-content media-body">
                                <span class="pull-center" align="center">
                                    <h2 class="mb-4 text-warning">Mutasi Poin</h2>
                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Antarkan Sendiri Sampahmu ke BANK Sampah</p>
                                    <p class="m-0">Jan - Apr 2019</p>
                                    <button name="pilihan" type="submit" value="4" class="btn  btn-square btn-primary">Lihat</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> 

                <?php
                if (isset($_POST["pilihan"])) {
                    $pilihan = $_POST["pilihan"];
                    //tampilan dialihkan ke formnya
                    echo "<script>location='riwayat.php?pilihan=$pilihan';</script>";
                } ?>

        </div>
    </div>

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
<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>