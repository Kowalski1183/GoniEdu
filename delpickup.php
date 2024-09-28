<?php
include "koneksi.php";
//kita hapus datanya sampah dikeranjang pickup
session_start();
$id_kons = $_SESSION["konsumen"]["id_ksmn"];

if(isset($_GET["id"])){
    $id_sampahsetor = $_GET["id"];
    unset($_SESSION["setor_sampah"][$id_sampahsetor]);
    $sql = "DELETE FROM `sampah_setor` WHERE id_sampahsetor = '$id_sampahsetor'";
    $result = mysqli_query($koneksi, $sql);
}elseif(isset($_GET["id_ksmn"])){
    $id_ksmn = $_GET["id_ksmn"];
    $sql = "DELETE FROM `alamat_konsumen` WHERE id_ksmn='". $_SESSION["konsumen"]["id_ksmn"] ."' AND id_alamat='". $_GET["id_alamat"] ."'";
    $result = mysqli_query($koneksi, $sql);
}else{
    $id_brg = $_GET['brg'];
    $sql = "UPDATE `barang` SET `stock` = '93' WHERE `barang`.`id_brg` = ".$id_brg."";
    $result = mysqli_query($koneksi, $sql);
    unset($_SESSION["barang"][$id_brg]);
}

if(isset($_GET["id"])){
    echo "<script>alert('sampah dihapus dari pickup');</script>";
    echo "<script>location='cartpickup.php';</script>";
}elseif(isset($_GET["id_ksmn"])){
    echo "<script>alert('Alamat dihapus');</script>";
    echo "<script>location='profil.php?id_ksmn=$id_kons';</script>";
}
else{
    echo "<script>alert('barang dihapus dari keranjang');</script>";
    echo "<script>location='keranjang.php';</script>";
}
