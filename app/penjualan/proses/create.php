<?php
session_start();
require_once '../../functions/MY_model.php';

$no_struk = $_POST['no_struk']; 
$tgl_penjualan = $_POST['tgl_penjualan'];
$nama_obat = $_POST['obat']; 
$jumlah = $_POST['jumlah']; 
$harga = $_POST['harga']; 
$total_harga = $_POST['total_harga'];
$username = $_POST['user'];


// Ambil ID users berdasarkan username
$user = get_where("SELECT id FROM users WHERE id = '$username'");
$user_id = $user['id'];

// Ambil ID obat berdasarkan nama obat
$obat = get_where("SELECT id FROM obats WHERE id = '$nama_obat'");
$obat_id = $obat['id'];

$query = "INSERT INTO penjualans (no_struk, tgl_penjualan, obat_id, jumlah, harga, total_harga, user_id) 
          VALUES ('$no_struk', '$tgl_penjualan', '$obat_id', '$jumlah', '$harga', '$total_harga', '$user_id')";

if (create($query) === 1) {
  echo '<script>document.location.href="../../../?page=penjualan";</script>';
} else {
  echo mysqli_error($conn);
}

?>