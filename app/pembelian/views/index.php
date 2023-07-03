<?php
require_once 'app/functions/MY_model.php';



$tb_pembelian = get("SELECT pb.*, d.nama_distributor , k.nama_karyawan
            FROM tb_pembelian pb
            INNER JOIN tb_distributor d ON pb.distributor_id = d.id
            INNER JOIN tb_karyawan k ON pb.karyawan_id = k.id");

$no = 1;

?>


<!-- User Table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Transaksi Pembelian</h4>
          <a href="?page=tambah-pembelian" class="btn btn-primary round waves-effect waves-light">
            Tambah data
          </a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table class="table table-striped dataex-html5-selectors">
                <thead>
                <tr>
                    <th width="100px" height="">No. Faktur</th>
                    <th>Tanggal Pembelian</th>
                    <th>Tanggal Jatuh Tempo </th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Bayar</th>
                    <th>Sisa Pembayaran</th>
                    <th>Distributor</th>
                    <th>Karyawan</th>
                    <th style="text-align : center" width="80px">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                  <?php foreach ($tb_pembelian as $pembelian) : ?>
                    <tr>
                      <td><?= $pembelian['no_faktur']; ?></td>
                      <td><?= $pembelian['tgl_pembelian']; ?></td>
                      <td><?= $pembelian['tgl_jatuh_tempo']; ?></td>
                      <td><?= $pembelian['status']; ?></td>
                      <td><?= $pembelian['total_harga']; ?></td>
                      <td><?= $pembelian['total_bayar']; ?></td>
                      <td><?= $pembelian['sisa_bayar']; ?></td>
                      <td><?= $pembelian['nama_distributor']; ?></td>
                      <td><?= $pembelian['nama_karyawan']; ?></td>
                      <td>
                        <a href="?page=edit-pembelian&id=<?= $pembelian['id']; ?>" class="btn-edit"><i class="m-1 feather icon-edit"></i></a>
                        <a href="?page=hapus-pembelian&id=<?= $pembelian['id']; ?>" class="btn-hapus"><i class="m-1 feather icon-trash"></i></a>
                        <a href="?page=detail-pembelian&id=<?= $pembelian['id']; ?>" class="btn-detail"><i class="m-1 feather icon-info"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- User Table -->
<?php $title = 'pembelian'; ?>