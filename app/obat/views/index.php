<?php
require_once 'app/functions/MY_model.php';
$tb_obat = get("SELECT o.*, s.nama_distributor, k.nama_kategori, st.nama_satuan
            FROM tb_obat o 
            INNER JOIN tb_distributor s ON o.distributor_id = s.id
            INNER JOIN tb_kategori k ON o.kategori_id = k.id 
            INNER JOIN tb_satuan st ON o.satuan_id = st.id");

$no = 1;

?>

<!-- User Table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Obat</h4>
          <a href="?page=tambah-obat" class="btn btn-primary round waves-effect waves-light">
            Tambah obat
          </a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table class="table table-striped dataex-html5-selectors">
                <thead>
                  <tr>
                    <th width="10px">No</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Distributor</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Tablet/Box</th>
                    <th>Harga Jual</th>
                    <th style="text-align : center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tb_obat as $obat) : ?>
                    <tr>
                      <td><?= $obat['id']; ?></td>
                      <td><?= $obat['kode_obat']; ?></td>
                      <td><?= $obat['nama_obat']; ?></td>
                      <td><?= $obat['nama_distributor']; ?></td>
                      <td><?= $obat['nama_kategori']; ?></td>
                      <td><?= $obat['nama_satuan']; ?></td>
                      <td><?= $obat['tablet_per_box']; ?></td> 
                      <td><?= $obat['harga_jual']; ?></td>
                      <td>
                        <a href="?page=edit-obat&id=<?= $obat['id']; ?>"><i class="m-1 feather icon-edit-2"></i></a>
                        <a href="?page=hapus-obat&id=<?= $obat['id']; ?>" class="btn-hapus"><i class="feather icon-trash"></i></a>
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
<?php $title = 'obat'; ?>