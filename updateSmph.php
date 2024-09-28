<?php 
session_start();
include 'koneksi.php';
var_dump($_FILES['file_smph']);echo "<br>";
print_r($_POST);
$updateSmph = "UPDATE `sampah` SET `kategori_smph` = '".$_POST['kategori_smph']."', `harga_cash` = ".$_POST['harga_cash'].",
`kode_smph` = '".$_POST['kode_smph']."' WHERE `sampah`.`id_smph` = ".$_POST['id_smph']."";
if ($koneksi->query($updateSmph) === TRUE) {
  $namaposter = $_FILES['file_smph']['name'];
  $sizeposter = $_FILES['file_smph']['size'];
  $errorposter = $_FILES['file_smph']['error'];
  $tmpposter = $_FILES['file_smph']['tmp_name'];
  if($namaposter == ""){header("location:kelolaSmph.php");}
  else{move_uploaded_file($tmpposter,'assets/sampah/'.$namaposter);
      $updateGambar = "UPDATE `gambar_smph` SET `file_smph` = '".$namaposter."' WHERE `gambar_smph`.`id_smph` =".$_POST['id_smph']."";}
      if ($koneksi->query($updateGambar) === TRUE) {
        header("location:kelolaSmph.php");
       } else {
         echo "Error: " .  $updateGambar . "<br>" . $koneksi->error;
       }
 
} else {
echo "Error: " . $updateSmph . "<br>" . $koneksi->error;
}




?>