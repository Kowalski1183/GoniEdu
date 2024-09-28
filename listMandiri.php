<?php 


// -----------------------------
include "headerAdmin.php";
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
                            $getTgl = "SELECT tgl_setor from detail_setor join sampah_setor on sampah_setor.id_sampahsetor = detail_setor.id_sampahsetor
                            join setor on setor.id_setor = detail_setor.id_setor where status = 'Pending' OR  status = 'Dalam Proses' GROUP BY tgl_setor desc";
                            $resultTgl = mysqli_query($koneksi,$getTgl);
                            while ($Tgl = mysqli_fetch_assoc($resultTgl)){  $date = date("d M Y",strtotime($Tgl['tgl_setor']));?>

                            <!-- Echo Tanggal Jemput  -->
                            <p class="tgl m-0 text-uppercase text-success text-truncate font-weight-bold"><?php echo $date;?></p>
                                    
                                <?php // Ambil Data Penjemputan 
                                $getSetor = "SELECT * from detail_setor join sampah_setor on sampah_setor.id_sampahsetor = detail_setor.id_sampahsetor
                                join setor on setor.id_setor = detail_setor.id_setor where  tgl_setor = '".$Tgl['tgl_setor']."' AND status = 'Pending'  OR  tgl_setor = '".$Tgl['tgl_setor']."'  AND status = 'Dalam Proses'";
                                
                                $resultSetor = mysqli_query($koneksi,$getSetor);
                               
                                while ($Setoran = mysqli_fetch_assoc($resultSetor)){$status = $Setoran ['status'];
                                    ?>
                                <div class="col-md-12">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                            <div class="wigdet-two-content media-body">
                                                <span class="pull-center" align="left">
                                                <?php $getNama = "SELECT nama From konsumen where id_ksmn = ".$Setoran['id_ksmn']."";
                                                      $resultNama =  mysqli_query($koneksi,$getNama);
                                                      $nama = mysqli_fetch_assoc($resultNama)?>
                                                <p class="m-0 text-uppercase text-success font-weight-bold text-truncate"><?php echo $nama['nama']?></p>
                                                <?php $getSampah = "SELECT kategori_smph FROM sampah where id_smph = ".$Setoran['id_smph']."";
                                                      $resultSampah = mysqli_query($koneksi,$getSampah);
                                                      $Sampah = mysqli_fetch_assoc($resultSampah);
                                                      ?>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jenis Sampah  : <?php echo $Sampah['kategori_smph'];?></p>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jenis Setoran : <?php echo $Setoran['jenis_setor'];?></p>
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jadwal        : <?php echo $Setoran['tgl_jemput'];?></p>
                                                <p class="m-0  font-weight-medium text-truncate" >Status        : <span id="<?php echo "labelStatus".$count;?>" ><?php echo $Setoran ['status'];?></span></p>
                                                <a class="btn btn-primary" href="formApproveJemput.php?status=Pending&&id_detail_pickup=<?php echo $Setoran['id_detail_pickup'];?>" role="button">Approve</a>
                                                <a class="btn btn-primary" href="rejectJemput.php?status=Reject&&id_detail_pickup=<?php echo $Setoran['id_detail_pickup'];?>" role="button">Reject</a>
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
           