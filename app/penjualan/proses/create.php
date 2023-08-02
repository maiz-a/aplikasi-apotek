<?php

session_start();
require_once '../../functions/MY_model.php';


// Mendapatkan data penjualan dari form
$no_struk = $_POST['no_struk'];
$tgl_penjualan = $_POST['tgl_penjualan'];
$total_harga = $_POST['total_harga'];
$total_bayar = $_POST['total_bayar'];
$kembali = $_POST['kembali'];
$user = $_POST['user'];

// Query untuk insert data penjualan
$query_penjualan = "INSERT INTO tb_penjualan (no_struk, tgl_penjualan, total_harga,
                      total_bayar, kembali, user_id)
                    VALUES ('$no_struk', '$tgl_penjualan', '$total_harga', '$total_bayar', 
                    '$kembali', '$user')";

// Eksekusi query penjualan
$result_penjualan = mysqli_query($conn, $query_penjualan);

if ($result_penjualan) {
  // Mengambil ID penjualan terakhir yang di-generate oleh database
  $penjualan_id = mysqli_insert_id($conn);

  // Mendapatkan data obat dari form
  $obat = $_POST['obat'];

  // Loop melalui setiap obat
  foreach ($_POST['obat'] as $item){
    $obat_id = $item['id'];
    $batch_id = $item['no_batch'];
    $qty_tablet = $item['qty_tablet'];
    $satuan_id = $item['satuan'];
    $harga = $item['harga'];


    // Query untuk cek stok yang sudah ada
    $query_check_stok = "SELECT * FROM tb_stok WHERE obat_id = '$obat_id' AND batch_id = '$batch_id'";
    $result_check_stok = mysqli_query($conn, $query_check_stok);

    if (mysqli_num_rows($result_check_stok) > 0) {
      // Jika stok tersedia kurangi dan insert tanggal penjualan dan stok akhir yang sesuai
      $row_stok = mysqli_fetch_assoc($result_check_stok);
      $stok_id = $row_stok['id'];
      $stok_akhir = $row_stok['stok_akhir'] - $qty_tablet;

      $query_insert_stok = "INSERT INTO tb_stok (obat_id, batch_id, tanggal_update, jumlah_masuk, jumlah_keluar, stok_akhir)
                          VALUES ('$obat_id', '$batch_id', '$tgl_penjualan', '0', '$qty_tablet', '$stok_akhir')";
      $result_insert_stok = mysqli_query($conn, $query_insert_stok);

      if (!$result_insert_stok) {
        // Jika terjadi kesalahan dalam query insert stok, lanjutkan ke obat berikutnya
        $_SESSION['message'] = "Gagal memperbarui stok.";
        header('Location: ../../../?page=penjualan');
        exit();
          }
    } else {
        // Jika stok tidak tersedia, lanjutkan ke obat berikutnya
        continue;
    }

    // Mendapatkan ID stok terakhir yang di-generate oleh database
    $stok_id = mysqli_insert_id($conn);

    // Query untuk insert detail penjualan
    $query = "INSERT INTO tb_det_penjualan (penjualan_id, batch_id, obat_id, stok_id, qty_tablet, satuan_id, harga)
    VALUES ('$penjualan_id', '$batch_id', '$obat_id',  '$stok_id', '$qty_tablet', '$satuan_id', '$harga')";

  }
}

if (create($query) === 1) {
  echo "<script>alert('Data Berhasil Disimpan');</script>";
  echo '<script>document.location.href="../../../?page=penjualan";</script>';
} else {
  echo "<script>alert('Data Gagal Disimpan');</script>";
  echo mysqli_error($conn);
}
  

 
?>