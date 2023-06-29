<?php
require_once 'app/functions/MY_model.php';
$id = $_GET['id'];
$tb_penjualan = get_where("SELECT p.*, u.username
                    FROM tb_penjualan p 
                    INNER JOIN tb_karyawan u ON p.username = u.id         
                    WHERE p.id = '$id'");
            
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
          <h4 class="card-title">Edit Penjualan</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="app/penjualan/proses/update.php" method="post">
              <input type="hidden" name="id" value="<?= $penjualan['id']; ?>">
              <div class="form-body">
                <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>No. Struk </label>
                      </div>
                      <div class="col-md-8">

                        <input type="text" placeholder="No. Struk" class="form-control" name="no_struk" value="<?= $penjualan['no_struk']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tanggal Penjualan</label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" placeholder="Tanggal Penjualan" class="form-control" name="tgl_penjualan" value="<?= $penjualan['tgl_penjualan']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Total Harga</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Total Harga" class="form-control" name="total_harga" value="<?= $penjualan['total_harga']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Total Bayar</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Total Bayar" class="form-control" name="total_bayar" value="<?= $penjualan['total_bayar']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Kembali</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Kembali" class="form-control" name="kembali" value="<?= $penjualan['kembali']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                  <label>Karyawan</label>
                </div>
                <div class="col-md-8">
                  <select class="form-control" name="karyawan">
                    <?php
                    // Ambil daftar karyawan dari database
                    $tb_karyawan = get("SELECT * FROM tb_karyawan");

                    // Loop melalui setiap karyawan
                    foreach ($tb_karyawan as $karyawan) {
                      // Cek apakah karyawan saat ini adalah user yang dipilih
                      $selected = ($karyawan['id'] == $penjualan['karyawan_id']) ? 'selected' : '';

                      // Tampilkan pilihan dalam elemen select
                      echo '<option value="' . $karyawan['id'] . '"' . $selected . '>' . $karyawan['username'] . '</option>';
                    }
                    ?>
                  </select>
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
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>