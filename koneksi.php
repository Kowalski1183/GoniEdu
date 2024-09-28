<?php

$koneksi = mysqli_connect("localhost","root","","goninew");

if(mysqli_connect_errno()){
 echo "koneksi database gagal :" . mysql_connect_errno();
}

 ?> 