<?php session_start();
include 'koneksi.php';
$deleteBrg = "UPDATE `sampah` SET `status_smph` = 'Nonaktif' WHERE `sampah`.`id_smph` = ".$_GET['idSmph']."";
echo $deleteGambar;
if ($koneksi->query($deleteBrg) === TRUE) {
  header("location:kelolaSmph.php");
} else { 
 echo "Error: " . $deleteBrg . "<br>" . $koneksi->error;
}?> 