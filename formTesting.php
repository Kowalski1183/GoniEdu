<?php 

// -----------------------------
include "headerAdmin.php";
include "koneksi.php";

// Test 1 (case konsumen)
// unset($_SESSION['id_ptgs']);
// $get_temp = "select id_ksmn from konsumen limit 1";
// $temp_result = mysqli_query($koneksi,$get_temp);
// while($temp_row = mysqli_fetch_assoc($temp_result)) :
//     $_SESSION['id_ksmn'] = $temp_row['id_ksmn'];
// endwhile;

// Test 2 (case admin)
unset($_SESSION['id_ksmn']);



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
                        <form action="insertsetor.php" method="POST">
                            <!-- HEADER  -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="card"></div> 
                            <div class="card-header"></div>
                            <!-- Start of Input -->
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <!-- INPUT NOMOR HP KONSUMEN -->
                                <?php if (isset($_SESSION['id_ptgs'])) :?>
                                <div class="form-group">
                                    <b><label>Nomor HP Konsumen</label></b>
                                    <input type="text" class="form-control" name="no_telp" placeholder="081234567890" >
                                </div>
                                <?php endif; ?>
                                <!-- INPUT JENIS SAMPAH -->
                            
                                <b><label>Jenis Sampah (pilih 1)</label></b>
                                
                                <div class="basic-form">
                                        <div class="form-group" >
                                            
                                            <?php  
                                            $x=1;
                                            $get_sampah = "select * from sampah ";
                                            $sampah_result = mysqli_query($koneksi,$get_sampah);
                                            while($sampah_row = mysqli_fetch_assoc($sampah_result)) :        
                                            ?>
                                                
                                                <div class="form-check mb-2">
                                                    <div class="checkbox ">
                                                        <input id="<?php echo "checkbox".$x; ?>" type="checkbox" name = "sampah" 
                                                         value="<?php Echo $sampah_row["id_smph"]; ?>" onclick="chkcontrol()">
                                                        <label for="<?php echo "checkbox".$x; ?>">
                                                            
                                                            <?php Echo $sampah_row["kategori_smph"]; $x+=1;?>
                                                            
                                                        </label>
                                                    </div> 
                                                </div>
                                       
                                            <?php endwhile; ?>
                                        </div>

                                        <script type="text/javascript">
                                        function chkcontrol() {
                                        var a = document.getElementsByName("sampah");
                                        console.log(a);
                                        var total=0;
                                            for(var i=0; i < a.length; i++){
                                                if(a[i].checked)
                                                {
                                                total =total +1;
                                                }

                                                if(total > 1){
                                                alert("Please Select only three") 
                                                a[i].checked = false ;
                                                return false;
                                                }
                                            }
                                        } </script>
                                </div>
                                <!-- INPUT JENIS SETORAN -->
                                <div class="form-group">
                                    <b><label>Jenis Setoran </label></b>
                                    <select class="form-control default-select" name="jenissetor">
                                        <option selected><?php if(isset($_GET['jenis'])){echo $_GET["jenis"];}else{echo "Choose....";}?></option>
                                        <?php if($_GET["jenis"] != 'Tabung') : ?>
                                            <option value="Tabung">Tabung</option>
                                        <?php endif; ?>
                                        <?php if($_GET["jenis"] != 'Tukar') : ?>
                                            <option value="Tukar">Tukar</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <!-- INPUT CARA SETORAN -->
                                <div class="form-group">
                                    <b><label>Cara Setoran </label></b>
                                    <select class="form-control default-select" name="carasetor">
                                        <option selected>Choose...</option>
                                        <option value="Jemput">Jemput</option>
                                        <option value="Antar Mandiri">Antar Mandiri</option>
                                    </select>
                                </div>
                                <!-- INPUT ESTIMASI BERAT  -->
                                <div class="form-group">
                                    <b><label>Estimasi Berat (gr) </label></b>
                                    <input type="number" class="form-control" placeholder="100" name="estimasi_berat">
                                </div>
                                <!-- INPUT TANGGAL REQ SETORAN -->
                                <div class="form-group">
                                    <b><label>Tanggal</label></b>
                                    <input type="date" class="form-control" placeholder="2017-06-04" name="tgl_req">
                                </div>
                                <!-- INPUT ALAMAT SETORAN -->
                                <?php if (isset($_SESSION['id_ksmn'])) :?>
                                <div class="form-group">
                                    <b><label>Alamat</label></b>
                                    <select class="form-control default-select" name="alamat_jmpt">
                                    <?php   $y=1;
                                        $get_alamat = "select * from alamat_konsumen where id_ksmn = '".$_SESSION['id_ksmn']."'";
                                        $alamat_result = mysqli_query($koneksi,$get_alamat);
                                        while($alamat_row = mysqli_fetch_assoc($alamat_result)) :        
                                        ?>
                                        <option value="<?php echo $alamat_row['jalan'].",RT/RW ".$alamat_row['RT']."/".$alamat_row['RW']." ,".$alamat_row['kecamatan'];?>">
                                        <?php echo $alamat_row['jalan'].",RT/RW ".$alamat_row['RT']."/".$alamat_row['RW']." ,".$alamat_row['kecamatan'];?></option>
                                        <?php endwhile;?>
                                    </select>
                                        
                                </div>
                                <?php endif;?>
                                <?php if (isset($_SESSION['id_ptgs'])) :?>
                                <div class="form-group">
                                    <b><label>Berat diterima (gr) </label></b>
                                    <input type="number" class="form-control" placeholder="100" name="berat_approved">
                                </div>
                                <div class="form-group">
                                    <b><label>Tanggal Diterima</label></b>
                                    <input type="date" class="form-control" placeholder="2017-06-04" name="tglapprove_setor">
                                </div>
                                <?php endif;?>
                                <!-- TOMBOL SUBMIT SETORAN -->
                                <div class="card-body">
                                    <button type="Submit" class="btn  btn-square btn-primary">Submit</button>
                                    <a class="btn btn-primary" href="riwayatsetor.php" role="button">Riwayat </a>
                                </div>
                                
                                </form>
                                
                            </div>
                        </div>
                        </form> 
                        

                    <!-- end container-fluid -->
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