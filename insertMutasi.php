<?php 
session_start();
include "koneksi.php";
print_r($_POST);

date_default_timezone_set("Asia/Jakarta");
$today = date("Y-m-d");
echo "<br>";

$nominal = $_POST['kredit']+$_POST['debit'];

$get = "select * from mutasi_tabungan where id_ksmn =".$_POST['id_ksmn']."";
$result = mysqli_query($koneksi,$get);
if(mysqli_num_rows($result)>0){
 $saldo = mysqli_fetch_assoc($result);
 $sisaSaldo = $saldo['saldo']+$nominal;
 }else {$saldo = 0;
 $sisaSaldo = $saldo + $nominal;}


$insertMutasi = "INSERT INTO `mutasi_tabungan` (`id_mutasi`, `tgl_mutasi`, `debit`, `kredit`, `saldo`, `desk_mutasi`, `id_ptgs`, `id_ksmn`) 
VALUES (NULL, '".$today."', ".$_POST['debit'].", ".$_POST['kredit'].", ".$sisaSaldo.", '".$_POST['desk_mutasi']."', ".$_SESSION['id_ptgs'].", ".$_POST['id_ksmn'].")";
echo $insertMutasi;

if ($koneksi->query($insertMutasi) === TRUE) {
 // header("location:daftarMutasi.php?id_ksmn=".$_POST['id_ksmn']."");
 $getpoin = "select poin from konsumen where id_ksmn =".$_POST['id_ksmn']."";
 $resultpoin = mysqli_query($koneksi,$getpoin);
 $rowpoin = mysqli_fetch_assoc($resultpoin);
 $poinbaru = $rowpoin['poin']+$nominal;
 $updatePoin = "UPDATE `konsumen` SET `poin` = ".$poinbaru." WHERE `konsumen`.`id_ksmn` = ".$_POST['id_ksmn']."";
 echo $updatePoin;
  if ($koneksi->query($updatePoin) === TRUE) {
   header("location:listMutasi.php?id_ksmn=".$_POST['id_ksmn']."");
 } else {
     echo "Error: " . $updatePoin . "<br>" . $koneksi->error;
 }
} else {
 echo "Error: " . $insertMutasi . "<br>" . $koneksi->error;
}
?>