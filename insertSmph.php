<?php 
session_start();
include 'koneksi.php';
var_dump($_FILES['file_smph']);echo "<br>";
print_r($_POST);

$insertSmph = "INSERT INTO `sampah` (`id_smph`, `kategori_smph`, `harga_cash`, `kode_smph`)
VALUES (NULL, '".$_POST['kategori_smph']."', ".$_POST['harga_cash'].", '".$_POST['kode_smph']."')";
if ($koneksi->query($insertSmph) === TRUE) {
 $getId = "SELECT max(id_smph) as id_smph from sampah ";
 $resultId = mysqli_query($koneksi,$getId);
 $rowId = mysqli_fetch_assoc($resultId);


 $namaposter = $_FILES['file_smph']['name'];
 $sizeposter = $_FILES['file_smph']['size'];
 $errorposter = $_FILES['file_smph']['error'];
 $tmpposter = $_FILES['file_smph']['tmp_name'];
 if($namaposter == ""){
  $insertGambar = "INSERT INTO `gambar_smph` (`idgambar_smph`, `id_smph`) VALUES (NULL,  ".$rowId['id_smph'].")";
  if ($koneksi->query( $insertGambar) === TRUE) {
   header("location:kelolaSmph.php");
  } else {
    echo "Error: " .  $insertGambar . "<br>" . $koneksi->error;
  }
  }else{
  move_uploaded_file($tmpposter,'assets/sampah/'.$namaposter);

  $insertGambar = "INSERT INTO `gambar_smph` (`idgambar_smph`, `file_smph`, `id_smph`) VALUES (NULL, '".$namaposter."', ".$rowId['id_smph'].")";
  if ($koneksi->query( $insertGambar) === TRUE) {
   header("location:kelolaSmph.php");
  } else {
    echo "Error: " .  $insertGambar . "<br>" . $koneksi->error;
  }
 }
} else {
 echo "Error: " . $insertSmph . "<br>" . $koneksi->error;
}
?>