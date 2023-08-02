<?php
require_once 'app/functions/MY_model.php';

// Ambil daftar supplier dari database
$tb_distributor = get("SELECT * FROM tb_distributor");

// Ambil daftar kategori dari database
$tb_kategori = get("SELECT * FROM tb_kategori");

// Ambil daftar satuan dari database
$tb_satuan = get("SELECT * FROM tb_satuan");



?>

<div class="content-header row">
  <div class="content-header-right col-md-12">
    <a href="?page=obat" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>

<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tambah Obat</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="app/obat/proses/create.php" method="post">
              <div class="form-body"> 
                <div class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Kode Obat</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Masukkan Kode Obat" class="form-control" name="kode_obat" required>
                      </div>
                    </div>
                  </div>


                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Nama Obat</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Masukkan Nama Obat" class="form-control" name="nama_obat" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Distributor</label>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control" name="distributor" required>
                          <?php foreach ($tb_distributor as $distributor) : ?>
                            <?php $selected = ($distributor['id'] == $selectedDistributor) ? 'selected' : ''; ?>
                            <option value="<?php echo $distributor['id']; ?>" <?php echo $selected; ?>><?php echo $distributor['nama_distributor']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Kategori</label>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control" name="kategori" required>
                          <?php foreach ($tb_kategori as $kategori) : ?>
                            <option value="<?php echo $kategori['id']; ?>"><?php echo $kategori['nama_kategori']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Satuan</label>
                      </div>
                      <div class="col-md-8">
                        <select class="form-control" name="satuan" required>
                          <?php foreach ($tb_satuan as $satuan) : ?>
                            <option value="<?php echo $satuan['id']; ?>"><?php echo $satuan['nama_satuan']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Qty/Box</label> 
                      </div>
                      <div class="col-md-8">
                        <input type="number" placeholder="Masukan Tablet/Box" class="form-control" name="qty_per_box" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Harga Jual</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Masukkan Harga Jual" class="form-control" name="harga_jual" required>
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
                    <a href="?page=obat" class="btn btn-primary btn-sm">
                      <span>
                        <i class="feather icon-x"></i>
                      </span>
                      <span class="text">Batal</span>
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
