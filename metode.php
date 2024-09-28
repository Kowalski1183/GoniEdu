<?php
include 'koneksi.php';
//tampung id_jen
$metode = $_POST['bayarr'];
$sql = mysqli_query($koneksi,"SELECT * FROM wallet WHERE id_pilih = $metode");
echo '<option value="0">--PILIH--</option>';
while($row = mysqli_fetch_array($sql)){
?>
<option value="<?php echo $row['id_wallet'] ?>"><?php echo $row['wallet'] ?> </option>
<?php
}
?>