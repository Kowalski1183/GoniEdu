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
                                        <div class="col-sm-4">
                                            <h1 class="mt-1 mb-1 font-18 ellipsis">BIODATA DIRI</h1><br>
                                                <span><img src="assets/images/companies/Gonigoni.png" alt="" class="avatar-xl rounded-circle"></span>
                                            </div>
                                        <div class="col-sm-8">
                                            <?php
                                                $profile = "SELECT * FROM konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                                $result = mysqli_query($koneksi, $profile);
                                                $profil = mysqli_fetch_object($result);   
                                            ?>
                                            
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
                                        <a href="profil.php?id_ksmn=<?php echo $profil->id_ksmn?>"class="btn" >Alamat</a>
                                        </li>
                                        <?php if(isset($_GET['lok'])) { ?>
                                            <li class="nav-item" style="display:none;">
                                                <a href="editprofil.php?id_ksmn=<?php echo $profil->id_ksmn?>"class="btn" style="display:none;">Edit Profil</a>
                                            </li>
                                        <?php } else { ?>
                                            <li class="nav-item">
                                                <a href="editprofil.php?id_ksmn=<?php echo $profil->id_ksmn?>"class="btn">Edit Profil</a>
                                            </li>
                                        <?php } ?>
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home">
                                        <h1 class="mt-1 mb-1 font-18 ellipsis">TAMBAH ALAMAT</h1><br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action=" " method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" name="form">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4" class="col-form-label">RT</label>
                                                                <input type="text" class="form-control" name="rt">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4" class="col-form-label">RW</label>
                                                                <input type="text" class="form-control" name="rw">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="inputEmail4" class="col-form-label">Jalan</label>
                                                                <input type="text" class="form-control" name="jalan">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label for="inputEmail4" class="col-form-label">Kecamatan</label>
                                                                <input type="text" class="form-control" name="kec">
                                                            </div>
                                                        </div>
                                                        <div class="mt-5 text-center"><input type="submit" class="btn btn-primary" name="submit"></div>
                                                    </form>
                                                    
                                                    <?php
                                                    if (isset($_POST['submit'])) {
                                                        $id_kons = $_SESSION["konsumen"]["id_ksmn"];
                                                        $rt = $_POST["rt"];
                                                        $rw = $_POST["rw"];
                                                        $jalan = $_POST["jalan"];
                                                        $kec = $_POST["kec"];
                                                        $update = mysqli_query($koneksi, "INSERT INTO `alamat_konsumen` (`id_ksmn`, `kecamatan`, `RT`, `RW`, `jalan`) VALUES ('$id_kons', '$kec', '$rt', '$rw', '$jalan')");
                                                        if ($update==true) {
                                                            if(isset($_GET['lok'])){
                                                                echo "<script>alert('Alamat berhasil di tambah'); location='pickup.php';</script>";
                                                            }else{
                                                                echo "<script>alert('Alamat berhasil di tambah'); location='profil.php?id_ksmn=$id_kons';</script>";
                                                            }
                                                        } else {
                                                            echo "Alamat gagal ditambah" . mysqli_error($koneksi);
                                                        }
                                                    }
                                                ?>
                        
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                        <!-- vALIDASI FORM -->
                                        <script>
                                        function validateForm() {
                                            let x = document.forms["form"]["nama"].value;
                                            if (x == "") {
                                                alert("data tidak boleh kosong");
                                                return false;
                                            }
                                        }
                                        function validateForm() {
                                            let x = document.forms["form"]["no_telp"].value;
                                            if (x == "") {
                                                alert("data tidak boleh kosong");
                                                return false;
                                            }
                                        }
                                        function validateForm() {
                                            let x = document.forms["form"]["email"].value;
                                            if (x == "") {
                                                alert("data tidak boleh kosong");
                                                return false;
                                            }
                                        }
                                        function validateForm() {
                                            let x = document.forms["form"]["Npass"].value;
                                            if (x == "") {
                                                alert("data tidak boleh kosong");
                                                return false;
                                            }
                                        }
                                        function validateForm() {
                                            let x = document.forms["form"]["pass"].value;
                                            if (x == "") {
                                                alert("data tidak boleh kosong");
                                                return false;
                                            }
                                        }
                                            </script>

                                        <!-- Users tab -->

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
        
    </body>
</html>