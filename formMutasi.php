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
                        <form action="insertMutasi.php" method="POST">
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
                                <div class="form-group">
                                    <b><label>Nasabah </label></b>
                                    <select class="form-control default-select" name="id_ksmn" require="">
                                        <option selected>Pilih Nasabah</option>
                                        <?php
                                        $getTelp = "select id_ksmn,nama,no_telp from konsumen";
                                        $resultTelp = mysqli_query($koneksi,$getTelp);
                                        while($rowTelp = mysqli_fetch_assoc($resultTelp)){
                                        ?>
                                            <option value="<?php echo $rowTelp['id_ksmn'];?>"><?php echo $rowTelp['nama']." - ".$rowTelp['no_telp']?></option>
                                        <?php }?>


                                    </select>

                                <!-- INPUT ESTIMASI BERAT  -->
                                <div class="form-group">
                                    <b><label>Debit </label></b>
                                    <input type="number" class="form-control" placeholder="0" name="debit" 
                                    value = "0">
                                </div>
                                <!-- INPUT ESTIMASI BERAT  -->
                                <div class="form-group">
                                    <b><label>Kredit</label></b>
                                    <input type="number" class="form-control" placeholder="0" name="kredit"
                                    value = "0" >
                                </div>

                                <div class="form-group">
                                    <b><label>Deskripsi</label></b>
                                    <input type="text" class="form-control" name="desk_mutasi" placeholder="deskripsi..."
                                    value = "" >
                                </div>

                                <!-- TOMBOL SUBMIT SETORAN -->
                                <div class="card-body">
                                    <button type="Submit" class="btn  btn-square btn-primary">Submit</button>
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