<?php include 'koneksi.php';
print_r($_POST); 
$epassword = password_hash($_POST['pw_ptgs'], PASSWORD_BCRYPT);
$insertPtgs ="INSERT INTO `petugas` (`id_ptgs`, `uname_ptgs`, `email_ptgs`, `pw_ptgs`, `nama_ptgs`, `kontak_ptgs`)
 VALUES (NULL, '".$_POST['uname_ptgs']."', '".$_POST['email_ptgs']."', '".$epassword."', '".$_POST['nama_ptgs']."', '".$_POST['kontak_ptgs']."')";echo $insertPtgs;
   if ($koneksi->query($insertPtgs) === TRUE) {
    echo "<script>alert('Berhasil menabahkan petuas');</script>";
    echo "<script>location='tambahAdmin.php';</script>";
   } else {
    echo "<script>alert('email atau no handphone sudah terdaftar');</script>";
    echo "<script>location='tambahAdmin.php';</script>";
   }


?>