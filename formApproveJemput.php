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
// unset($_SESSION['id_ksmn']);



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
                        <form action="insertTabungDiterima.php" method="POST">
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
                  

                                <!-- Menyimpan jenis transaksi -->
                                <?php                                             
                                //get selected option
                                $getSmph = "SELECT id_smph from sampah_setor join detail_setor using(id_sampahsetor) 
                                where id_detail_pickup = ".$_GET['id_detail_pickup']."" ;
                                $resultSmph = mysqli_query($koneksi,$getSmph);
                                $rowSmph = mysqli_fetch_assoc($resultSmph);
                                $idSmph = $rowSmph['id_smph'];

                                //?>
                                <div class="basic-form">
                                        <div class="form-group" >
                                            
                                            <?php 
                                            $x=1;
                                            $get_sampah = "select * from sampah where status_smph = 'Aktif'";
                                            $sampah_result = mysqli_query($koneksi,$get_sampah);
                                            while($sampah_row = mysqli_fetch_assoc($sampah_result)) :        
                                            ?>
                                                
                                                <div class="form-check mb-2">
                                                    <div class="checkbox ">
                                                        <input id="<?php echo "checkbox".$x; ?>" type="checkbox" name = "sampah" 
                                                         value="<?php Echo $sampah_row["id_smph"]; ?>"  onclick="chkcontrol()" 
                                                         <?php echo ($idSmph==$sampah_row["id_smph"]? 'checked' : '');?>/>
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
                                        } 
                                        </script>
                                </div>

                                <!-- MENGINPUT BERAT YG DITERIMA -->
                                <?php
                                $getBerat = "SELECT berat from detail_setor join sampah_setor using(id_sampahsetor) where id_detail_pickup=".$_GET['id_detail_pickup'].""; 
                                $resultBerat = mysqli_query($koneksi,$getBerat);
                                $Berat = mysqli_fetch_assoc($resultBerat);
                                ?>
                                <div class="form-group">
                                <b><label>Berat diterima (kg) </label></b>
                                    <input type="number" class="form-control" placeholder="<?php echo $Berat['berat'];?>" name="berat" value="<?php echo $Berat['berat'];?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" placeholder="<?php echo $_GET['id_detail_pickup'];?>" name="id_detail_pickup" value="<?php echo $_GET['id_detail_pickup'];?>">
                                </div>             
                                <!-- MENGINPUT TGL DITERIMA -->
                                <div class="form-group">
                                    <!-- <b><label>Tanggal Diterima</label></b> -->
                                    <?php
                                    date_default_timezone_set("Asia/Jakarta");
                                    $today = date("Y-m-d");
                                    ?>
                                    <input type="hidden" id="tglForm" class="form-control"  name="tglapprove_setor" value="<?php echo $today;?>">
                                </div>

                                <!-- TOMBOL SUBMIT SETORAN -->
                                <div class="card-body">
                                    <button type="Submit" class="btn  btn-square btn-primary">Submit</button>
                                    
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