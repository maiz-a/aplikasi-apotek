<?php
session_start();
require_once '../../functions/MY_model.php';

$id = $_POST['id'];
$nama_distributor = $_POST['nama_distributor'];
$alamat_distributor = $_POST['alamat_distributor'];
$telepon_distributor = $_POST['telepon_distributor'];

$query = "UPDATE tb_distributor SET nama_distributor = '$nama_distributor', alamat_distributor = '$alamat_distributor', telepon_distributor = '$telepon_distributor' WHERE id = '$id'";
if (create($query) === 1) {
  echo "<script>alert('Data Berhasil Diubah');</script>";
  echo '<script>document.location.href="../../../?page=distributor";</script>';
} else {
  echo "<script>alert('Data Gagal Diubah');</script>";
  echo mysqli_error($conn);
}
