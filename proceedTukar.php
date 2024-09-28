<?php
session_start();
include 'koneksi.php';


// ambil tgl hari ini
date_default_timezone_set("Asia/Jakarta");
$today = date("Y-m-d");
echo "<br>";



$updateBeli = "UPDATE `penukaran` SET `status` = 'Dalam Proses' WHERE `penukaran`.`id_tukar` =".$_GET['id_tukar']."";

if ($koneksi->query($updateBeli) === TRUE ) {
 header("location:listTukar.php");
} else {
 echo "Error: " . $updateBeli . "<br>" . $koneksi->error;
}
?>
