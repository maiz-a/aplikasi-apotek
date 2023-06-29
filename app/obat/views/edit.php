<?php
require_once 'app/functions/MY_model.php';

$id = $_GET['id'];
$obat = get_where("SELECT o.*, s.nama_distributor, k.nama_kategori, st.nama_satuan
            FROM tb_obat o 
            INNER JOIN tb_distributor s ON o.distributor_id = s.id
            INNER JOIN tb_kategori k ON o.kategori_id = k.id 
            INNER JOIN tb_satuan st ON o.satuan_id = st.id
            WHERE o.id = '$id'");

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
          <h4 class="card-title">Edit Obat</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="app/obat/proses/update.php" method="post">
              <input type="hidden" name="id" value="<?= $obat['id']; ?>">
              <div class="form-body">
                <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                    <label>Kode Obat</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" placeholder="Kode Obat" class="form-control" name="kode_obat" value="<?= $obat['kode_obat']; ?>">
                  </div>
                </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                    <label>Merk Obat</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" placeholder="Merk Obat" class="form-control" name="merk_obat" value="<?= $obat['merk_obat']; ?>">
                  </div>
                </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                    <label>Nama Obat</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" placeholder="Nama Obat" class="form-control" name="nama_obat" value="<?= $obat['nama_obat']; ?>">
                  </div>
                </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                  <label>Distributor</label>
                </div>
                <div class="col-md-8">
                  <select class="form-control" name="distributor">
                    <?php
                    // Ambil daftar distributor dari database
                    $tb_distributor = get("SELECT * FROM tb_distributor");

                    // Loop melalui setiap distributor
                    foreach ($tb_distributor as $distributor) {
                      // Cek apakah distributor saat ini adalah supplier yang dipilih
                      $selected = ($distributor['id'] == $obat['distributor_id']) ? 'selected' : '';

                      // Tampilkan pilihan dalam elemen select
                      echo '<option value="' . $distributor['id'] . '"' . $selected . '>' . $distributor['nama_distributor'] . '</option>';
                    }
                    ?>
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
                <select class="form-control" name="kategori">
                  <?php
                  // Ambil daftar kategori dari database
                  $tb_kategori= get("SELECT * FROM tb_kategori");

                  // Loop melalui setiap kategori
                  foreach ($tb_kategori as $kategori) {
                    // Cek apakah kategori saat ini adalah kategori yang dipilih
                    $selected = ($kategori['id'] == $obat['kategori_id']) ? 'selected' : '';

                    // Tampilkan pilihan dalam elemen select
                    echo '<option value="' . $kategori['id'] . '"' . $selected . '>' . $kategori['nama_kategori'] . '</option>';
                  }
                  ?>
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
                <select class="form-control" name="satuan">
                  <?php
                  // Ambil daftar satuan dari database
                  $tb_satuan = get("SELECT * FROM tb_satuan");

                  // Loop melalui setiap kategori
                  foreach ($tb_satuan as $satuan) {
                    // Cek apakah satuan saat ini adalah kategori yang dipilih
                    $selected = ($satuan['id'] == $obat['satuan_id']) ? 'selected' : '';

                    // Tampilkan pilihan dalam elemen select
                    echo '<option value="' . $satuan['id'] . '"' . $selected . '>' . $satuan['nama_satuan'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            </div>

            <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                    <label>Harga Beli</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" placeholder="Harga Beli" class="form-control" name="harga_beli" value="<?= $obat['harga_beli']; ?>">
                  </div>
                </div>
                </div>

                <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                    <label>Harga Jual</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" placeholder="Harga Jual" class="form-control" name="harga_jual" value="<?= $obat['harga_jual']; ?>">
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
