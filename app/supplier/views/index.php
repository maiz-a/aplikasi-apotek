<?php
require_once 'app/functions/MY_model.php';
$supplier = get("SELECT * FROM suppliers");

$no = 1;

?>

<!-- User Table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Supplier</h4>
          <a href="?page=tambah-supplier" class="btn btn-primary round waves-effect waves-light">
            Tambah Supplier
          </a>
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table class="table table-striped dataex-html5-selectors">
                <thead>
                  <tr>
                  <th width="10px">No</th>
                  <th>Kode</th>
                  <th>Nama Supplier</th>
                  <th>Lokasi</th>
                  <th>Alamat Supplier</th>
                  <th>Telepon</th>
                  <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($suppliers as $supplier) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $supplier['kode']; ?></td>
                      <td><?= $supplier['nama_supplier']; ?></td>
                      <td><?= $supplier['lokasi']; ?></td>
                      <td><?= $supplier['alamat_supplier']; ?></td>
                      <td><?= $supplier['telepon']; ?></td>
                      <td><?= $supplier['aksi']; ?></td>
                      <td>
                        <a href="?page=edit-supplier&id=<?= $supplier['kode']; ?>"><i class="m-1 feather icon-edit-2"></i></a>
                        <a href="?page=hapus-supplier&id=<?= $supplier['kode']; ?>" class="btn-hapus"><i class="feather icon-trash"></i></a>
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
<?php $title = 'supplier'; ?>