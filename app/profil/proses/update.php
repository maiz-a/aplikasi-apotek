<?php
session_start();
require_once 'app/functions/MY_model.php';

$id = $_POST['id'];
$nama_pasien = $_POST['nama_pasien'];
$tempat_lhr_pasien = $_POST['tempat_lhr_pasien'];
$tgl_lhr_pasien = $_POST['tgl_lhr_pasien'];
$alamat_pasien = $_POST['alamat_pasien'];
$no_hp_pasien = $_POST['no_hp_pasien'];
$jk_pasien = $_POST['jk_pasien'];
$updated_at = date('Y-m-d H:i:s');
$updated_by = $_SESSION['user']['id'];
$query = "UPDATE pasiens SET  nama_pasien = '$nama_pasien',tempat_lhr_pasien = '$tempat_lhr_pasien', tgl_lhr_pasien = '$tgl_lhr_pasien' ,
 alamat_pasien = '$alamat_pasien', no_hp_pasien = '$no_hp_pasiene', jk_pasien = '$jk_pasien', updated_at = '$updated_at', updated_by = '$updated_by' WHERE id = '$id'";
if (create($query) === 1) {
  echo '<script>document.location.href="../../../?page=profil";</script>';
} else {
  echo mysqli_error($conn);
}
