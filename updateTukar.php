<?php
session_start();
include 'koneksi.php';

$getNominal = "Select nominal,id_ksmn,simbol from penukaran where id_tukar = ".$_GET['id_tukar']."";
$resultNominal = mysqli_query($koneksi,$getNominal);
$rowNominal = mysqli_fetch_assoc($resultNominal);
$simbol = $rowNominal['simbol'];
$debit = $rowNominal['nominal'];

// ambil sisa saldo
$getSaldo = "SELECT saldo FROM mutasi_tabungan where id_ksmn = ".$rowNominal['id_ksmn']." ORDER BY id_mutasi DESC limit 1";
$resultSaldo = mysqli_query($koneksi,$getSaldo);
$rowSaldo = mysqli_fetch_assoc($resultSaldo);
$sisaSaldo = $rowSaldo['saldo'];
echo "<br>";
echo $sisaSaldo;
if($simbol == 1){
    $saldoBaru = $sisaSaldo;
    $insertMutasi = "INSERT INTO `mutasi_tabungan` (`id_mutasi`, `tgl_mutasi`, `debit`, `kredit`, `saldo`, `desk_mutasi`, `id_ptgs`, `id_ksmn`) VALUES (NULL, '".$today."', ".$debit.", ".$debit.", ".$saldoBaru.", 'pengembalian saldo', ".$_SESSION['id_ptgs'].", ".$rowNominal['id_ksmn'].")";
}else{//saldo baru
    $saldoBaru = $sisaSaldo - $debit;
    $insertMutasi = "INSERT INTO `mutasi_tabungan` (`id_mutasi`, `tgl_mutasi`, `debit`, `kredit`, `saldo`, `desk_mutasi`, `id_ptgs`, `id_ksmn`) VALUES (NULL, '".$today."', ".$debit.", '0', ".$saldoBaru.", 'pengembalian saldo', ".$_SESSION['id_ptgs'].", ".$rowNominal['id_ksmn'].")";
}
// ambil tgl hari ini
date_default_timezone_set("Asia/Jakarta");
$today = date("Y-m-d");
echo "<br>";



$updateTukar = "UPDATE `penukaran` SET `status` = 'Sukses' WHERE `penukaran`.`id_tukar` = ".$_GET['id_tukar']."";
if ($koneksi->query($updateTukar) === TRUE AND $koneksi->query($insertMutasi) === TRUE ) {
    header("location:riwayatTukar.php");
} else {
    echo "Error: " . $updateTukar . "<br>" . $koneksi->error;
}
?>
