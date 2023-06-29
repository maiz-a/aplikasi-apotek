<div class="content-header row">

  <div class="content-header-right col-md-12">
    <a href="?page=supplier" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>
<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tambah Supplier</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="app/obat/proses/create.php" method="post">
              <div class="form-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Kode Supplier </label>
                      </div>
                      <div class="col-md-8">
                        <input type="text"  class="form-control"  value="<?= $execute->kode+1 ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Nama Supplier</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="nama supplier" class="form-control" name="nama_supplier" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Lokasi</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="lokasi" class="form-control" name="lokasi" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Telepon</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="telepon" class="form-control" name="telepon" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Email</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="email" class="form-control" name="email" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Alamat Supplier</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="alamat supplier" class="form-control" name="alamat_supplier" required>
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
                    <a href="?page=supplier" class="btn btn-primary btn-sm">
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