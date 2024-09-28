<?php include 'koneksi.php';
print_r($_POST); print_r($_FILES['image']);
$epassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
$namaposter = $_FILES['image']['name'];
$sizeposter = $_FILES['image']['size'];
$errorposter = $_FILES['image']['error'];
$tmpposter = $_FILES['image']['tmp_name'];

if($namaposter == ""){
 $namaposter="";
 $insertKsmn = "INSERT INTO `konsumen` (`id_ksmn`, `username`, `email`, `password`, `nama`, `no_telp`, `poin` ) 
 VALUES (NULL, '".$_POST['uname']."', '".$_POST['email']."', '".$epassword."', '".$_POST['nama']."', '".$_POST['no_telp']."', '0')";
  if ($koneksi->query($insertKsmn) === TRUE) {
   header("location:login.php");
  } else {
    echo "Error: " .  $insertKsmn . "<br>" . $koneksi->error;
  }
 
}else{
 echo "ada gambar";}
 move_uploaded_file($tmpposter,'assets/konsumen/'.$namaposter);
 $insertKsmn = "INSERT INTO `konsumen` (`id_ksmn`, `username`, `email`, `password`, `nama`, `no_telp`, `poin`, `image`) 
 VALUES (NULL, '".$_POST['uname']."', '".$_POST['email']."', '".$epassword."', '".$_POST['nama']."', '".$_POST['no_telp']."', '0', 'assets/konsumen/".$namaposter."')";
   if ($koneksi->query($insertKsmn) === TRUE) {
    header("location:login.php");
   } else {
     echo "Email atau nomor sudah terdaftar";
   }
?>