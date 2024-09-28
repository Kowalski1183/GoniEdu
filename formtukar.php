<?php
include"header.php";
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <form method="POST">
                    <div class="card-header">
                        <?php
                            $mutasi = "SELECT * FROM konsumen WHERE id_ksmn = '".$_SESSION["konsumen"]["id_ksmn"]."'";
                            $mutasii = mysqli_query($koneksi, $mutasi);
                            $konsumen =  mysqli_fetch_assoc($mutasii);?>
                            <h5 class="mb-4 text-success">1 GONIPOIN = Rp. 1.00</h5>
                            <b>Poin Anda : <?= number_format($konsumen['poin']);?></b>
                    </div>
                <!-- Start of Input -->
                <div class="card-body">
                    <!-- INPUT JENIS SETOR  -->
                                <?php if($_GET["pilihan"] == '1') : ?>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="recipent-name">Metode</label>
                                            <select name="bayarr" id="bayarr" class="form-control">
                                                <option value="0">--PILIH METODE--</option>
                                                <?php 
                                                //mengambil metode dalam database
                                                $metode = mysqli_query($koneksi , "SELECT * FROM metode ORDER BY nama");
                                                while($m=mysqli_fetch_assoc($metode)){?>
                                                    <option value="<?= $m['id_pilih'];?>"><?= $m['nama'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipent-name">Jenis Kirim</label>
                                            <select name="pilih" id="pilih" class="form-control">
                                                <option value="0">--PILIH--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <label for="inputPassword4" class="col-form-label">Poin yang ditukar</label>
                                                <input type="number" class="form-control" id="inputPassword4" placeholder="poin" name="poin" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <label for="inputPassword4" class="col-form-label" id="nomor">No</label>
                                                <input type="number" class="form-control" id="inputPassword4" name="telfon" required>
                                            </div>
                                        </div>
                                    </form>
                                <?php elseif($_GET["pilihan"] == '2') : ?>
                                    <!-- start page title -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="page-title-box">
                                                <div class="page-title-right">
                                                    <ol class="breadcrumb m-0">
                                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Belanja</a></li>
                                                        <li class="breadcrumb-item active">Produk</li>
                                                    </ol>
                                                </div>
                                                <h4 class="page-title">Produk</h4>
                                            </div>
                                        </div>
                                    </div>     
                                    <!-- end page title --> 
                                    <?php
                                        $barang = "SELECT * FROM barang JOIN gambar_brg USING (id_brg) where status_brg = 'Aktif'";
                                        $result = mysqli_query($koneksi, $barang);
                                        $row = mysqli_fetch_assoc($result); ?>
                                        <div class="row">
                                            <?php foreach ($result as $row) : ?>
                                                <div class="col-md-6 col-lg-3">
                                                    <!-- Simple card -->
                                                    <div class="card">
                                                        <img src="assets/barang/<?= $row['file_brg'] ?>" alt="Card image cap" width="200px" height="150px" style="display:block; margin:auto;">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?= $row['nama_brg']; ?></h5>
                                                            <div class="product-price">
                                                                <span class="new-price">Rp.<?= $row['harga_brg']; ?></span><br>
                                                                <span class="new-price">Stock :<?= $row['stock']; ?></span>
                                                            </div><br>
                                                            <p class="card-text"><?= $row['jenis_brg'];?></p>
                                                    
                                                        </div>
                                                        <div class="card-body">
                                                            <form method="POST">
                                                                <input type="hidden" value="<?= $row['id_brg']; ?>" name="buy_id">
                                                                <button type="Submit" class="btn  btn-square btn-primary" name="buy">Beli</button>
                                                            </form>
                                                        </div>
                                                        <?php
                                                            if (isset($_POST["buy"])) {
                                                                     $id_brg = $_POST['buy_id']; 
                                                                     $pilih = $_GET["pilihan"];

                                                                    $stok = "SELECT * FROM `barang` WHERE id_brg = '".$id_brg."'";
                                                                    $result = mysqli_query($koneksi, $stok);
                                                                    $row1 = mysqli_fetch_assoc($result);
                                                                    $stock1 = $row1['stock'];
                                                                
                                                                if($stock1>0){                                                                    
                                                                    echo "<script>location='tranbeli.php?brg=$id_brg&&pilihan=$pilih';</script>";
                                                                }else{
                                                                    echo "<script>alert('barang habis');</script>";
                                                                    echo "<script>location='formtukar.php?pilihan=$pilih';</script>";
                                                        
                                                                }
                                                            } 
                                                        ?>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            <?php endforeach; ?>
                                        </div>
                                    <!-- end row -->
                                <?php endif; ?>
                    
                    <!-- TOMBOL SUBMIT SETORAN -->
                    <?php if($_GET["pilihan"] == '1') : ?>
                        <div class="card-body">
                            <button type="Submit" class="btn  btn-square btn-primary" name="tukar">Submit</button>
                        </div>
                    <?php endif; ?>
                </div>
            </form> 

                <?php
                if (isset($_POST["tukar"])) {
                    $pilihan = $_GET['pilihan'];
                    $id_konsumen = $_SESSION["konsumen"]["id_ksmn"];
                    $jenis_tukar = $_POST['pilih'];
                    $tgl = date("Y-m-d");
                    $tlpn = $_POST["telfon"];
                    $harga = $_POST['poin'];

                    //menyimpan data ke tabel penukaran 
                    if($jenis_tukar=="0" || $pilihan=="0"){
                        echo "<script>alert('Pilihan tidak boleh kosong');</script>";
                        echo "<script>location='formtukar.php?pilihan=1';</script>";
                    }else{
                        $Query = "SELECT max(token_tukar) as maxKode FROM penukaran";
                        $hasul = mysqli_query($koneksi, $Query);
                        $datas = mysqli_fetch_array($hasul);
                        $maxkode = $datas['maxKode'];
                        $norut = $maxkode[strlen($maxkode)-1];
                        $norut++;
                        $char = "PN";
                        $kodejadi = $char . sprintf("%04s", $norut);
                        if(isset($_GET['id'])){
                            $sql = "INSERT INTO `penukaran`(`tgl_tukar`,`nominal`,`token_tukar`,`telpon`,`id_ksmn`,`id_wallet`,`simbol`) VALUES ('$tgl','$harga','$kodejadi','$tlpn','$id_konsumen','$jenis_tukar','1')";
                            $result = mysqli_query($koneksi, $sql);
                            
                            //mendapatkan id transaksi yang baru saja dilakukan [rumus]
                            $id_tukar = $koneksi->insert_id;

                            $update = "UPDATE `setor` SET `total_harga`='0' WHERE id_ksmn = '$id_konsumen' AND id_setor='".$_GET['id']."'";
                            $rupdate = mysqli_query($koneksi, $update);
                        }else{
                            if($harga < $konsumen['poin']){
                                $sql = "INSERT INTO `penukaran`(`tgl_tukar`,`nominal`,`token_tukar`,`telpon`,`id_ksmn`,`id_wallet`,`simbol`) VALUES ('$tgl','$harga','$kodejadi','$tlpn','$id_konsumen','$jenis_tukar','0')";
                                $result = mysqli_query($koneksi, $sql);
                                //mendapatkan id transaksi yang baru saja dilakukan [rumus]
                                $id_tukar = $koneksi->insert_id;
    
                                $sisa = $konsumen['poin']-$_POST['poin'];
                                $up = "UPDATE `konsumen` SET `poin`='$sisa' WHERE `id_ksmn`='$id_konsumen'";
                                $update = mysqli_query($koneksi, $up);
                            }else{
                                echo "<script>alert('Poin Anda Tidak Cukup');</script>";
                                echo "<script>location='formtukar.php?pilihan=2';</script>";
                            }
                        }
                        //tampilan dialihkan ke nota
                        if(isset($_GET['id'])){
                            $alamat = $_GET['alamat'];
                            $cara = $poin['cara_setor'];
                            $id_setor= $_GET['id'];
                            echo "<script>location='notpickup.php?id=$id_setor&&tukar=$id_tukar&&b=$cara&&alamat=$alamat';</script>";
                        }else{
                            echo "<script>location='notpembelian.php?tukar=$id_tukar&&pilihan=$pilihan';</script>";
                        }
                    }
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
</div>
<!-- Vendor js -->
<script src="assets/js/vendor.min.js"></script>


<script src="assets/js/app.min.js"></script>

<!-- page script -->
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
            $("#bayarr").change(function(e){
                var valueSelected = this.value;
                if(valueSelected == '1'){
                    $('#nomor').text("Nomor Rek");
                }
                else{
                    $('#nomor').text("Nomor HP");
                }
                var pilih_id = $("#bayarr").val();
                $.ajax({
                    type: "POST",
                    url: "metode.php",
                    data: "bayarr="+pilih_id,
                    success: function(response){
                        //jika data sukses diambil dari server kita tampilkan di metode 2
                        $("#pilih").html(response);
                    }
                })
            })
        });
    </script>
