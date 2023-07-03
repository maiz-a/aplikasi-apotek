<?php
require_once 'app/functions/MY_model.php';

$tb_penjualan = get("SELECT pj.* , k.nama_karyawan
            FROM tb_penjualan pj
            INNER JOIN tb_karyawan k ON pj.karyawan_id = k.id");

$no = 1;

?>


<!-- User Table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Transaksi Penjualan</h4>
          <a href="?page=tambah-penjualan" class="btn btn-primary round waves-effect waves-light">
            Tambah data
          </a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table class="table table-striped dataex-html5-selectors">
                <thead>
                <tr>
                    <th width="100px" height="">No. Struk</th>
                    <th>Tanggal Penjualan </th>
                    <th>Total Harga</th>
                    <th>Total Bayar</th>
                    <th>Kembali</th>
                    <th style="text-align : center">Karyawan</th>
                    <th style="text-align : center" width="80px">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                  <?php foreach ($tb_penjualan as $penjualan) : ?>
                    <tr>
                      <td><?= $penjualan['no_struk']; ?></td>
                      <td><?= $penjualan['tgl_penjualan']; ?></td>
                      <td><?= $penjualan['total_harga']; ?></td>
                      <td><?= $penjualan['total_bayar']; ?></td>
                      <td><?= $penjualan['kembali']; ?></td>
                      <td><?= $penjualan['nama_karyawan']; ?></td>
                      <td>
                        <a href="?page=edit-penjualan&id=<?= $penjualan['id']; ?>"><i class="m-1 feather icon-edit-2"></i></a>
                        <a href="?page=hapus-penjualan&id=<?= $penjualan['id']; ?>" class="btn-hapus"><i class="feather icon-trash"></i></a>
                        <a href="?page=detail-penjualan&id=<?= $penjualan['id']; ?>" class="btn-detail"><i class="feather icon-info"></i></a>
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
<?php $title = 'penjualan'; ?>