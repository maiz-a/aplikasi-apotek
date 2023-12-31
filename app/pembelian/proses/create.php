<?php
session_start();
require_once '../../functions/MY_model.php';

// Mendapatkan data pembelian dari form
$no_faktur = $_POST['no_faktur'];
$tgl_pembelian = $_POST['tgl_pembelian'];
$tgl_jatuh_tempo = $_POST['tgl_jatuh_tempo'];
$total_tagihan = $_POST['total_tagihan'];
$total_bayar = $_POST['total_bayar'];
$sisa_bayar = $_POST['sisa_bayar'];
$status = $_POST['status'];
$ppn = $_POST['ppn'];
$distributor = $_POST['distributor'];
$user = $_POST['user'];

// Query untuk insert data pembelian
$query_pembelian = "INSERT INTO tb_pembelian (no_faktur, tgl_pembelian, tgl_jatuh_tempo, ppn, total_tagihan,
                      total_bayar, sisa_bayar, status, distributor_id, user_id)
                    VALUES ('$no_faktur', '$tgl_pembelian', '$tgl_jatuh_tempo', '$total_tagihan', '$total_bayar', 
                    '$sisa_bayar', '$ppn', '$status', '$distributor', '$user')";

// Eksekusi query pembelian
$result_pembelian = mysqli_query($conn, $query_pembelian);

if ($result_pembelian) {
  // Mengambil ID pembelian terakhir yang di-generate oleh database
  $pembelian_id = mysqli_insert_id($conn);

  
  // Mendapatkan data obat dari form
  $obat = $_POST['obat'];

  // Loop melalui setiap obat
  foreach ($_POST['obat'] as $item) {
    $obat_id = $item['id'];
    $batch = $item['batch'];
    $exp = $item['exp'];
    $qty = $item['qty'];
    $satuan_id = $item['satuan'];
    $harga = $item['harga'];
    $diskon = $item['diskon'];
    $potongan = $item['potongan'];
    $total_harga = $item['total_harga'];

    
     // Mengambil qty_per_box dari tb_obat
     $query_qty_per_box = "SELECT qty_per_box FROM tb_obat WHERE id = '$obat_id'";
     $result_qty_per_box = mysqli_query($conn, $query_qty_per_box);
 
     if ($row_qty_per_box = mysqli_fetch_assoc($result_qty_per_box)) {
         $qty_per_box = $row_qty_per_box['qty_per_box'];
         $qty_tablet = $qty * $qty_per_box;
     } else {
         // Jika gagal mendapatkan qty_per_box, lanjutkan ke obat berikutnya
         continue;
     }

    // Query untuk cek batch yang sudah ada
    $query_check_batch = "SELECT * FROM tb_batch WHERE no_batch = '$batch'";
    $result_check_batch = mysqli_query($conn, $query_check_batch);

    if (mysqli_num_rows($result_check_batch) > 0) {
      // Jika batch sudah ada, ambil ID batch yang sudah ada
      $row_batch = mysqli_fetch_assoc($result_check_batch);
      $batch_id = $row_batch['id'];
    } else {
      // Jika batch belum ada, insert data batch baru
      $query_insert_batch = "INSERT INTO tb_batch (obat_id, no_batch, tgl_exp, satuan_id)
                            VALUES ('$obat_id', '$batch', '$exp', '$satuan_id')";
      $result_insert_batch = mysqli_query($conn, $query_insert_batch);

      if (!$result_insert_batch) {
        // Jika terjadi kesalahan dalam query insert batch, lanjutkan ke obat berikutnya
        $error_message = mysqli_error($conn);
      $_SESSION['message'] = "Gagal menyimpan data pembelian.";
      header('Location: ../../../?page=pembelian');
      }

      // Mengambil ID batch terakhir yang di-generate oleh database
      $batch_id = mysqli_insert_id($conn);
    }

    // Query untuk cek stok yang sudah ada
    $query_check_stok = "SELECT * FROM tb_stok WHERE obat_id = '$obat_id' AND batch_id = '$batch_id'";
    $result_check_stok = mysqli_query($conn, $query_check_stok);

    if (mysqli_num_rows($result_check_stok) > 0) {
      // Jika stok sudah ada, insert tanggal pembelian dan stok akhir yang sesuai
      $row_stok = mysqli_fetch_assoc($result_check_stok);
      $stok_id = $row_stok['id'];
      $stok_akhir = $row_stok['stok_akhir'] + $qty_tablet;

      $query_insert_stok = "INSERT INTO tb_stok (obat_id, batch_id, tanggal_update, jumlah_masuk, jumlah_keluar, stok_akhir)
                          VALUES ('$obat_id', '$batch_id', '$tgl_pembelian', '$qty_tablet', '0', '$stok_akhir')";
      $result_insert_stok = mysqli_query($conn, $query_insert_stok);

      if (!$result_insert_stok) {
        // Jika terjadi kesalahan dalam query insert stok, lanjutkan ke obat berikutnya
        $error_message = mysqli_error($conn);
      $_SESSION['message'] = "Gagal menyimpan data pembelian.";
      header('Location: ../../../?page=pembelian');
      }
    } else {
      // Jika stok belum ada, insert data stok baru
      $jumlah_masuk = $qty_tablet;
      $jumlah_keluar = 0;
      $stok_akhir = $jumlah_masuk;

      $query_insert_stok = "INSERT INTO tb_stok (obat_id, batch_id, tanggal_update, jumlah_masuk, jumlah_keluar, stok_akhir)
                          VALUES ('$obat_id', '$batch_id', '$tgl_pembelian', '$jumlah_masuk', '$jumlah_keluar', '$stok_akhir')";
      $result_insert_stok = mysqli_query($conn, $query_insert_stok);

      if (!$result_insert_stok) {
        // Jika terjadi kesalahan dalam query insert stok, lanjutkan ke obat berikutnya
        $error_message = mysqli_error($conn);
      $_SESSION['message'] = "Gagal menyimpan data pembelian.";
      header('Location: ../../../?page=pembelian');
      }
    }

    // Mendapatkan ID stok terakhir yang di-generate oleh database
    $stok_id = mysqli_insert_id($conn);

    // Query untuk insert detail pembelian
    $query = "INSERT INTO tb_det_pembelian (pembelian_id, batch_id, obat_id, stok_id, qty, qty_tablet, satuan_id, harga, diskon, potongan, total_harga)
    VALUES ('$pembelian_id', '$batch_id', '$obat_id', '$stok_id', '$qty', '$qty_tablet', '$satuan_id', '$harga', '$diskon', '$potongan','$total_harga')";
  }
  
}
   
if (create($query) === 1) {
  echo "<script>alert('Data Berhasil Disimpan');</script>";
  echo '<script>document.location.href="../../../?page=pembelian";</script>';
} else {
  echo "<script>alert('Data Gagal Disimpan');</script>";
  echo mysqli_error($conn);
}
?>