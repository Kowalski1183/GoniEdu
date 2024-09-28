<?php
session_start();
include 'koneksi.php';
$getNominal = "Select total as nominal,id_ksmn from pembelian where id_pemb = ".$_GET['id_beli']."";
$resultNominal = mysqli_query($koneksi,$getNominal);
$rowNominal = mysqli_fetch_assoc($resultNominal);

$debit = $rowNominal['nominal'];
// ambil sisa saldo
$getSaldo = "SELECT saldo FROM mutasi_tabungan where id_ksmn = ".$rowNominal['id_ksmn']." ORDER BY id_mutasi DESC limit 1";
$resultSaldo = mysqli_query($koneksi,$getSaldo);
$rowSaldo = mysqli_fetch_assoc($resultSaldo);
$sisaSaldo = $rowSaldo['saldo'];
echo "<br>";
echo $sisaSaldo;

//saldo baru
$saldoBaru = $sisaSaldo - $debit;
echo "<br>";
echo $saldoBaru;
echo "<br>";

// ambil tgl hari ini
date_default_timezone_set("Asia/Jakarta");
$today = date("Y-m-d");
echo "<br>";

$insertMutasi = "INSERT INTO `mutasi_tabungan` (`id_mutasi`, `tgl_mutasi`, `debit`, `kredit`, `saldo`, `desk_mutasi`, `id_ptgs`, `id_ksmn`) 
VALUES (NULL, '".$today."', ".$debit.", '0', ".$saldoBaru.", 'pengembalian saldo', ".$_SESSION['id_ptgs'].", ".$rowNominal['id_ksmn'].")";



$updateBeli = "UPDATE `pembelian` SET `status_pemb` = 'Sukses' WHERE `pembelian`.`id_pemb` = ".$_GET['id_beli']."";

if ($koneksi->query($updateBeli) === TRUE  AND $koneksi->query($insertMutasi ) === TRUE ) {
 header("location:riwayatBeli.php");
} else {
 echo "Error: " . $updateBeli . "<br>" . $koneksi->error;
}
?>
