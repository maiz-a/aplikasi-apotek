<?php
require_once 'app/functions/MY_model.php';

// Ambil pembelian_id dari parameter URL
$id = $_GET["id"];

$query = "SELECT dpj.*, o.nama_obat, b.no_batch, pj.total_harga, pj.total_bayar, pj.kembali
            FROM tb_det_penjualan dpj
            INNER JOIN tb_penjualan pj ON dpj.penjualan_id = pj.id
            INNER JOIN tb_obat o ON dpj.obat_id = o.id
            INNER JOIN tb_batch b ON dpj.batch_id = b.id
            WHERE pj.id = '$id'";

$result = mysqli_query($conn, $query);


$no = 1;
?>

<div class="content-header row">
  <div class="content-header-right col-md-12">
    <a href="?page=penjualan" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="about-row row">
        <div class="col-md-12">
          <table class="table table-borderless">
            <tr>
              <td class="text-center">
                <h5>APOTEK SYIFA</h5>
              </td>
            </tr>
          </table>
          <center>
            <h6><u>DATA PENJUALAN</u></h6>
          </center>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th width="100px" height="">Nama Obat</th>
                  <th>Nomor Batch</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total Harga</th>
                  <th>Total Bayar</th>
                  <th>Kembali</th>
                </tr>
              </thead>
              <?php
              $no = 1;
              while ($dpj = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $dpj['nama_obat']; ?></td>
                  <td><?= $dpj['no_batch']; ?></td>
                  <td><?= $dpj['qty_tablet']; ?></td>
                  <td><?= $dpj['harga']; ?></td>
                  <td><?= $dpj['total_harga']; ?></td>
                  <td><?= $dpj['total_bayar']; ?></td>
                  <td><?= $dpj['kembali']; ?></td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
