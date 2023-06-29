<?php

session_start();
require_once '../../functions/MY_model.php';

// Mendapatkan data pembelian dari form
$no_faktur = $_POST['no_faktur'];
$tgl_pembelian = $_POST['tgl_pembelian'];
$tgl_jatuh_tempo = $_POST['tgl_jatuh_tempo'];
$total_harga = $_POST['total_harga'];
$total_bayar = $_POST['total_bayar'];
$sisa_bayar = $_POST['sisa_bayar'];
$status = $_POST['status'];
$distributor = $_POST['distributor'];
$karyawan = $_POST['karyawan'];

// Query untuk insert data pembelian
$query_pembelian = "INSERT INTO tb_pembelian (no_faktur, tgl_pembelian, tgl_jatuh_tempo, total_harga,
                      total_bayar, sisa_bayar, status, distributor_id, karyawan_id)
                    VALUES ('$no_faktur', '$tgl_pembelian', '$tgl_jatuh_tempo', '$total_harga', '$total_bayar', 
                    '$sisa_bayar', '$status', '$distributor', '$karyawan')";

// Eksekusi query pembelian
$result_pembelian = mysqli_query($conn, $query_pembelian);

if ($result_pembelian) {
  // Mengambil ID pembelian terakhir yang di-generate oleh database
  $pembelian_id = mysqli_insert_id($conn);

  // Mendapatkan data obat dari form
  $obat = $_POST['obat'];

  // Loop melalui setiap obat
  foreach ($obat as $item) {
    $obat_id = $item['id'];
    $batch = $item['batch'];
    $exp = $item['exp'];
    $qty = $item['qty'];
    $satuan_id = $item['satuan'];
    $harga = $item['harga'];
    $diskon = $item['diskon'];
    $potongan = $item['potongan'];
    $bayar = $item['bayar'];

    // Query untuk insert data batch
    $query_batch = "INSERT INTO tb_batch (obat_id, no_batch, tgl_exp, satuan_id)
                    VALUES ('$obat_id', '$batch', '$exp', '$satuan_id')";

    // Eksekusi query batch
    $result_batch = mysqli_query($conn, $query_batch);

    if ($result_batch) {
      // Mengambil ID batch terakhir yang di-generate oleh database
      $batch_id = mysqli_insert_id($conn);

      // Query untuk insert detail pembelian
      $query_det_pembelian = "INSERT INTO tb_det_pembelian (pembelian_id, batch_id, obat_id, qty, satuan_id, harga, diskon, potongan, bayar)
                              VALUES ('$pembelian_id', '$batch_id', '$obat_id', '$qty', '$satuan_id', '$harga', '$diskon', '$potongan', '$bayar')";

      // Eksekusi query detail pembelian
      $result_det_pembelian = mysqli_query($conn, $query_det_pembelian);

      if ($result_det_pembelian) {
        // Mengambil ID detail pembelian terakhir yang di-generate oleh database
        $det_pembelian_id = mysqli_insert_id($conn);

        // Menghitung jumlah_masuk dan stok_akhir
        $jumlah_masuk = $qty;
        $jumlah_keluar = 0;

        // Periksa apakah ada data stok yang sudah ada untuk obat dan batch yang bersangkutan
        $query_check_stok = "SELECT * FROM tb_stok WHERE obat_id = '$obat_id' AND batch_id = '$batch_id'";
        $result_check_stok = mysqli_query($conn, $query_check_stok);

        if (mysqli_num_rows($result_check_stok) > 0) {
          // Jika data stok sudah ada, update data stok
          $row_stok = mysqli_fetch_assoc($result_check_stok);
          $stok_id = $row_stok['id'];
          $stok_akhir = $row_stok['stok_akhir'];

          $jumlah_masuk += $row_stok['jumlah_masuk'];
          $stok_akhir += $jumlah_masuk;

          // Update data stok
          $query_update_stok = "UPDATE tb_stok SET jumlah_masuk = '$jumlah_masuk', stok_akhir = '$stok_akhir'
                                WHERE id = '$stok_id'";
          $result_update_stok = mysqli_query($conn, $query_update_stok);

          if (!$result_update_stok) {
            // Jika terjadi kesalahan dalam query update stok, hapus data yang sudah diinsert sebelumnya
            mysqli_query($conn, "DELETE FROM tb_det_pembelian WHERE id = '$det_pembelian_id'");
            mysqli_query($conn, "DELETE FROM tb_batch WHERE id = '$batch_id'");

            $_SESSION['message'] = "Gagal menyimpan data pembelian.";
            header('Location: ../../../?page=pembelian');
            exit();
          }
        } else {
          // Jika data stok belum ada, insert data stok baru
          $stok_akhir = $jumlah_masuk;

          $query_insert_stok = "INSERT INTO tb_stok (obat_id, batch_id, tanggal, jumlah_masuk, jumlah_keluar, stok_akhir)
                                VALUES ('$obat_id', '$batch_id', '$tgl_pembelian', '$jumlah_masuk', '$jumlah_keluar', '$stok_akhir')";
          $result_insert_stok = mysqli_query($conn, $query_insert_stok);

          if (!$result_insert_stok) {
            // Jika terjadi kesalahan dalam query insert stok, hapus data yang sudah diinsert sebelumnya
            mysqli_query($conn, "DELETE FROM tb_det_pembelian WHERE id = '$det_pembelian_id'");
            mysqli_query($conn, "DELETE FROM tb_batch WHERE id = '$batch_id'");

            $_SESSION['message'] = "Gagal menyimpan data pembelian.";
            header('Location: ../../../?page=pembelian');
            exit();
          }
        }
      } else {
        // Jika terjadi kesalahan dalam query detail pembelian, hapus data batch yang sudah diinsert sebelumnya
        mysqli_query($conn, "DELETE FROM tb_batch WHERE id = '$batch_id'");

        $_SESSION['message'] = "Gagal menyimpan data pembelian.";
        header('Location: ../../../?page=pembelian');
        exit();
      }
    } else {
      $_SESSION['message'] = "Gagal menyimpan data pembelian.";
      header('Location: ../../../?page=pembelian');
      exit();
    }
  }

  $_SESSION['message'] = "Data pembelian berhasil disimpan.";
  header('Location: ../../../?page=pembelian');
  exit();
} else {
  $_SESSION['message'] = "Gagal menyimpan data pembelian.";
  header('Location: ../../../?page=pembelian');
  exit();
}
?>