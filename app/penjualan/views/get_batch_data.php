<?php
// Koneksi ke database
require_once '../../functions/MY_model.php';

// Ambil ID obat yang dikirim melalui parameter URL
$obatId = $_GET['obat_id'];

// Query untuk mendapatkan nomor batch berdasarkan ID obat
$query = "SELECT * FROM tb_batch WHERE obat_id = $obatId";
$batchData = get($query);

// Kembalikan data nomor batch dalam format JSON
echo json_encode($batchData);
?>
