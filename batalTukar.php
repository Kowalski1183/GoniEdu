<?php
session_start();
include 'koneksi.php';

$getNominal = "Select nominal,id_ksmn from penukaran where id_tukar = ".$_GET['id_tukar']."";
$resultNominal = mysqli_query($koneksi,$getNominal);
$rowNominal = mysqli_fetch_assoc($resultNominal);

$transaksi = $rowNominal['nominal'];
// ambil sisa saldo
$getpoin = "select poin from konsumen where id_ksmn =".$rowNominal['id_ksmn']."";
$resultpoin = mysqli_query($koneksi,$getpoin);
$rowpoin = mysqli_fetch_assoc($resultpoin);
$poinbaru = $rowpoin['poin']+$transaksi;
$updatePoin = "UPDATE `konsumen` SET `poin` = ".$poinbaru." WHERE `konsumen`.`id_ksmn` = ".$rowNominal['id_ksmn']."";
//saldo baru

if ($koneksi->query($updatePoin) === TRUE) {
 $updateTukar = "UPDATE `penukaran` SET `status` = 'Dibatalkan' WHERE `penukaran`.`id_tukar` = ".$_GET['id_tukar']."";
 if ($koneksi->query($updateTukar) === TRUE) {
  header("location:riwayatTukar.php");
 } else {
  echo "Error: " . $updateTukar . "<br>" . $koneksi->error;
 }
} else {
 echo "Error: " . $updatePoin . "<br>" . $koneksi->error;
}

?>
