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
                            $getTgl = "SELECT tgl_mutasi from mutasi_tabungan where id_ksmn = ".$_GET['id_ksmn']." group by tgl_mutasi desc";
                            $resultTgl = mysqli_query($koneksi,$getTgl);
                            while ($Tgl = mysqli_fetch_assoc($resultTgl)){  $date = date("d M Y",strtotime($Tgl['tgl_mutasi']));?>

                            <!-- Echo Tanggal Jemput  -->
                            <p class="tgl m-0 text-uppercase text-success text-truncate font-weight-bold"><?php echo $date;?></p>
                                    
                                <?php // Ambil Data Penjemputan 

                                $selectListMutasi = "SELECT * from mutasi_tabungan  where tgl_mutasi= '".$Tgl['tgl_mutasi']."' 
                                AND id_ksmn = ".$_GET['id_ksmn']."";
                                $resultListMutasi = mysqli_query($koneksi,$selectListMutasi);
                                while ($listMutasi = mysqli_fetch_assoc($resultListMutasi)){                                        
                                    if(isset($listMutasi['kredit'])){
                                        $keterangan = 'Kredit';
                                        $tanda = '+';
                                    }else{
                                        $keterangan = 'Debit';
                                        $tanda = '-';
                                    }
                                    
                                ?>
                                <div class="col-md-12">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                            <div class="wigdet-two-content media-body">
                                                <span class="pull-center" align="Left">
                                                <h4 class=" text-success"><a href=""><?php echo $tanda.$keterangan;?></a></h4>
                                                <span class="pull-center" align="Right">
                                                <h4 class=" text-success"><a href=""><?php echo $tanda.$listMutasi['saldo'];?></a></h4>
                                                <span class="pull-center" align="Left">
                                                <div class="keterangan">
                                                    <?php
                                                    $getKsmn = "SELECT nama from konsumen where id_ksmn=".$listMutasi['id_ksmn']."";
                                                    $resultKsmn = mysqli_query($koneksi,$getKsmn);
                                                    $namaKsmn = mysqli_fetch_assoc($resultKsmn); 
                                                    ?>
                                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics"><?php echo $keterangan?> untuk <?php echo $namaKsmn['nama'];?></p>
                                                    <?php
                                                    $getPtgs = "SELECT nama_ptgs from petugas where id_ptgs=".$listMutasi['id_ptgs']."";
                                                    $resultPtgs = mysqli_query($koneksi,$getPtgs);
                                                    $namaPtgs = mysqli_fetch_assoc($resultPtgs); 
                                                    ?>
                                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics"><?php echo $namaPtgs['nama_ptgs'].'  '; ?><?php echo $listMutasi['id_ptgs']; ?></p>
                                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics"></p>
                                                </div>
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

                                    if (status === 'Pending'){
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
           