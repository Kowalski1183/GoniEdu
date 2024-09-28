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
                        <form action="insertSmph.php" method="POST" enctype="multipart/form-data">
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

                                <!-- INPUT JENIS SAMPAH -->
                            

                                <!-- INPUT NOMOR HP KONSUMEN -->
                                <div class="form-group"  >
                                    <b><label>Jenis Sampah</label></b>
                                    <input type="text" class="form-control" name="kategori_smph" placeholder="plastik" >
                                </div>
                                <!-- INPUT NOMOR HP KONSUMEN -->
                                <div class="form-group">
                                    <b><label>Harga Perkg</label></b>
                                    <input type="text" class="form-control" name="harga_cash" placeholder="1000" >
                                </div>
                                <!-- INPUT NOMOR HP KONSUMEN -->
                                <div class="form-group">
                                    <b><label>kode Sampah</label></b>
                                    <input type="text" class="form-control" name="kode_smph" placeholder="PLSK01" >
                                </div>
                                <div class="form-group">
                                    <b><label>Gambar</label></b>
                                    <input type="file" class="form-control" name="file_smph" placeholder="gambar.jpg" >
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