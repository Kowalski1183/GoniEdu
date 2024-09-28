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
                                                $profil = mysqli_fetch_object($result); $OldPass = ($profil->password);  
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
                                        <a href="profil.php?id_ksmn=<?php echo $profil->id_ksmn?>"class="btn" >Alamat</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="editprofil.php?id_ksmn=<?php echo $profil->id_ksmn?>"class="btn" >Edit Profil</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php if(isset($_GET['id_alamat'])) : ?>
                                                        <?php 
                                                        $amt = "SELECT * FROM alamat_konsumen WHERE id_alamat='".$_GET['id_alamat']."' AND id_ksmn='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                                        $r = mysqli_query($koneksi, $amt);
                                                        $s = mysqli_fetch_object($r);?>
                                                        <h1 class="mt-1 mb-1 font-18 ellipsis"> EDIT ALAMAT</h1><br>
                                                        <form action=" " method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" name="form">
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">RT</label>
                                                                    <input type="text" class="form-control" name="rt" placeholder="<?php echo $s->RT?>"  value="<?php echo $s->RT;?>" >
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">RW</label>
                                                                    <input type="text" class="form-control" name="rw" placeholder="<?php echo $s->RW?>" value="<?php echo $s->RW;?>">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="inputEmail4" class="col-form-label">Jalan</label>
                                                                    <input type="text" class="form-control" name="jalan" placeholder="<?php echo $s->jalan?>" value="<?php echo $s->jalan;?>">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="inputEmail4" class="col-form-label">Kecamatan</label>
                                                                    <input type="text" class="form-control" name="kec" placeholder="<?php echo $s->kecamatan?>" value="<?php echo $s->kecamatan;?>">
                                                                </div>
                                                            </div>
                                                            <div class="mt-5 text-center"><input type="submit" class="btn btn-primary" name="submit"></div>
                                                        </form>
                                                    <?php else : ?>
                                                        <h1 class="mt-1 mb-1 font-18 ellipsis"> EDIT PROFILE</h1><br>
                                                        <form action=" " method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" name="form">
                                                        
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Nama</label>
                                                                    <input type="text" class="form-control" name="nama" placeholder="<?= $profil->nama;?>" value="<?= $profil->nama;?>" >
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">No.Telepon</label>
                                                                    <input type="text" class="form-control" name="no_telp" placeholder="<?= $profil->no_telp;?>" value="<?= $profil->no_telp;?>" >
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="inputEmail4" class="col-form-label">Email</label>
                                                                    <input type="text" class="form-control" name="email" placeholder="<?= $profil->email;?>" value="<?= $profil->email;?>">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">New Password</label>
                                                                    <input type="password" class="form-control" name="Npass" placeholder="enter new password" >
                                                                </div>
                                                                
                                                                <div class="form-group col-md-6">
                                                                    <label for="inputEmail4" class="col-form-label">Confirm Password</label>
                                                                    <input type="password" class="form-control" name="pass" placeholder="confirm password" >
                                                                </div>
                                                                <br>
                                                                <div class="demo-box">
                                                                    <div class="form-group mb-0">
                                                                        <label>Foto Profile</label><br>
                                                                        <input type="hidden" name="foto" value="<?php echo $profil->image; ?>">
                                                                        <input type="hidden" name="Oldpass" value="<?php echo $profil->password; ?>">
                                                                        
                                                                        <input type="file" name="image" class="filestyle" data-btnClass="btn-primary">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-5 text-center"><input type="submit" class="btn btn-primary" name="submit"></div>

                                                        </form>
                                                    <?php endif; ?>
                                                    
                                                    <?php
                                                        if (isset($_POST['submit'])) {
                                                            $id_kons = $_SESSION["konsumen"]["id_ksmn"];
                                                            if(isset($_GET['id_alamat'])){
                                                                $rt = $_POST["rt"];
                                                                $rw = $_POST["rw"];
                                                                $jalan = $_POST["jalan"];
                                                                $kec = $_POST["kec"];
                                                                $update = mysqli_query($koneksi, "UPDATE `alamat_konsumen` SET `kecamatan`='".$kec."',`RT`='".$rt."',`RW`='".$rw."',`jalan`='".$jalan."' WHERE id_ksmn='". $_SESSION["konsumen"]["id_ksmn"] ."' AND id_alamat='". $_GET["id_alamat"] ."'");
                                                                    if ($update==true) {
                                                                        if(isset($_GET['lok'])){
                                                                            echo "<script>alert('Alamat berhasil diupdate'); location='pickup.php?id_ksmn=$id_kons';</script>";
                                                                        }else{
                                                                            echo "<script>alert('Alamat berhasil diupdate'); location='profil.php?id_ksmn=$id_kons';</script>";
                                                                        }
                                                                    } else {
                                                                        echo "Alamat gagal diupdate" . mysqli_error($koneksi);
                                                                    }
                                                            }else{
                                                                $nama = $_POST["nama"];
                                                                $no_telp = $_POST["no_telp"];
                                                                $email = $_POST["email"];
                                                             
                                                                $password = $_POST['Npass'];
                                                                $pass2 = $_POST['pass'];
                                                                if ($password !== $pass2) {
                                                                    echo "password tidak sama";
                                                                    die();
                                                                }else{$epassword = password_hash($password, PASSWORD_BCRYPT);}
                                                                if(($_POST['Npass'])==''){
                                                                    $epassword = $_POST['Oldpass'];
                                                                    $pass2 = $_POST['Oldpass'];
                                                                }

                                                                $foto = $_POST["foto"];
                                                                $image = $_FILES["image"]['name'];
                                                                $tmp_name = $_FILES["image"]['tmp_name'];
                                                                $image_size = $_FILES["image"]['size'];
  
                                                                if ($image) {
                                                                    $target_dir = "assets/konsumen/";
                                                                    $namafile = "gambar" . $nama .  "." . strtolower(pathinfo($image, PATHINFO_EXTENSION));
                                                                    $target_file = $target_dir . $namafile;
                                                
                                                                    $uploadOk = 1;
                                                
                                                                    $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                                                
                                                                    if ($image_size > 1000000) {
                                                                        echo "Sorry, your file is too large.";
                                                                        $uploadOk = 0;
                                                                    }
                                                
                                                                    // Allow certain file formats
                                                                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                                                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                                                        $uploadOk = 0;
                                                                    }
                                                
                                                                    // Check if $uploadOk is set to 0 by an error
                                                                    if ($uploadOk == 0) {
                                                                        echo "Sorry, your file was not uploaded.";
                                                                        // if everything is ok, try to upload file
                                                                    } else {
                                                                        unlink('.assets/konsumen/' . $foto);
                                                
                                                                        move_uploaded_file($tmp_name, $target_file);
                                                
                                                                        $namagambar = $namafile;
                                                                    }
                                                
                                                                    //jika tidak update gambar
                                                                } else {
                                                                    $namagambar = $namafile;
                                                                }
                                                                echo $namagambar;
                                                                if($namagambar == ""){$update = mysqli_query($koneksi,"UPDATE `konsumen` SET `email`='".$email."',`password`='".$epassword."',`nama`='".$nama."',`no_telp`='".$no_telp."' WHERE id_ksmn='". $_SESSION["konsumen"]["id_ksmn"] ."'");}else{
                                                                $update = mysqli_query($koneksi,"UPDATE `konsumen` SET `email`='".$email."',`password`='".$epassword."',`nama`='".$nama."',`no_telp`='".$no_telp."',`image`='assets/konsumen/".$namagambar."' WHERE id_ksmn='". $_SESSION["konsumen"]["id_ksmn"] ."'");
                                                                }
                                                                if ($update) {
                                                                    echo "<script>alert('Profile berhasil diupdate'); location='profil.php?id_ksmn=$id_kons';</script>";
                                                                    
                                                                    
                                                                } else {
                                                                    echo "Profile gagal diupdate" . mysqli_error($koneksi);
                                                                }
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
                                        function validateForm() {
                                            let x = document.forms["form"]["rt"].value;
                                            if (x == "") {
                                                alert("data tidak boleh kosong");
                                                return false;
                                            }
                                        }
                                        function validateForm() {
                                            let x = document.forms["form"]["rw"].value;
                                            if (x == "") {
                                                alert("data tidak boleh kosong");
                                                return false;
                                            }
                                        }
                                        function validateForm() {
                                            let x = document.forms["form"]["jalan"].value;
                                            if (x == "") {
                                                alert("data tidak boleh kosong");
                                                return false;
                                            }
                                        }
                                        function validateForm() {
                                            let x = document.forms["form"]["kec"].value;
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