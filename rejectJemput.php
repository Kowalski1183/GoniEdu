<?php
session_start();
include 'koneksi.php';
$updateReject = "UPDATE `detail_setor` SET `status` = 'Reject' WHERE `detail_setor`.`id_detail_pickup` = ".$_GET['id_detail_pickup']."";
if ($koneksi->query($updateReject) === TRUE) {
 header("location:riwayatSetor.php");
} else {
 echo "Error: " . $updateReject . "<br>" . $koneksi->error;
}
?>