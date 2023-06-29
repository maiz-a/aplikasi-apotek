<?php
require_once 'app/functions/MY_model.php';
$tb_distributor = get("SELECT d.* FROM tb_distributor d
            ");

$no = 1;

?>

<!-- User Table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Distributor</h4>
          <a href="?page=tambah-distributor" class="btn btn-primary round waves-effect waves-light">
            Tambah distributor
          </a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table class="table table-striped dataex-html5-selectors">
                <thead>
                  <tr>
                  <th width="10px">No</th>
                  <th>Nama Distributor</th>
                  <th>Alamat Distributor</th>
                  <th>Telepon</th>
                  <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tb_distributor as $distributor) : ?>
                    <tr>
                      <td><?= $distributor['id']; ?></td>
                      <td><?= $distributor['nama_distributor']; ?></td>
                      <td><?= $distributor['alamat_distributor']; ?></td>
                      <td><?= $distributor['telepon_distributor']; ?></td>
                      <td>
                        <a href="?page=edit-distributor&id=<?= $distributor['id']; ?>"><i class="m-1 feather icon-edit-2"></i></a>
                        <a href="?page=hapus-distributor&id=<?= $distributor['id']; ?>" class="btn-hapus"><i class="feather icon-trash"></i></a>
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
<?php $title = 'distributor'; ?>