<?php
session_start();
include 'koneksi.php';
echo $_POST['sampah'];
print_r($_POST);

$status = "Sukses";

//ambil id konsumen,setor,samopahsetor
$getIdksmn = "SELECT id_ksmn,id_setor,id_sampahsetor FROM detail_setor join setor using(id_setor) where id_detail_pickup=".$_POST['id_detail_pickup']."";
$resultIdksmn = mysqli_query($koneksi,$getIdksmn);
$rowIds = mysqli_fetch_assoc($resultIdksmn);
$idKsmn = $rowIds['id_ksmn'];
$idSetor = $rowIds['id_setor'];
$idSmphSetor = $rowIds['id_sampahsetor'];
//echo $idSetor."<br>";
//echo $idSmphSetor."<br>";

//ambil berat estimasi dan harga estimasi 
$getEst = "SELECT berat,harga from sampah_setor where id_sampahsetor =".$idSmphSetor."";
$resultEst = mysqli_query($koneksi,$getEst);
$rowEst = mysqli_fetch_assoc($resultEst);
$beratEst = $rowEst['berat'];
$hargaESt = $rowEst['harga'];
echo "<br>";
echo $hargaESt;
echo "<br>";
echo $beratEst;

//ambil data sampah yang berdasarkan id sampah approved
$getSmph = "SELECT * FROM sampah where id_smph = ".$_POST['sampah']."";
$resultSmph = mysqli_query($koneksi,$getSmph);
$rowSmph = mysqli_fetch_assoc($resultSmph);
$katSmph = $rowSmph['kategori_smph'];
$hargaRaw = $rowSmph['harga_cash'];
echo "<br>";
echo $katSmph; 
echo "<br>"; 
echo $hargaRaw;
//set harga baru dan selisih harga berdasarkan berat approved dan sampah approved
$hargaAsli = $_POST['berat']*$hargaRaw;
$selisihBerat = $_POST['berat']-$beratEst;
$selisihHrg = $hargaAsli-$hargaESt;
echo "<br>";
echo $selisihHrg;
echo "<br>";
echo $selisihBerat;

//ambil total harga dan berat estimasi dan jenis setor beradasarkan idsetor 
$getTotalEst = "SELECT total_harga, total_berat, jenis_setor from setor where id_setor =".$idSetor."";
$resultTotalEst = mysqli_query($koneksi,$getTotalEst);
$rowTotalEst= mysqli_fetch_assoc($resultTotalEst);
$jenisSetor = $rowTotalEst['jenis_setor'];
$thEst = $rowTotalEst['total_harga'];
$tbEst = $rowTotalEst['total_berat'];
echo "<br>";
echo $tbEst;
echo "<br>";
echo $thEst;
echo "<br>";
echo $jenisSetor;
//update tb dan th
$tbBaru = $tbEst + $selisihBerat;
$thBaru = $thEst + $selisihHrg;
echo "<br>";
echo $tbBaru;
echo "<br>";
echo $thBaru;

//Update Sampah Setor
$updateSmphSetor = "UPDATE `sampah_setor` SET `berat` = ".$_POST['berat'].", `id_smph` = ".$_POST['sampah'].", 
`harga` = ".$hargaAsli." WHERE `sampah_setor`.`id_sampahsetor` = ".$idSmphSetor."";
$koneksi->query($updateSmphSetor);

//Update setor
$updateSetor = "UPDATE `setor` SET `total_berat` = ".$tbBaru.", `total_harga` = ".$thBaru." WHERE `setor`.`id_setor` = ".$idSetor."";
$koneksi->query($updateSetor);

//Update detail setor
$updateDs = "UPDATE `detail_setor` SET `status` = '".$status."', `tgl_approve` = '".$_POST['tglapprove_setor']."' 
WHERE `detail_setor`.`id_detail_pickup` = ".$_POST['id_detail_pickup']."";
$koneksi->query($updateDs);

if($jenisSetor === 'Tabung'){
 $debit = 0;
 $kredit = $hargaAsli;
  // ambil sisa saldo
  $getSaldo = "SELECT saldo FROM mutasi_tabungan where id_ksmn = ".$idKsmn." ORDER BY id_mutasi DESC limit 1";
  $resultSaldo = mysqli_query($koneksi,$getSaldo);
  if(mysqli_num_rows($resultSaldo)>0){
  $rowSaldo = mysqli_fetch_assoc($resultSaldo);
  $sisaSaldo = $rowSaldo['saldo'];}else {$sisaSaldo = 0;}
  echo "<br>";
  echo $sisaSaldo;

  //saldo baru
  $saldoBaru = $sisaSaldo + $kredit;
  echo "<br>";
  echo $saldoBaru;
  echo "<br>";

  // ambil tgl hari ini
  date_default_timezone_set("Asia/Jakarta");
  $today = date("Y-m-d");
  echo "<br>";

  // buat desk penyetoran sampah
  $desk = "penambahan kredit penyetoran ".$_POST['berat']." kg"." ".$katSmph;
  echo $desk;
  echo "<br>";

  // insert mutasi diterima
  $insertMutasi  = "INSERT INTO `mutasi_tabungan` (`id_mutasi`, `tgl_mutasi`, `debit`, `kredit`, `saldo`, `desk_mutasi`, `id_ptgs`, `id_ksmn`)
  VALUES (NULL, '".$today."', ".$debit." , ".$kredit." , ".$saldoBaru.", '$desk', ".$_SESSION['id_ptgs'].", ".$idKsmn.")";
  if ($koneksi->query($insertMutasi) === TRUE) {
    $getpoin = "select poin from konsumen where id_ksmn =".$idKsmn."";
    $resultpoin = mysqli_query($koneksi,$getpoin);
    $rowpoin = mysqli_fetch_assoc($resultpoin);
    $poinbaru = $rowpoin['poin']+$kredit;
    $updatePoin = "UPDATE `konsumen` SET `poin` = ".$poinbaru." WHERE `konsumen`.`id_ksmn` = ".$idKsmn."";
    if ($koneksi->query($updatePoin) === TRUE) {
       header("location:riwayatSetor.php");
    } else {
        echo "Error: " . $updatePoin . "<br>" . $koneksi->error;
    }
  } else {
      echo "Error: " . $insertMutasi . "<br>" . $koneksi->error;
  }
}else{header("location:riwayatSetor.php");}







?>