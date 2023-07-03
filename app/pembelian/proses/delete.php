<?php
require_once 'app/functions/MY_model.php';

$id = $_GET['id'];

// Menghapus data detail pembelian terlebih dahulu
if (delete("DELETE FROM tb_det_pembelian WHERE pembelian_id = '$id'") !== false) {
  // Jika penghapusan detail pembelian berhasil, lanjutkan dengan penghapusan data pembelian
  if (delete("DELETE FROM tb_pembelian WHERE id = '$id'") !== false) {
    echo "<script>alert('Data Berhasil Dihapus');</script>";
    echo "<script>location= '?page=pembelian';</script>";
  } else {
    echo "<script>alert('Gagal menghapus data pembelian');</script>";
    echo "<script>location= '?page=pembelian';</script>";
  }
} else {
  echo "<script>alert('Gagal menghapus detail pembelian');</script>";
  echo "<script>location= '?page=pembelian';</script>";
}
?>