<?php 
include"header2.php";
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
            <form method="POST" onsubmit="return sendData()">
                <!-- Start of Input -->
                <div class="card-body">
                    <!-- INPUT JENIS SAMPAH -->
                    <b><label>Jenis Sampah (pilih 1)</label></b>
                    <div class="basic-form">
                        <div class="form-group" >
                            <?php
                            $x=1;
                            $get_sampah = "select * from sampah where status_smph = 'Aktif'";
                            $sampah_result = mysqli_query($koneksi,$get_sampah);
                            while($sampah_row = mysqli_fetch_assoc($sampah_result)) :?>
                            <div class="form-check mb-2">
                                <div class="checkbox ">
                                    <input id="<?php echo "checkbox".$x; ?>" type="checkbox" name = "sampah" value="<?php Echo $sampah_row["id_smph"]; ?>" onclick="chkcontrol()">
                                    <label for="<?php echo "checkbox".$x; ?>">
                                    <?php Echo $sampah_row["kategori_smph"]; $x+=1;?><br><?php echo $sampah_row["harga_cash"];?>/gr</label>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <script type="text/javascript">
                        function chkcontrol() {
                            var a = document.getElementsByName("sampah");
                            var total=0;
                            for(var i=0; i < a.length; i++){
                                if(a[i].checked)
                                {total =total +1;}
                                if(total > 1){
                                    alert("Hanya Bisa Pilih Satu")
                                    a[i].checked = false ;
                                    return false;}
                                }}
                                </script>
                                </div>
                                <!-- INPUT ESTIMASI BERAT  -->
                                <div class="form-group">
                                    <b><label>Estimasi Berat (gr) </label></b>
                                    <input type="number" class="form-control" placeholder="100" name="berat" required>
                                    </div>
                                    <!-- TOMBOL SUBMIT SETORAN -->
                                    <div class="hidden-print mt-4">
                                        <div class="text-right d-print-none">
                                                <button type="Submit" class="btn  btn-square btn-primary" name="setor">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
            </form> 
                <?php
                if (isset($_POST["setor"])) {
                    $id_konsumen = $_SESSION["konsumen"]["id_ksmn"];
                    $id_sampah = $_POST["sampah"];
                    $berat = $_POST["berat"];

                    $ambil = "SELECT * FROM sampah WHERE id_smph ='$id_sampah'";
                    $resultt = mysqli_query($koneksi, $ambil);
                    $row = mysqli_fetch_assoc($resultt);
                    $harga = $row['harga_cash']*$berat;

                    //menyimpan data ke tabel setoran 

                    $sqld = "INSERT INTO `sampah_setor`( `berat`, `id_smph`, `id_ksmn`, `harga`) VALUES ('$berat','$id_sampah','$id_konsumen','$harga')";
                    $result = mysqli_query($koneksi, $sqld);

                    //mendapatkan id transaksi yang baru saja dilakukan [rumus]
                    $id_sampahsetor = $koneksi->insert_id;

                    //tampilan dialihkan ke nota
                    echo "<script>location='trans_pickup.php?id=$id_sampahsetor';</script>";
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

<!-- App js -->
<script src="assets/js/app.min.js"></script>