<?php 
include "headerAdmin2.php";

include "koneksi.php";
$get_temp = "select id_ptgs from petugas limit 1";
$temp_result = mysqli_query($koneksi,$get_temp);
while($temp_row = mysqli_fetch_assoc($temp_result)) :
    $_SESSION['id_ptgs'] = $temp_row['id_ptgs'];
endwhile;

// -----------------------------

 ?>
        <!-- Begin page -->
        <link rel="stylesheet" href="style.css" type="text/css">
        <div id="wrapper">

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <!-- <div class="content-page"> -->
                <div class="content">
                    <!-- <style>
                        p.tgl.m-0.text-uppercase.text-success.text-truncate {
                            padding-left: 12px;
                        }

                    </style> -->
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- Margin Top-->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">dashboard</h4>
                                </div>
                            </div>
                        </div>   
                        
                        <!-- start page title -->
                        <div class="row">
                            <!-- end col -->
                            <?php
                            $count = 1;
                            $arrCount = [];

                            //ambil tanggal Jemput
                            $getTgl = "SELECT tgl_tukar from penukaran  GROUP BY tgl_tukar desc";
                            $resultTgl = mysqli_query($koneksi,$getTgl);
                            while ($Tgl = mysqli_fetch_assoc($resultTgl)){  $date = date("d M Y",strtotime($Tgl['tgl_tukar']));?>

                            <!-- Echo Tanggal Jemput  -->
                            <p class="tgl m-0 text-uppercase text-success text-truncate font-weight-bold"><?php echo $date;?></p>
                                    
                                <?php // Ambil Data Penjemputan 
                                $getTukar = "SELECT * from penukaran join wallet using(id_wallet) join metode on metode.id_pilih = wallet.id_pilih where tgl_tukar='".$Tgl['tgl_tukar']."'";
                                
                                $resultTukar = mysqli_query($koneksi,$getTukar);
                               
                                while ($Penukaran = mysqli_fetch_assoc($resultTukar)){
                                    ?>
                                <div class="col-md-12">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                            <div class="wigdet-two-content media-body">
                                                <span class="pull-center" align="left">
                                                <?php $getNama = "SELECT nama From konsumen where id_ksmn = ".$Penukaran['id_ksmn']."";   
                                                      $resultNama =  mysqli_query($koneksi,$getNama);
                                                      $nama = mysqli_fetch_assoc($resultNama)?>
                                                <p class="m-0 text-uppercase text-success font-weight-bold text-truncate"><?php echo $nama['nama'];?></p>

                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Metode Pembayaran : <?php echo $Penukaran['wallet']." ".$Penukaran['nama']." ke ".$Penukaran['telpon'];?></p>
                                                
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Nominal : <?php echo $Penukaran['nominal'];?> </p>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Token : <?php echo $Penukaran['token_tukar'];?> </p>

                                                <p class="m-0  font-weight-medium text-truncate" >Status : <span id="<?php echo "labelStatus".$count;?>" ><?php echo $Penukaran['status'];?></span></p>
                                               
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php array_push($arrCount,$count);$count++;};?>
                            <?php };?>
                           
                            <script type="text/javascript">
                                                    
                                //get
                                
                                let arrList =  <?php echo json_encode($arrCount); ?>;
                                let number = arrList.length+1;
                                var id ;
                                for (let i = 1; i < number; i++) {
                                    id = "labelStatus".concat(i);
                                    var status = document.getElementById(id).innerHTML;
                                    console.log(status);

                                    if (status === 'Pending' || status === 'Dalam Proses'){
                                        document.getElementById(id).style.color = "#32CD32";
                                    }else if(status === 'Sukses'){
                                        document.getElementById(id).style.color = "blue";
                                    }else{
                                        document.getElementById(id).style.color = "red";
                                    }
                                }                
                            </script>
                        </div> <!-- end container-fluid -->

                </div> <!-- end content -->

                

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- 2017 - 2019 &copy; Adminox theme by <a href="">Coderthemes</a> -->
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
           