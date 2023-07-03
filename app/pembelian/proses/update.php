<?php
session_start();
require_once '../../functions/MY_model.php';

session_start();
require_once '../../functions/MY_model.php';

// Mendapatkan data pembelian dari form
$id = $_POST['id'];
$no_faktur = $_POST['no_faktur'];
$tgl_pembelian = $_POST['tgl_pembelian'];
$tgl_jatuh_tempo = $_POST['tgl_jatuh_tempo'];
$total_bayar = $_POST['total_bayar'];
$sisa_bayar = $_POST['sisa_bayar'];
$status = $_POST['status'];
$distributor = $_POST['distributor'];
$karyawan = $_POST['karyawan'];

// Query untuk update data pembelian
$query_pembelian = "UPDATE tb_pembelian SET no_faktur = '$no_faktur', tgl_pembelian = '$tgl_pembelian', tgl_jatuh_tempo = '$tgl_jatuh_tempo',
                    total_bayar = '$total_bayar', sisa_bayar = '$sisa_bayar', status = '$status',
                    distributor_id = '$distributor', karyawan_id = '$karyawan' WHERE id = '$id_pembelian'";

// Eksekusi query pembelian
$result_pembelian = mysqli_query($conn, $query_pembelian);

if ($result_pembelian) {
  // Query untuk update tanggal_update di tb_stok
  $query_stok = "UPDATE tb_stok SET tanggal_update = '$tgl_pembelian' WHERE pembelian_id = '$id_pembelian'";

  // Eksekusi query stok
  $result_stok = mysqli_query($conn, $query_stok);

  if ($result_stok) {
    $_SESSION['message'] = "Data pembelian berhasil diubah.";
    header('Location: ../../../?page=pembelian');
    exit();
  } else {
    $_SESSION['message'] = "Gagal mengubah data pembelian.";
    header('Location: ../../../?page=pembelian');
    exit();
  }
} else {
  $_SESSION['message'] = "Gagal mengubah data pembelian.";
  header('Location: ../../../?page=pembelian');
  echo mysqli_error($conn);
  exit();
}



?>
