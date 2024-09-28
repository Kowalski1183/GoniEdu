<?php
include "header.php";
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;}
?>
 
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="profile-bg-picture" style="background-image:url('assets/images/bg-profile.jpg')">
                                    <span class="picture-bg-overlay"></span><!-- overlay -->
                                </div>
                                <!-- meta -->
                                <div class="profile-user-box">
                                    <div class="row">
                                    <?php
                                                $profile = "SELECT * FROM konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                                $result = mysqli_query($koneksi, $profile);
                                                $profil = mysqli_fetch_object($result);   
                                            ?>
                                        <div class="col-sm-4">
                                            <h1 class="mt-1 mb-1 font-18 ellipsis">BIODATA DIRI</h1><br>
                                                <span><img src="<?= $profil->image;?>" alt="" class="avatar-xl rounded-circle"></span>
                                            </div>
                                        <div class="col-sm-8">
                                            <div class="media-body">
                                                <h4 class="mt-1 mb-1 font-18 ellipsis"><?= $profil->nama;?></h4>
                                                <p class="font-13"><b>Username</b>&emsp;: <?= $profil->username;?></p>
                                                <p class="font-13"><b>No Telpon</b>&emsp;: <?= $profil->no_telp;?></p>
                                                <p class="font-13"><b>Email</b>&emsp;&emsp;&ensp;&ensp; : <?= $profil->email;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ meta -->
                            </div>
                        </div>
                    </div> <!-- end container-fluid -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="search-result-box card-box">
                                    <!-- end row -->

                                    <ul class="nav nav-tabs tabs-bordered">
                                        <li class="nav-item">
                                            <a href="#home" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                Alamat
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="editprofil.php?id_ksmn=<?php echo $profil->id_ksmn?>"class="btn">Edit Profil</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home">
                                            <div class="row">
                                                <div class="col-md-12">
                                                <?php 
                                                $nomor = 1;
                                                $ssalamat = "SELECT * FROM alamat_konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                                $salamat = mysqli_query($koneksi,$ssalamat);
                                                $jumalamat = mysqli_num_rows($salamat);
                                                while ($alamat = mysqli_fetch_assoc($salamat)){;
                                                ?>
                                                <div class="card-box widget-box-two widget-two-custom" id="almt">
                                                    <div class="media">
                                                        <div class="wigdet-two-content media-body">
                                                            <span class="pull-center" align="left">
                                                            <h1 class="mt-1 mb-1 font-18 ellipsis">Alamat <?= $nomor;?></h1><br>
                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >RT&emsp;&emsp;&emsp;&emsp;&nbsp;&ensp;: <?php echo $alamat['RT'];?></p>
                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >RW&emsp;&emsp;&emsp;&emsp;&nbsp;: <?php echo $alamat['RW'];?></p>
                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jalan&emsp;&emsp;&ensp;&nbsp;: <?php echo $alamat['jalan'];?></p>
                                                            <p class="m-0  font-weight-medium text-truncate" >Kecamatan : <?php echo $alamat['kecamatan'];?></p>
                                                            <div class="hidden-print mt-4">
                                                                <div class="text-right d-print-none">
                                                                        <a href="editprofil.php?id_ksmn=<?php echo $alamat['id_ksmn'];?>&&id_alamat=<?php echo $alamat['id_alamat'];?>" class="btn btn-blue waves-effect waves-light"></i>Edit</a>
                                                                        <a href="delpickup.php?id_ksmn=<?php echo $alamat['id_ksmn'];?>&&id_alamat=<?php echo $alamat['id_alamat'];?>" class="btn btn-info waves-effect waves-light">Hapus</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $nomor++; ?>
                                                <?php };?>
                                                
                                            <?php if($jumalamat < 2) { ?>
                                                <div type="submit" name="edit">
                                                    <a href="tambahalmt.php?id_ksmn=<?php echo $profil->id_ksmn?>"class="btn btn-primary" id="tambah">Tambah Alamat</a>
                                                </div>
                                            <?php } else { ?>
                                                <div type="submit" name="edit" style="display:none;">
                                                    <a href="tambahalmt.php?id_ksmn=<?php echo $profil->id_ksmn?>"class="btn btn-primary" id="tambah">Tambah Alamat</a>
                                                </div>
                                            <?php } ?> 
                                                </div>
                                                    
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                            <div class="clearfix"></div>


                                        </div>
                                        <!-- end Users tab -->

                                    </div>
                                </div>
                            </div>
                        </div>

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
        <script language='javascript'>
            $(document).on('click', '#tambah', function(e){
                var valueSelected = this.value;
                if(valueSelected == 'Tukar'){
                    document.getElementById('jsetor').style.display = "block";
                }else{
                    document.getElementById('jsetor').style.display = "none";
                }
            })
        </script>
        
    </body>
</html>