<?php
include 'koneksi.php';
ob_start();
session_start(); 
print_r($_POST);
$getPw = "select password from konsumen where email='".$_POST['email']."'";
$resultPw = mysqli_query($koneksi,$getPw);
if(mysqli_num_rows($resultPw)>0){echo "email benar";
 $rowPw = mysqli_fetch_assoc($resultPw);
 if(password_verify($_POST['password'],$rowPw['password'])){
  echo "password benar";
 }else {echo "<script>alert('password salah');</script>";echo "<script>location='login.php";}
}else{echo "<script>alert('email salah');</script>";echo "<script>location='login.php";}
?>