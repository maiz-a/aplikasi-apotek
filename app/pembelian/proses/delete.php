<?php
require_once 'app/functions/MY_model.php';

$id = $_GET['id'];

// Query untuk mendapatkan batch_id dari tb_det_pembelian
$query_batch_id = "SELECT batch_id FROM tb_det_pembelian WHERE pembelian_id = '$id'";
$result_batch_id = mysqli_query($conn, $query_batch_id);

if ($row_batch_id = mysqli_fetch_assoc($result_batch_id)) {
  $batch_id = $row_batch_id['batch_id'];

  // Query untuk menghapus data det_pembelian
  $query_delete_det_pembelian = "DELETE FROM tb_det_pembelian WHERE pembelian_id = '$id'";
  $result_delete_det_pembelian = mysqli_query($conn, $query_delete_det_pembelian);

  if ($result_delete_det_pembelian) {
    // Query untuk menghapus data stok terkait
    $query_delete_stok = "DELETE FROM tb_stok WHERE batch_id = '$batch_id'";
    $result_delete_stok = mysqli_query($conn, $query_delete_stok);

    if ($result_delete_stok) {
      // Query untuk menghapus data batch terkait
      $query_delete_batch = "DELETE FROM tb_batch WHERE id = '$batch_id'";
      $result_delete_batch = mysqli_query($conn, $query_delete_batch);

      if ($result_delete_batch) {
        // Query untuk menghapus data pembelian
        $query_delete_pembelian = "DELETE FROM tb_pembelian WHERE id = '$id'";
        $result_delete_pembelian = mysqli_query($conn, $query_delete_pembelian);

        if ($result_delete_pembelian && mysqli_affected_rows($conn) > 0) {
          echo "<script>alert('Data pembelian berhasil dihapus.');</script>";
          echo "<script>location= '?page=pembelian';</script>";
          exit();
        } else {
          echo "<script>alert('Gagal menghapus data pembelian.');</script>";
          echo "<script>location= '?page=pembelian';</script>";
          exit();
        }
      } else {
        echo "<script>alert('Gagal menghapus data pembelian.');</script>";
        echo "<script>location= '?page=pembelian';</script>";
        exit();
      }
    } else {
      echo "<script>alert('Gagal menghapus data pembelian.');</script>";
      echo "<script>location= '?page=pembelian';</script>";
      exit();
    }
  } else {
    echo "<script>alert('Gagal menghapus data pembelian.');</script>";
    echo "<script>location= '?page=pembelian';</script>";
    exit();
  }
} else {
  echo "<script>alert('Gagal mendapatkan data pembelian.');</script>";
  echo "<script>location= '?page=pembelian';</script>";
  exit();
}
?>
