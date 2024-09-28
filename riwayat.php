<?php
include "header.php";
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Adminox</a></li>
                                            <?php if($_GET['pilihan'] == '1') : ?>
                                                <li class="breadcrumb-item active">Riwayat Setor Sampah</li>
                                            <?php elseif($_GET['pilihan'] == '2') : ?>
                                                <li class="breadcrumb-item active">Riwayat Penukaran Poin</li>
                                            <?php else : ?>
                                                <li class="breadcrumb-item active">Riwayat Mutasi Poin</li>
                                            <?php endif; ?>
                                        </ol>
                                    </div>
                                    <?php if($_GET['pilihan'] == '1') : ?>
                                        <h4 class="page-title">Riwayat Setor Sampah</h4>
                                    <?php elseif($_GET['pilihan'] == '2') : ?>
                                        <h4 class="page-title">Riwayat Penukaran Poin</h4>
                                    <?php else : ?>
                                        <h4 class="page-title">Riwayat Mutasi Poin</h4>
                                    <?php endif; ?>
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
                                        <?php if($_GET['pilihan'] == '1') : ?>
                                            <h3 class="m-0 d-print-none">Riwayat Setor Sampah</h3>
                                        <?php elseif($_GET['pilihan'] == '2') : ?>
                                            <h3 class="m-0 d-print-none">Riwayat Penukaran Poin</h3>
                                        <?php elseif($_GET['pilihan'] == '3') : ?>
                                            <h3 class="m-0 d-print-none">Riwayat Pembelian Barang</h3>
                                        <?php else : ?>
                                            <h3 class="m-0 d-print-none">Riwayat Mutasi Poin</h3>
                                        <?php endif; ?>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <?php if($_GET['pilihan'] == '1') : ?>
                                                    <!-- start page title -->
                                                    <div class="row">
                                                        <!-- end col -->
                                                        <?php
                                                        $count = 1;
                                                        $arrCount = [];
                                                        $getTgl = "SELECT tgl_setor from detail_setor join sampah_setor on sampah_setor.id_sampahsetor = detail_setor.id_sampahsetor
                                                        join setor on setor.id_setor = detail_setor.id_setor WHERE setor.id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "' GROUP BY tgl_setor desc";
                                                        $resultTgl = mysqli_query($koneksi,$getTgl);
                                                        while ($Tgl = mysqli_fetch_assoc($resultTgl)){  $date = date("d M Y",strtotime($Tgl['tgl_setor']));?>
                                                        <h4 class="tgl m-0 text-uppercase text-success text-truncate font-weight-bold">&emsp;&emsp;&emsp;<?php echo $date;?></h4>
                                                        <?php  $getSetor = "SELECT * from detail_setor join sampah_setor on sampah_setor.id_sampahsetor = detail_setor.id_sampahsetor
                                                            join setor on setor.id_setor = detail_setor.id_setor where tgl_setor = '".$Tgl['tgl_setor']."' and setor.id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                                            
                                                            $resultSetor = mysqli_query($koneksi,$getSetor);
                                                        
                                                            while ($Setoran = mysqli_fetch_assoc($resultSetor)){$status = $Setoran ['status'];
                                                                ?>
                                                            <div class="col-md-12">
                                                                <div class="card-box widget-box-two widget-two-custom">
                                                                    <div class="media">
                                                                        <div class="wigdet-two-content media-body">
                                                                            <span class="pull-center" align="left">
                                                                            <?php $getSampah = "SELECT kategori_smph FROM sampah where id_smph = ".$Setoran['id_smph']."";
                                                                                $resultSampah = mysqli_query($koneksi,$getSampah);
                                                                                $Sampah = mysqli_fetch_assoc($resultSampah);
                                                                                ?>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jenis Sampah&emsp;&ensp;: <?php echo $Sampah['kategori_smph'];?></p>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jenis Setoran&ensp;&nbsp;: <?php echo $Setoran['jenis_setor'];?></p>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jadwal&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;: <?php echo $Setoran['tgl_jemput'];?></p>
                                                                            <p class="m-0  font-weight-medium text-truncate" >Status&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&nbsp;: <span id="<?php echo "labelStatus".$count;?>" ><?php echo $Setoran ['status'];?></span></p>
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
                                                <?php elseif($_GET['pilihan'] == '3') : ?>
                                                    <!-- start page title -->
                                                    <div class="row">
                                                        <!-- end col -->
                                                        <?php
                                                        $count = 1;
                                                        $arrCount = [];
                                                        $getTgl = "SELECT tgl_pemb from detail_pemb join barang on barang.id_brg = detail_pemb.id_brg
                                                        join pembelian on pembelian.id_pemb = detail_pemb.id_pemb WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "' GROUP BY tgl_pemb desc";
                                                        $resultTgl = mysqli_query($koneksi,$getTgl);
                                                        while ($Tgl = mysqli_fetch_assoc($resultTgl)){  $date = date("d M Y",strtotime($Tgl['tgl_pemb']));?>
                                                        <h4 class="tgl m-0 text-uppercase text-success text-truncate font-weight-bold">&emsp;&emsp;&emsp;<?php echo $date;?></h4>
                                                        <?php  $getSetor = "SELECT * from detail_pemb join barang on barang.id_brg = detail_pemb.id_brg
                                                            join pembelian on pembelian.id_pemb = detail_pemb.id_pemb where tgl_pemb = '".$Tgl['tgl_pemb']."' and id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'";
                                                            
                                                            $resultSetor = mysqli_query($koneksi,$getSetor);
                                                        
                                                            while ($Setoran = mysqli_fetch_assoc($resultSetor)){$status = $Setoran ['status_pemb'];
                                                                ?>
                                                            <div class="col-md-12">
                                                                <div class="card-box widget-box-two widget-two-custom">
                                                                    <div class="media">
                                                                        <div class="wigdet-two-content media-body">
                                                                            <span class="pull-center" align="left">
                                                                            <?php $getSampah = "SELECT nama_brg FROM barang where id_brg = ".$Setoran['id_brg']."";
                                                                                $resultSampah = mysqli_query($koneksi,$getSampah);
                                                                                $Sampah = mysqli_fetch_assoc($resultSampah);
                                                                                ?>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Nama Barang&ensp;: <?php echo $Sampah['nama_brg'];?></p>
                                                                            <?php $getToken = "SELECT token_pemb from pembelian where id_pemb = ".$Setoran['id_pemb']."";
                                                                                $resultToken = mysqli_query($koneksi,$getToken);
                                                                                $Token = mysqli_fetch_assoc($resultToken);
                                                                                ?>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Token&ensp;: <?php echo $Token['token_pemb'];?></p>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jumlah&emsp;&emsp;&emsp;&emsp;: <?php echo $Setoran['jumlah'];?></p>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Harga&emsp;&emsp;&emsp;&emsp;&ensp;: <?php echo $Setoran['subtotal'];?></p>
                                                                            <p class="m-0  font-weight-medium text-truncate" >Status&emsp;&emsp;&emsp;&emsp;&emsp;: <span id="<?php echo "labelStatus".$count;?>" ><?php echo $Setoran ['status_pemb'];?></span></p>
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
                                                <?php elseif($_GET['pilihan'] == '2') : ?>
                                                    <!-- start page title -->
                                                    <div class="row">
                                                        <!-- end col -->
                                                        <?php
                                                        $count = 1;
                                                        $arrCount = [];
                                                        $getTgl = "SELECT tgl_tukar from penukaran WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "'  GROUP BY tgl_tukar desc";
                                                        $resultTgl = mysqli_query($koneksi,$getTgl);
                                                        while ($Tgl = mysqli_fetch_assoc($resultTgl)){  $date = date("d M Y",strtotime($Tgl['tgl_tukar']));?>
                                                        <h4 class="tgl m-0 text-uppercase text-success text-truncate font-weight-bold">&emsp;&emsp;&emsp;<?php echo $date;?></h4>
                                                        <?php  $getSetor = "SELECT * from penukaran JOIN wallet USING (id_wallet) WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "' AND tgl_tukar = '".$Tgl['tgl_tukar']."'";
                                                            
                                                            $resultSetor = mysqli_query($koneksi,$getSetor);
                                                        
                                                            while ($Setoran = mysqli_fetch_assoc($resultSetor)){$status = $Setoran ['status'];
                                                                ?>
                                                            <div class="col-md-12">
                                                                <div class="card-box widget-box-two widget-two-custom">
                                                                    <div class="media">
                                                                        <div class="wigdet-two-content media-body">
                                                                            <span class="pull-center" align="left">
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Jenis Tukar&emsp;: <?php echo $Setoran['wallet'];?></p>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >No&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;: <?php echo $Setoran['telpon'];?></p>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Nominal&emsp;&emsp;&emsp;: <?php echo $Setoran['nominal'];?></p>
                                                                            <p class="m-0 text-uppercase font-weight-medium text-truncate" >Token Tukar&ensp;: <?php echo $Setoran['token_tukar'];?></p>
                                                                            <p class="m-0  font-weight-medium text-truncate" >Status&emsp;&emsp;&emsp;&ensp;&emsp;: <span id="<?php echo "labelStatus".$count;?>" ><?php echo $Setoran ['status'];?></span></p>
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
                                                <?php else : ?>
                                                    <div class="row">
                                                        <!-- end col -->
                                                        <?php
                                                        $count = 1;
                                                        $arrCount = [];

                                                        //ambil tanggal Jemput
                                                        $getTgl = "SELECT tgl_mutasi from mutasi_tabungan WHERE id_ksmn ='" . $_SESSION["konsumen"]["id_ksmn"] . "' GROUP BY tgl_mutasi desc";
                                                        $resultTgl = mysqli_query($koneksi,$getTgl);
                                                        while ($Tgl = mysqli_fetch_assoc($resultTgl)){  $date = date("d M Y",strtotime($Tgl['tgl_mutasi']));?>

                                                        <!-- Echo Tanggal Jemput  -->
                                                        <p class="tgl m-0 text-uppercase text-success text-truncate font-weight-bold">&emsp;&emsp;&emsp;<?php echo $date;?></p>
                                                                
                                                            <?php // Ambil Data Penjemputan 

                                                            $selectListMutasi = "SELECT * from mutasi_tabungan  where tgl_mutasi= '".$Tgl['tgl_mutasi']."' 
                                                            AND id_ksmn = ". $_SESSION["konsumen"]["id_ksmn"]."";
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
                                                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics"><?php echo $listMutasi['desk_mutasi'];?></p>
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
                                                        <!-- start page title -->
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->
                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->
              
               <!--Modal POP UP -->
                    <div id="detail" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span id="closeBtn" class="closeBtn">&times;</span>
                            </div>
                            <div class="modal-body">
                                <div class="form-element">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table mt-4 table-centered">
                                                    <thead>
                                                    <tr><th>Nama Sampah</th>
                                                        <th>Berat</th>
                                                        <th>Poin</th>
                                                    </tr></thead>
                                                    <tbody>
                                                        <?php
                                                        $ambil = "SELECT * FROM sampah_setor join sampah using (id_smph)"; 
                                                        $resultt = mysqli_query($koneksi, $ambil);?>
                                                        <?php while ($row = mysqli_fetch_assoc($resultt)) { ?>
                                                        <tr>
                                                            <td><?= $row['kategori_smph']; ?></td>
                                                            <td><?= $row['estimasi_berat']; ?></td>
                                                            <td><?= $row['estimasi_poin']; ?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
        
        <!---POP UP MODAL-->
        <script>//ambil elemen setiap elemen
            var modal = document.getElementById('detail');
            var modalBtn = document.getElementById('modalBtn');
            var closeBtn = document.getElementById('closeBtn');

            modalBtn.addEventListener('click', openModal);
            closeBtn.addEventListener('click', closeModal);
            window.addEventListener('click', clickOutside);
            
            
            function openModal() {
                modal.style.display = 'block';
            }
            function closeModal () {
                modal.style.display = 'none';
            }
            function clickOutside(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            }</script>

            

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

<style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
                padding: 1px;
            }

            .button {
                background: #34d3eb;
                padding: 1em 2em;
                color: #fff;
                border: 0;
            }

            .button:hover {
                background:#333;
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                height: 100%;
                width: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.5);
                transition: all 0.5s ease-in-out;
            }

            .modal-content {
                background-color: #f4f4f4;
                margin:auto;
                margin-top:80px;
                width: 70%;
                box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0,0,0,0.17);
                animation: modalopen 0.5s ease-in-out;
            }

            .modal-header {
                background: #34d3eb;
                padding: 15px;
                color: #fff;
            }

            .modal-body {
                padding: 10px 10px;

            }

            .modal-footer {
                background: #34d3eb;
                padding: 10px;
                color: #fff;
                text-align: center;
            }

            .closeBtn {
                color: #fff;
                float: left;
                font-size: 30px;
            }

            .closeBtn:hover, .closeBtn:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
                transition: all 0.3s ease-in-out;
            }

            @keyframes modalopen {
                from {
                    opacity: 0
                }
                to {
                    opacity: 1
                }
            }
            </style>