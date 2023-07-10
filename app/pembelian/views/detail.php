<?php
require_once 'app/functions/MY_model.php';

// Ambil pembelian_id dari parameter URL
$id = $_GET["id"];

$query = "SELECT dpb.*, s.nama_satuan, o.nama_obat, b.no_batch
            FROM tb_det_pembelian dpb
            INNER JOIN tb_pembelian pb ON dpb.pembelian_id = pb.id
            INNER JOIN tb_obat o ON dpb.obat_id = o.id
            INNER JOIN tb_batch b ON dpb.batch_id = b.id
            INNER JOIN tb_satuan s ON dpb.satuan_id = s.id
            WHERE pb.id = '$id'";

$result = mysqli_query($conn, $query);



$no = 1;
?>

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
            <h6><u>DATA PEMBELIAN</u></h6>
          </center>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th width="100px" height="">Nama Obat</th>
                  <th>Nomor Batch</th>
                  <th>Qty</th>
                  <th>satuan</th>
                  <th>Harga</th>
                  <th>Diskon</th>
                  <th>Potongan</th>
                </tr>
              </thead>
              <?php
              $no = 1;
              while ($dpb = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $dpb['nama_obat']; ?></td>
                  <td><?= $dpb['no_batch']; ?></td>
                  <td><?= $dpb['qty']; ?></td>
                  <td><?= $dpb['nama_satuan']; ?></td>
                  <td><?= $dpb['harga']; ?></td>
                  <td><?= $dpb['diskon']; ?></td>
                  <td><?= $dpb['potongan']; ?></td>
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
