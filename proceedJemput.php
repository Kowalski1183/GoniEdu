<?php
session_start();
include 'koneksi.php';


// ambil tgl hari ini
date_default_timezone_set("Asia/Jakarta");
$today = date("Y-m-d");
echo "<br>";



$updateBeli = "UPDATE `detail_setor` SET `status` = 'Dalam Proses' WHERE `detail_setor`.`id_detail_pickup` =".$_GET['id_detail_pickup']."";

if ($koneksi->query($updateBeli) === TRUE ) {
 header("location:listJemput.php");
} else {
 echo "Error: " . $updateBeli . "<br>" . $koneksi->error;
}
?>
