<?php 
session_start();
include 'koneksi.php';
var_dump($_FILES['file_brg']);echo "<br>";
print_r($_POST);
$updateBrg = "UPDATE `barang` SET `nama_brg` = '".$_POST['nama_brg']."', `harga_brg` = ".$_POST['harga_brg'].", 
`jenis_brg` = '".$_POST['jenis_brg']."', `stock` = ".$_POST['stock']." WHERE `barang`.`id_brg` = ".$_POST['id_brg']."";
if ($koneksi->query($updateBrg) === TRUE) {
  $namaposter = $_FILES['file_brg']['name'];
  $sizeposter = $_FILES['file_brg']['size'];
  $errorposter = $_FILES['file_brg']['error'];
  $tmpposter = $_FILES['file_brg']['tmp_name'];
  if($namaposter == ""){header("location:kelolaBrg.php");}
  else{move_uploaded_file($tmpposter,'assets/sampah/'.$namaposter);
      $updateGambar = "UPDATE `gambar_brg` SET `file_brg` = '".$namaposter."' WHERE `gambar_brg`.`id_brg` = ".$_POST['id_brg']."";}
      if ($koneksi->query($updateGambar) === TRUE) {
        header("location:kelolaBrg.php");
       } else {
         echo "Error: " .  $updateGambar . "<br>" . $koneksi->error;
       }
 
} else {
echo "Error: " . $updateBrg . "<br>" . $koneksi->error;
}




?>