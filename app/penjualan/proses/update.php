<?php
session_start();
require_once '../../functions/MY_model.php';

$id = $_POST['id']; 
$no_struk = $_POST['no_struk']; 
$tgl_penjualan = $_POST['tgl_penjualan']; 
$total_harga = $_POST['total_harga']; 
$total_bayar = $_POST['total_bayar']; 
$kembali= $_POST['kembali']; 
$nama_karyawan = $_POST['karyawan']; 

// Ambil ID karyawan berdasarkan nama karyawan
$tb_karyawan = get_where("SELECT id FROM tb_karyawan WHERE id = '$nama_karyawan'"); 
$karyawan_id = $tb_karyawan['id'];


$query = "UPDATE tb_penjualan SET no_struk = '$no_struk', tgl_penjualan = '$tgl_penjualan', total_harga = '$total_harga', total_bayar = '$total_bayar', kembali = '$kembali',karyawan_id = '$karyawan_id'  
          WHERE id = '$id'";
          
if (update($query) === 1) {
  echo '<script>document.location.href="../../../?page=penjualan";</script>';
} else {
  echo mysqli_error($conn);
}

?>
