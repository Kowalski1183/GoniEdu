<?php
session_start();

$id_brg = $_GET['brg'];
$pilihan = $_GET['pilihan'];

include "koneksi.php";
$mutasi = "SELECT poin FROM konsumen WHERE id_ksmn = ".$_SESSION["konsumen"]["id_ksmn"]."";
$mutasii = mysqli_query($koneksi, $mutasi);
$konsumen =  mysqli_fetch_assoc($mutasii);

$stok = "SELECT * FROM `barang` WHERE id_brg = '".$id_brg."'";
$result = mysqli_query($koneksi, $stok);
$row = mysqli_fetch_assoc($result);
$stock1 = $row['stock'];
$stock = $row['stock']-1;

if(isset($id_brg)){
    if($konsumen['poin']<$row['harga_brg']){
        echo "<script>alert('Saldo Tidak Cukup');</script>";
        echo "<script>location='formtukar.php?pilihan=2';</script>";
        exit;
    }
}
//jika sudah ada produk dikeranjang maka produk itu jumlahnya di +1

if (isset($_SESSION['barang'][$id_brg])) {
    $_SESSION['barang'][$id_brg] += 1;
} else {
    $_SESSION['barang'][$id_brg] = 1;
}
///// select

/////

// larikan ke halaman keranjang
if(isset( $_GET['tukar'])){
    $alamat = $_GET["alamat"];
    $harga = $_GET['harga'];
    $id_setor = $_GET['tukar'];
    // echo "<script>alert('barang masuk ke keranjang');</script>";
    // echo "<script>location='keranjang.php?tkr=$id_setor&&pilihan=$pilihan&&harga=$harga&&alamat=$alamat';</script>";
    $sql = "UPDATE `barang` SET `stock`='$stock' WHERE id_brg = '".$id_brg."'";
    $resultt = mysqli_query($koneksi, $sql);
}else{

       
            echo "<script>alert('barang masuk ke keranjang');</script>";
            echo "<script>location='keranjang.php?pilihan=$pilihan';</script>";
            $sql = "UPDATE `barang` SET `stock`='$stock' WHERE id_brg = '".$id_brg."'";
            $resultt = mysqli_query($koneksi, $sql);


}