<?php
session_start();
$id_sampahsetor = $_GET['id'];

//jika sudah ada produk dikeranjang maka produk itu jumlahnya di +1
if (isset($_SESSION['setor_sampah'][$id_sampahsetor])) {
    $_SESSION['setor_sampah'][$id_sampahsetor] += 1;
} else {
    $_SESSION['setor_sampah'][$id_sampahsetor] = 1;
}

// larikan ke halaman keranjang 
echo "<script>alert('sampah masuk ke keranjang');</script>";
echo "<script>location='cartpickup.php';</script>";