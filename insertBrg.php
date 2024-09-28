<?php 
session_start();
include 'koneksi.php';
var_dump($_FILES['file_brg']);echo "<br>";
print_r($_POST);

$insertBrg = "INSERT INTO `barang` (`id_brg`, `nama_brg`, `harga_brg`, `jenis_brg`, `stock`, `status_brg`) 
VALUES (NULL, '".$_POST['nama_brg']."', ".$_POST['harga_brg'].", '".$_POST['jenis_brg']."', ".$_POST['stock'].", 'Aktif')";
if ($koneksi->query($insertBrg) === TRUE) {
 $getId = "SELECT max(id_brg) as id_brg from barang ";
 $resultId = mysqli_query($koneksi,$getId);
 $rowId = mysqli_fetch_assoc($resultId);


 $namaposter = $_FILES['file_brg']['name'];
 $sizeposter = $_FILES['file_brg']['size'];
 $errorposter = $_FILES['file_brg']['error'];
 $tmpposter = $_FILES['file_brg']['tmp_name'];

 move_uploaded_file($tmpposter,'assets/barang/'.$namaposter);

 $insertGambar = "INSERT INTO `gambar_brg` (`idgambar_brg`, `file_brg`, `id_brg`) VALUES (NULL, '".$namaposter."', ".$rowId['id_brg'].")";
 if ($koneksi->query( $insertGambar) === TRUE) {
  header("location:kelolaBrg.php");
 } else {
   echo "Error: " .  $insertGambar . "<br>" . $koneksi->error;
 }

} else {
 echo "Error: " . $insertBrg . "<br>" . $koneksi->error;
}
?>