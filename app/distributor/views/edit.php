<?php
require_once 'app/functions/MY_model.php';
$id = $_GET['id'];
$distributor = get_where("SELECT d.* FROM tb_distributor d WHERE d.id = '$id'");

?>
<div class="content-header row">
  <div class="content-header-right col-md-12">
    <a href="?page=distributor" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>

<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Distributor</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="app/distributor/proses/update.php" method="post">
              <input type="hidden" name="id" value="<?= $distributor['id']; ?>">
              <div class="form-body">
              <div class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Nama Distributor</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text"  class="form-control" name="nama_distributor" value="<?= $distributor['nama_distributor']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Alamat Distributor</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text"  class="form-control" name="alamat_distributor" value="<?= $distributor['alamat_distributor']; ?>">
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Telepon</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text"  class="form-control" name="telepon_distributor" value="<?= $distributor['telepon_distributor']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary btn-sm">
                        <span>
                            <i class="feather icon-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="?page=distributor" class="btn btn-primary btn-sm">
                        <span>
                            <i class="feather icon-x"></i>
                        </span>    
                        <span class="text">Batal</span>
                    </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
