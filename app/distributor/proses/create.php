<?php
session_start();
require_once '../../functions/MY_model.php';

$nama_distributor = $_POST['nama_distributor'];
$alamat_distributor = $_POST['alamat_distributor'];
$telepon_distributor = $_POST['telepon_distributor'];

$query = "INSERT INTO tb_distributor (nama_distributor, alamat_distributor, telepon_distributor) 
VALUES ('$nama_distributor', '$alamat_distributor', '$telepon_distributor')";
if (create($query) === 1) {
  echo "<script>alert('Data Berhasil Disimpan');</script>";
  echo '<script>document.location.href="../../../?page=distributor";</script>';
} else {
  echo "<script>alert('Data Gagal Disimpan');</script>";
  echo mysqli_error($conn);
}
