<?php
session_start();
require_once '../../functions/MY_model.php';

$kode_obat = $_POST['kode_obat']; 
$nama_obat = $_POST['nama_obat'];
$nama_distributor = $_POST['distributor']; 
$nama_kategori = $_POST['kategori']; 
$nama_satuan = $_POST['satuan']; 
$tablet_per_box = $_POST['tablet_per_box']; 
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];

// Ambil ID distributor berdasarkan nama distributor
$distributor = get_where("SELECT id FROM tb_distributor WHERE id = '$nama_distributor'");
$distributor_id = $distributor['id'];

// Ambil ID kategori berdasarkan nama kategori
$kategori = get_where("SELECT id FROM tb_kategori WHERE id = '$nama_kategori'");
$kategori_id = $kategori['id'];

// Ambil ID satuan berdasarkan nama satuan
$satuan = get_where("SELECT id FROM tb_satuan WHERE id = '$nama_satuan'");
$satuan_id = $satuan['id'];

$query = "INSERT INTO tb_obat (kode_obat, nama_obat, distributor_id, kategori_id, satuan_id, tablet_per_box, harga_beli, harga_jual) 
          VALUES ('$kode_obat', '$nama_obat', '$distributor_id', '$kategori_id', '$satuan_id', '$tablet_per_box', '$harga_beli', '$harga_jual')";

if (create($query) === 1) {
  echo '<script>document.location.href="../../../?page=obat";</script>';
} else {
  echo mysqli_error($conn);
}

?>