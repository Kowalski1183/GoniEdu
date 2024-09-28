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
                                                <li class="breadcrumb-item active">Setor Sampah</li>
                                        </ol>
                                    </div>
                                        <h4 class="page-title">Setor Sampah</h4>
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
                                                <h3 class="m-0 d-print-none">Setor Sampah</h3>
                                        </div>
                                    </div>

                                    <p><b><span id="tanggalwaktu"></span></b></p>
                                    <script>
                                        var dt = new Date();
                                        document.getElementById("tanggalwaktu").innerHTML = (dt.getFullYear()) +"-"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"-"+ (("0"+dt.getDate()).slice(-2));
                                    </script>
                                    <?php
                                    $profill = "SELECT * FROM konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                    $quary = mysqli_query($koneksi, $profill);
                                    $profil = mysqli_fetch_object($quary)?>
                                    <div class="row">
                                        <div class="col-md-6">
                                                <p><b><?= $profil->nama; ?></b></p>
                                        </div><!-- end col -->
                                    </div>
                                    <!-- end row -->
                                        

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <h5> Address</h5>
                                            <div class="form-group">
                                            <form method="POST" onsubmit="return validasi(this)">
                                                <div class="basic-form">
                                                    <div class="form-group" >
                                                        <?php
                                                        $x=1;
                                                        $rofill = "SELECT * FROM alamat_konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                                        $quaryy = mysqli_query($koneksi, $rofill);
                                                        $jumalamat = mysqli_num_rows($quaryy);
                                                        while($profile=mysqli_fetch_assoc($quaryy)) : ?>
                                                        <div class="form-check mb-2">
                                                            <div class="checkbox ">
                                                                <input id="<?php echo "checkbox".$x; ?>" type="checkbox" name = "alamat" id="alamat" value="<?php Echo $profile["id_alamat"]; ?>" onclick="chkcontrol()">
                                                                <label for="<?php echo "checkbox".$x; ?>">
                                                                RT : <?php Echo $profile["RT"]; $x+=1;?><br>RW : <?php echo $profile["RW"];?><br>Jalan : <?php echo $profile["jalan"];?><br>Kecamatan : <?php echo $profile["kecamatan"];?></label><br>
                                                            <a href="editprofil.php?id_ksmn=<?php echo $_SESSION["konsumen"]["id_ksmn"]?>&&id_alamat=<?php Echo $profile["id_alamat"]; ?>&&lok=<?php echo $profil->nama?>">Edit Alamat</a>
                                                            </div>
                                                        </div>
                                                        <?php endwhile; ?>
                                                        <?php if($jumalamat < 1) { ?>
                                                            <div type="submit" name="edit">
                                                                <a href="tambahalmt.php?id_ksmn=<?php echo $profil->id_ksmn?>&&lok=<?php echo $profil->nama?>"class="btn btn-primary" id="tambah">Tambah Alamat</a>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div type="submit" name="edit" style="display:none;">
                                                                <a href="tambahalmt.php?id_ksmn=<?php echo $profil->id_ksmn?>&&lok=<?php echo $profil->nama?>"class="btn btn-primary" id="tambah">Tambah Alamat</a>
                                                            </div>
                                                        <?php } ?> 
                                                    </div>
                                                    <script type="text/javascript">
                                                    function chkcontrol() {
                                                        var a = document.getElementsByName("alamat");
                                                        var total=0;
                                                        for(var i=0; i < a.length; i++){
                                                            if(a[i].checked)
                                                            {total =total +1;}
                                                            if(total > 1){
                                                                alert("Pilih Satu Alamat")
                                                                a[i].checked = false ;
                                                                return false;
                                                            }
                                                            }}
                                                            </script>
                                                </div>
                                            </div>
                                        </div>
                                            <!-- INPUT TANGGAL REQ SETORAN -->
                                            <div class="form-group">
                                                <b><label>Tanggal Jemput</label></b>
                                                <input type="date" class="form-control" placeholder="2017-06-04" name="tgl_jmpt">
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
                                                    </tr></thead>
                                                    <tbody>
                                                        <?php $nomor = 1;?>
                                                        <?php $harga = 0;
                                                        $totalberat = 0; ?>
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
                                                            </tr>
                                                        <?php $nomor++; ?>
                                                        <?php $harga+=$row['harga'];
                                                        $totalberat+=$row['berat'];?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="hidden-print mt-4">
                                            <select class="login-register-form" name="carasetor" id="carasetor">
                                                <option value="0">Pilih Cara Setor</option>
                                                <option value="Setor Mandiri">Setor Mandiri</option>
                                                <option value="Jemput">Sampah di jemput</option>
                                            </select><br><br>
                                            <select class="login-register-form" name="jenissetor" id="jenissetor">
                                                <option value="0">Pilih Jenis Setor</option>
                                                <option value="Tabung">Tabung</option>
                                                <option value="Tukar">Tukar</option>
                                            </select><br><br>
                                            <span style="display:none; color:red; font-size: 16px;" id="jsetor"><b></b>Setelah Konfirmasi Tukar, Anda Tidak Dapat Kembali Sebelum Menyelesaikan Tukar Poin !</span>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="clearfix pt-4">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-md-right">
                                                        <p><b>Berat Total : </b> <?= $totalberat; ?></p>
                                                        <p><b>Harga didapat : </b> Rp. <?= number_format($harga); ?></p>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="text-right d-print-none">
                                                <a href="cartpickup.php" class="btn btn-blue waves-effect waves-light"></i> Kembali</a>
                                                <button type="submit" class="btn  btn-square btn-primary" name="setor">Konfirmasi</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>

                                <?php
                                    if (isset($_POST["setor"])) {
                                        $id_konsumen = $_SESSION["konsumen"]["id_ksmn"];
                                        $cara_setor = $_POST["carasetor"];
                                        $jenis_setor = $_POST["jenissetor"];
                                        if(isset($_POST["alamat"])){$alamat = $_POST["alamat"];}                            
                                        $tanggal_setor = date("Y-m-d");
                                        $tanggal_jemput = $_POST["tgl_jmpt"];


                                        if($cara_setor=="Jemput"){   
                                            if(isset($alamat)){
                                                if($tanggal_jemput == "" || $tanggal_jemput < $tanggal_setor){
                                                    echo "<script>alert('Pastikan Anda Memilih Tanggal Jemput Tidak Sebelum Hari Ini');</script>";
                                                    echo "<script>location='pickup.php';</script>";
                                                }else{
                                                    $ad = "SELECT * FROM alamat_konsumen WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "' AND id_alamat = '".$alamat."'";
                                                    $adl = mysqli_query($koneksi, $ad);
                                                    $alt = mysqli_fetch_array($adl);
                                                    $RT = $alt["RT"];
                                                    $RW = $alt['RW'];
                                                    $Jalan = $alt['jalan'];
                                                    $kec = $alt['kecamatan'];
                                                    $alamat1 = 'RT/RW ' . $RT . '/' . $RW. " " . $Jalan . ' ' . $kec;

                                                        $sqld = "INSERT INTO `setor`(`id_ksmn`, `alamat_setor`, `total_berat`, 
                                                        `total_harga`,`tgl_setor`, `cara_setor`, 
                                                        `jenis_setor`) VALUES ('$id_konsumen','".$alamat1."',
                                                        '$totalberat','$harga','$tanggal_setor','$cara_setor','$jenis_setor')";
                                                        $result = mysqli_query($koneksi, $sqld);
                                                    //mendapatkan id transaksi yang baru saja dilakukan [rumus]
                                                    $id_setor = $koneksi->insert_id;

                                                    foreach ($_SESSION["setor_sampah"] as $id_sampahsetor => $jumlah) {
                                                        $sql = mysqli_query($koneksi, "INSERT INTO `detail_setor`(`id_setor`, `id_sampahsetor`,`tgl_jemput`) VALUES ('$id_setor','$id_sampahsetor','$tanggal_jemput')");
                                                    }

                                                    //mengosongkan cart Pickup belanja dengan unset session
                                                    unset($_SESSION["setor_sampah"]);

                                                    //tampilan dialihkan ke nota
                                                    if($jenis_setor == "Tukar"){
                                                        echo "<script>alert('pickup dengan tukar cash anda sukses');</script>";
                                                        echo "<script>location='notukar.php?id=$id_setor&&b=$cara_setor&&alamat=$alamat&&harga=$harga';</script>";
                                                    }else {
                                                        echo "<script>alert('pickup sukses');</script>";
                                                        echo "<script>location='notpickup.php?id=$id_setor&&b=$cara_setor&&alamat=$alamat';</script>";
                                                    }
                                                }
                                            }else{
                                                echo "<script>alert('Anda Belum Memilih Alamat');</script>";
                                                echo "<script>location='pickup.php';</script>";
                                            }
                                        }else{
                                            $sqld = "INSERT INTO `setor`(`id_ksmn`,`total_berat`, 
                                            `total_harga`,`tgl_setor`, `cara_setor`, 
                                            `jenis_setor`) VALUES ($id_konsumen,
                                            '$totalberat','$harga','$tanggal_setor','$cara_setor','$jenis_setor')";
                                            
                                            $result = mysqli_query($koneksi, $sqld);
                                            //mendapatkan id transaksi yang baru saja dilakukan [rumus]
                                            $id_setor = $koneksi->insert_id;

                                            foreach ($_SESSION["setor_sampah"] as $id_sampahsetor => $jumlah) {
                                                $sql = mysqli_query($koneksi, "INSERT INTO `detail_setor`(`id_setor`, `id_sampahsetor`) VALUES ('$id_setor','$id_sampahsetor')");
                                            }

                                            // mengosongkan cart Pickup belanja dengan unset session
                                            unset($_SESSION["setor_sampah"]);

                                            //tampilan dialihkan ke nota
                                            if($jenis_setor == "Tukar"){
                                                echo "<script>alert('pickup dengan tukar cash anda sukses');</script>";
                                                echo "<script>location='notukar.php?id=$id_setor&&b=$cara_setor&&alamat=$alamat&&harga=$harga';</script>";
                                            }else {
                                                echo "<script>alert('pickup sukses');</script>";
                                                echo "<script>location='notpickup.php?id=$id_setor&&b=$cara_setor&&alamat=$alamat';</script>";
                                            }
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
        <script src="assets/js/sweetalert2.min.js"></script>
        <script language='javascript'>
            function validasi(form){
                if(form.carasetor
                .value == "0"){
                    alert("Anda belum memilihi cara setor.");
                    form.carasetor.focus();
                    return(false)
                }
                if(form.jenissetor.value == "0"){
                    alert("Anda belum memilihi jenis setor.");
                    form.jenissetor.focus();
                    return(false)
                }
            }
            $(document).on('click', '#jenissetor', function(e){
                var valueSelected = this.value;
                if(valueSelected == 'Tukar'){
                    document.getElementById('jsetor').style.display = "none";
                }else{
                    document.getElementById('jsetor').style.display = "none";
                }
            })
        </script>
        
    </body>
</html>