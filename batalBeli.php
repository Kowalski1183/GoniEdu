<?php
session_start();
include 'koneksi.php';

$getNominal = "Select total as nominal,id_ksmn from pembelian where id_pemb = ".$_GET['id_beli']."";
$resultNominal = mysqli_query($koneksi,$getNominal);
$rowNominal = mysqli_fetch_assoc($resultNominal);
$transaksi = $rowNominal['nominal'];
// ambil sisa saldo
$getpoin = "select poin from konsumen where id_ksmn =".$rowNominal['id_ksmn']."";
$resultpoin = mysqli_query($koneksi,$getpoin);
$rowpoin = mysqli_fetch_assoc($resultpoin);
$poinbaru = $rowpoin['poin']+$transaksi;
$updatePoin = "UPDATE `konsumen` SET `poin` = ".$poinbaru." WHERE `konsumen`.`id_ksmn` = ".$rowNominal['id_ksmn']."";


if ($koneksi->query($updatePoin) === TRUE) {
 $updateBeli = "UPDATE `pembelian` SET `status_pemb` = 'Dibatalkan' WHERE `pembelian`.`id_pemb` = ".$_GET['id_beli']."";

 if ($koneksi->query($updateBeli) === TRUE) {
  header("location:riwayatBeli.php");
 } else {
  echo "Error: " . $updateBeli . "<br>" . $koneksi->error;
 }
} else {
 echo "Error: " . $insertMutasi . "<br>" . $koneksi->error;
}

?>
