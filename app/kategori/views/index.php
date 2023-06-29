<?php
require_once 'app/functions/MY_model.php';
$kategoris = get("SELECT * FROM kategoris");

$no = 1;

?>

<div class="row">
  <div class="col-sm-8">
<?php
if (isset($_GET['status'])) {
  $get_stat = $_GET['status'];
  if ($get_stat=='sukses') {
    echo '    <div class="alert alert-success alert-white rounded">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <strong>Success!</strong> 
    </div>';
  
  }elseif ($get_stat=='gagal') {
    echo '    <div class="alert alert-danger alert-white rounded">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <div class="icon">
            <i class="fa fa-times-circle"></i>
        </div>
        <strong>Gagal!</strong> 
        
    </div>    
';
  } 

}?>

<!-- User Table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Kategori</h4>
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
                      <th style="text-align: center">Kode</th>
                      <th style="text-align: center">Nama Kategori</th>
                      <th style="text-align: center" >Aksi</th>
                  </tr>
                </thead>
                <tbody>

                <?php
                  $no=1;
                    $kategori = $connect->query('SELECT * FROM kategoris'); 
                    while ($data = $kategori->fetch_object()) {                   
                    echo "<tr>
                      <td align='center'>$no</td>
                      <td align=center>BP-0$data->kode</td>
                      <td align=center>$data->nama</td>
                      <td align=center>
                        <a href='action/action.php?kode=$data->kode&&act=del-kategori' class='btn btn-danger btn-sm'><span class='fa fa-trash'> hapus</span></a>
                        <a href='?p=kategori&&kode=$data->kode' class='btn btn-primary btn-sm'><span class='fa fa-edit'> ubah</span></button>
                      </td>
                    </tr>";
                    $no++;
                  } ?>

                  <?php foreach ($kategoris as $kategori) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $kategori['nama_kategori']; ?></td>
                      <td><?= $kategori['aksi']; ?></td>
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