<?php
session_start();
require_once '../../functions/MY_model.php';

$id = $_POST['id'];
$kode_obat = $_POST['kode_obat']; 
$nama_obat = $_POST['nama_obat'];
$nama_distributor = $_POST['distributor']; 
$nama_kategori = $_POST['kategori']; 
$nama_satuan = $_POST['satuan']; 
$qty_per_box = $_POST['qty_per_box']; 
$harga_jual = $_POST['harga_jual'];

// Ambil ID supplier berdasarkan nama distributor
$distributor = get_where("SELECT id FROM tb_distributor WHERE id = '$nama_distributor'");
$distributor_id = $distributor['id'];

// Ambil ID kategori berdasarkan nama kategori
$kategori = get_where("SELECT id FROM tb_kategori WHERE id = '$nama_kategori'");
$kategori_id = $kategori['id'];

// Ambil ID satuan berdasarkan nama satuan
$satuan = get_where("SELECT id FROM tb_satuan WHERE id = '$nama_satuan'");
$satuan_id = $satuan['id'];

$query = "UPDATE tb_obat SET kode_obat = '$kode_obat', nama_obat = '$nama_obat', distributor_id = '$distributor_id', 
          kategori_id = '$kategori_id',  satuan_id = '$satuan_id', qty_per_box = '$qty_per_box', harga_jual = '$harga_jual'  
          WHERE id = '$id'";

if (update($query) === 1) {
  echo "<script>alert('Data Berhasil Diubah');</script>";
  echo '<script>document.location.href="../../../?page=obat";</script>';
} else {
  echo "<script>alert('Data Gagal Diubah');</script>";
  echo mysqli_error($conn);
}




?>
