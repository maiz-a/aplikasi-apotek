<?php
require_once 'app/functions/MY_model.php';
$id = $_GET['id'];
$tb_pembelian = get_where("SELECT p.*, d.nama_distributor, u.nama_karyawan
            FROM tb_pembelian p
            INNER JOIN tb_distributor d ON p.distributor_id = d.id 
            INNER JOIN tb_karyawan u ON p.karyawan_id = u.id
            WHERE p.id = '$id'");
          
?>

<div class="content-header row">

  <div class="content-header-right col-md-12">
    <a href="?page=pembelian" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>
<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Pembelian</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <form action="app/pembelian/proses/update.php" method="post">
              <input type="hidden" name="id" value="<?= $pembelian['id']; ?>">
              <div class="form-body">
                <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>No. Faktur </label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="No. Faktur" class="form-control" name="no_faktur" value="<?= $pembelian['no_faktur']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tanggal Pembelian</label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" placeholder="Tanggal Pembelian" class="form-control" name="tgl_pembelian" value="<?= $pembelian['tgl_pembelian']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tanggal Jatuh Tempo</label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" placeholder="Tanggal Jatuh Tempo" class="form-control" name="tgl_jatuh_tempo" value="<?= $pembelian['tgl_jatuh_tempo']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Status</label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" placeholder="Status" class="form-control" name="status" value="<?= $pembelian['status']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Total Bayar</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Total Bayar" class="form-control" name="total_bayar" value="<?= $pembelian['total_bayar']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Bayar</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="bayar" class="form-control" name="bayar" value="<?= $pembelian['bayar']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Sisa</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="sisa" class="form-control" name="sisa" value="<?= $pembelian['sisa']; ?>">
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
                    $tb_distributor = get("SELECT * FROM distributor");

                    // Loop melalui setiap satuan
                    foreach ($tb_distributor as $distributor) {
                      // Cek apakah distributor saat ini adalah user yang dipilih
                      $selected = ($distributor['id'] == $pembelian['distributor_id']) ? 'selected' : '';

                      // Tampilkan pilihan dalam elemen select
                      echo '<option value="' . $distributor['id'] . '"' . $selected . '>' . $satuan['nama_distributor'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                  <label>Karyawan</label>
                </div>
                <div class="col-md-8">
                  <select class="form-control" name="distributor">
                    <?php
                    // Ambil daftar karyawan dari database
                    $tb_karyawan = get("SELECT * FROM tb_karyawan");

                    // Loop melalui setiap karyawan
                    foreach ($tb_karyawan as $karyawan) {
                      // Cek apakah karyawan saat ini adalah distributor yang dipilih
                      $selected = ($karyawan['id'] == $pembelian['karyawan_id']) ? 'selected' : '';

                      // Tampilkan pilihan dalam elemen select
                      echo '<option value="' . $karyawan['id'] . '"' . $selected . '>' . $karyawan['nama_karyawan'] . '</option>';
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
                    <a href="?page=pembelian" class="btn btn-primary btn-sm">
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