<?php
session_start();
require_once '../../functions/MY_model.php';

$id = $_POST['id']; 
$no_faktur = $_POST['no_faktur']; 
$tgl_pembelian = $_POST['tgl_pembelian']; 
$nama_obat = $_POST['obat']; 
$nama_satuan = $_POST['satuan']; 
$jumlah = $_POST['jumlah']; 
$harga = $_POST['harga']; 
$ppn = $_POST['ppn']; 
$total_harga = $_POST['total_harga']; 
$nama_distributor = $_POST['distributor']; 


// Ambil ID obat berdasarkan nama 
$obat = get_where("SELECT id FROM obats WHERE id = '$nama_obat'");
$obat_id = $obat['id'];

// Ambil ID satuan berdasarkan nama user
$satuan = get_where("SELECT id FROM satuans WHERE id = '$nama_satuan'"); 
$satuan_id = $satuan['id'];

// Ambil ID distributor berdasarkan nama user
$distributor = get_where("SELECT id FROM distributors WHERE id = '$nama_distributor'"); 
$distributor_id = $distributor['id'];


$query = "UPDATE pembelians SET no_faktur = '$no_faktur', tgl_pembelian = '$tgl_pembelian', obat_id = '$obat_id', 
          satuan_id = '$satuan_id', jumlah = '$jumlah', harga = '$harga', ppn = '$ppn', total_harga = '$total_harga', distributor_id = '$distributor_id'  
          WHERE id = '$id'";

if (update($query) === 1) {
  echo '<script>document.location.href="../../../?page=pembelian";</script>';
} else {
  echo mysqli_error($conn);
}

?>
