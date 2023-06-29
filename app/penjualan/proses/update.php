<?php
session_start();
require_once '../../functions/MY_model.php';

$id = $_POST['id']; 
$no_struk = $_POST['no_struk']; 
$tgl_penjualan = $_POST['tgl_penjualan'];
$nama_obat = $_POST['obat']; 
$jumlah = $_POST['jumlah']; 
$harga = $_POST['harga']; 
$total_harga = $_POST['total_harga'];
$username = $_POST['user'];


// Ambil ID obat berdasarkan nama obat
$obat = get_where("SELECT id FROM obats WHERE id = '$nama_obat'");
$obat_id = $obat['id'];

// Ambil ID user berdasarkan nama user
$user = get_where("SELECT id FROM users WHERE id = '$username'"); 
$user_id = $user['id'];


$query = "UPDATE penjualans SET no_struk = '$no_struk', tgl_penjualan = '$tgl_penjualan', obat_id = '$obat_id', 
          jumlah = '$jumlah', harga = '$harga', total_harga = '$total_harga', user_id = '$user_id'  
          WHERE id = '$id'";

if (update($query) === 1) {
  echo '<script>document.location.href="../../../?page=penjualan";</script>';
} else {
  echo mysqli_error($conn);
}




?>
