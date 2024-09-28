<?php session_start();
include 'koneksi.php';
$deleteBrg = "UPDATE `barang` SET `status_brg` = 'Nonaktif' WHERE `barang`.`id_brg` = ".$_GET['idBrg']."";
echo $deleteGambar;
if ($koneksi->query($deleteBrg) === TRUE) {
  header("location:kelolaBrg.php");
} else { 
 echo "Error: " . $deleteBrg . "<br>" . $koneksi->error;
}?> 