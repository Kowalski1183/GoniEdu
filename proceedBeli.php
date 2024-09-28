<?php
session_start();
include 'koneksi.php';


// ambil tgl hari ini
date_default_timezone_set("Asia/Jakarta");
$today = date("Y-m-d");
echo "<br>";



$updateBeli = "UPDATE `pembelian` SET `status_pemb` = 'Dalam Proses' WHERE `pembelian`.`id_pemb` =".$_GET['id_beli']."";

if ($koneksi->query($updateBeli) === TRUE ) {
 header("location:listBeli.php");
} else {
 echo "Error: " . $updateBeli . "<br>" . $koneksi->error;
}
?>
