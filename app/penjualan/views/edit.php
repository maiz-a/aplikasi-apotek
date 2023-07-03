<?php
require_once 'app/functions/MY_model.php';

$id = $_GET['id'];
$tb_penjualan = get_where("SELECT pj.*, k.nama_karyawan
            FROM tb_penjualan pj
            INNER JOIN tb_karyawan k ON pj.karyawan_id = k.id
            WHERE pj.id = '$id'");

// Ambil daftar karyawan dari database
$tb_karyawan = get("SELECT * FROM tb_karyawan");

?>

<div class="content-header row">
  <div class="content-header-right col-md-12">
    <a href="?page=penjualan" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>

<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tambah Penjualan</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="app/penjualan/proses/update.php" method="post">
              <div class="form-body">
                <class="row">
                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>No. Struk </label>
                      </div>
                      <div class="col-md-8">
                        <input type="text"  class="form-control" name="no_struk" value="<?= $tb_penjualan['no_struk']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tanggal Penjualan</label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" class="form-control" name="tgl_penjualan"  value="<?= $tb_penjualan['tgl_penjualan']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Total Harga</label>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="total_harga" value="<?= $tb_penjualan['total_harga']; ?>">
                        </div>
                      </div>
                      </div>

                      <div class="col-12">
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Total Bayar</label>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="total_bayar" value="<?= $tb_penjualan['total_harga']; ?>">
                        </div>
                      </div>
                      </div>

                      <div class="col-12">
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Sisa Kembalian</label>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="kembali" value="<?= $tb_penjualan['kembali']; ?>">
                        </div>
                      </div>
                      </div>

              <div class="col-12">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Karyawan</label>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control" name="karyawan" >
                      <?php foreach ($tb_karyawan as $karyawan) : ?>
                        <option value="<?php echo $karyawan['id']; ?>"><?php echo $karyawan['nama_karyawan']; ?></option>
                      <?php endforeach; ?>
                    </select>
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
                    <a href="?page=penjualan" class="btn btn-primary btn-sm">
                      <span>
                        <i class="feather icon-x"></i>
                      </span>
                      <span class="text">Batal</span>
                    </a>
                  </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>