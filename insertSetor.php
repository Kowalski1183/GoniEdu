<?php 
session_start();
include "koneksi.php";
print_r($_POST);

//ambil tgl hari ini
date_default_timezone_set("Asia/Jakarta");
$today = date("y-m-d");

//get id ksmn
$getIdKsmn="SELECT id_ksmn from konsumen where no_telp = ".$_POST['no_telp']."";
echo $getIdKsmn;
$resultIdKsmn = mysqli_query($koneksi,$getIdKsmn);
$rowIdKsmn = mysqli_fetch_assoc($resultIdKsmn);
echo "<br>".$rowIdKsmn['id_ksmn'];

//get alamat 
$getAlamat = "SELECT min(id_alamat) as alamat from alamat_konsumen where id_ksmn = ".$rowIdKsmn['id_ksmn']."";
$resultAlamat = mysqli_query($koneksi,$getAlamat);
$alamat = mysqli_fetch_assoc($resultAlamat);

//get harga sampah
$getSmph = "SELECT harga_cash,kategori_smph as katSmph from sampah where id_smph = ".$_POST['sampah']."";
echo $getSmph;
$resultSmph = mysqli_query($koneksi,$getSmph);
$rowSmph = mysqli_fetch_assoc($resultSmph);
$totalHarga = $rowSmph['harga_cash']*$_POST['berat'];
echo "<br>".$rowSmph['harga_cash']."<br>".$totalHarga;

//insert sampah setor
$insertSS = "INSERT INTO `sampah_setor` (`id_sampahsetor`, `berat`, `id_smph`, `id_ksmn`, `harga`) 
VALUES (NULL, ".$_POST['berat'].",".$_POST['sampah'].", ".$rowIdKsmn['id_ksmn'].", ".$totalHarga.")";
echo "<br>".$insertSS;

$insertSetor = "INSERT INTO `setor` (`id_setor`, `id_ksmn`, `total_berat`, `total_harga`, `tgl_setor`, `cara_setor`, `jenis_setor`) 
VALUES (NULL, ".$rowIdKsmn['id_ksmn'].", ".$_POST['berat'].", ".$totalHarga.",'".$today."','".$_POST['cara_setor']."' , '".$_POST['jenissetor']."')";
echo "<br>".$insertSetor;

if (($koneksi->query($insertSS) === TRUE) AND ($koneksi->query($insertSetor) === TRUE)){
    //get id sampahsetor and id setor
    $getIdSS = "SELECT id_sampahsetor from konsumen join sampah_setor using(id_ksmn)  where id_ksmn = ".$rowIdKsmn['id_ksmn']." ORDER BY id_sampahsetor DESC limit 1";
    $resultIdSS = mysqli_query($koneksi,$getIdSS);
    $rowIdSS = mysqli_fetch_assoc($resultIdSS);
    echo "<br>".$rowIdSS['id_sampahsetor'];
    $getIdSetor = "SELECT id_setor from konsumen join setor using(id_ksmn)  where id_ksmn = ".$rowIdKsmn['id_ksmn']." ORDER BY id_setor DESC limit 1";
    $resultIdSetor = mysqli_query($koneksi,$getIdSetor);
    $rowIdSetor = mysqli_fetch_assoc($resultIdSetor);
    echo "<br>".$rowIdSetor['id_setor'];

    //insert detail setor
    $insertDS ="INSERT INTO `detail_setor` (`id_detail_pickup`, `id_setor`, `id_sampahsetor`, `status`, `tgl_jemput`, `tgl_approve`) 
    VALUES (NULL, ".$rowIdSetor['id_setor'].", ".$rowIdSS['id_sampahsetor'].", 'Sukses', '".$today."', '".$today."')";
    if ($koneksi->query($insertDS) === TRUE) {

        $debit = 0;
        $kredit = $totalHarga;
         // ambil sisa saldo
         $getSaldo = "SELECT saldo FROM mutasi_tabungan where id_ksmn = ".$rowIdKsmn['id_ksmn']." ORDER BY id_mutasi DESC limit 1";
         $resultSaldo = mysqli_query($koneksi,$getSaldo);
         if(mysqli_num_rows($resultSaldo)>0){
         $rowSaldo = mysqli_fetch_assoc($resultSaldo);
         $sisaSaldo = $rowSaldo['saldo'];
         }else {$sisaSaldo = 0;}
         echo "<br>";
         echo $sisaSaldo;
       
         //saldo baru
         $saldoBaru = $sisaSaldo + $kredit;
         echo "<br>";
         echo $saldoBaru;
         echo "<br>";
       
         // ambil tgl hari ini
         date_default_timezone_set("Asia/Jakarta");
         $today = date("Y-m-d");
         echo "<br>";
       
         // buat desk penyetoran sampah
         $desk = "penambahan kredit penyetoran ".$_POST['berat']." kg"." ".$rowSmph['katSmph'];
         echo $desk;
         echo "<br>";
       
         // insert mutasi diterima
         $insertMutasi  = "INSERT INTO `mutasi_tabungan` (`id_mutasi`, `tgl_mutasi`, `debit`, `kredit`, `saldo`, `desk_mutasi`, `id_ptgs`, `id_ksmn`)
         VALUES (NULL, '".$today."', ".$debit." , ".$kredit." , ".$saldoBaru.", '$desk', ".$_SESSION['id_ptgs'].", ".$rowIdKsmn['id_ksmn'].")";
         if ($koneksi->query($insertMutasi) === TRUE) {
            $getpoin = "select poin from konsumen where id_ksmn =".$rowIdKsmn['id_ksmn']."";
            $resultpoin = mysqli_query($koneksi,$getpoin);
            $rowpoin = mysqli_fetch_assoc($resultpoin);
            $poinbaru = $rowpoin['poin']+$kredit;
            $updatePoin = "UPDATE `konsumen` SET `poin` = ".$poinbaru." WHERE `konsumen`.`id_ksmn` = ".$rowIdKsmn['id_ksmn']."";
             if ($koneksi->query($updatePoin) === TRUE) {
                header("location:riwayatSetor.php");
            } else {
                echo "Error: " . $updatePoin . "<br>" . $koneksi->error;
            }
         } else {
             echo "Error: " . $insertMutasi . "<br>" . $koneksi->error;
         }
    } else {
        echo "Error: " . $insertDS . "<br>" . $koneksi->error;
    }
} else {
    echo "Error: " . $insertSS . "dan" . $insertSetor. "<br>" . $koneksi->error;
}

?>