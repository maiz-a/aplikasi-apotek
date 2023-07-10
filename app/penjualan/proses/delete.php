<?php
require_once 'app/functions/MY_model.php';

$penjualan_id = $_GET['id'];

// Hapus detail penjualan
$query_delete_det_penjualan = "DELETE FROM tb_det_penjualan WHERE penjualan_id = '$penjualan_id'";
$result_delete_det_penjualan = mysqli_query($conn, $query_delete_det_penjualan);

// Hapus data stok terkait
$query_delete_stok = "DELETE FROM tb_stok WHERE id IN (SELECT stok_id FROM tb_det_penjualan WHERE penjualan_id = '$penjualan_id')";
$result_delete_stok = mysqli_query($conn, $query_delete_stok);

// Hapus penjualan
$query_delete_penjualan = "DELETE FROM tb_penjualan WHERE id = '$penjualan_id'";
$result_delete_penjualan = mysqli_query($conn, $query_delete_penjualan);

if ($result_delete_det_penjualan && $result_delete_stok && $result_delete_penjualan) {
  // Hapus berhasil
  echo "<script>alert('Data Berhasil Dihapus');</script>";
  echo "<script>location= '?page=penjualan';</script>";
  exit();
} else {
  // Hapus gagal
  $error_message = mysqli_error($conn);
}
?>
