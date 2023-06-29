<?php
require_once 'app/functions/MY_model.php';

$id = $_GET['id'];
$pasien = get_where("SELECT * FROM pasiens WHERE id = '$id' ");

?>
<div class="content-header row">

  <div class="content-header-right col-md-12">
    <a href="?page=profil" class="btn btn-light float-right mb-2">Kembali</a>
  </div>
</div>
<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Profil</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
          <form action="app/profile/proses/update.php" method="post">
              <input type="hidden" name="id" value="<?= $pasien['id']; ?>">
              <div class="form-body">
                <div class="row">

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Nama </label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Nama Pasien" class="form-control" name="nama_pasien" value="<?= $pasien['nama_pasien']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tempat Lahir </label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Tempat Lahir" class="form-control" name="tempat_lhr_pasien" value="<?= $pasien['tempat_lhr_pasien']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Tanggal Lagir </label>
                      </div>
                      <div class="col-md-8">
                        <input type="date" placeholder="Tanggal Lahir" class="form-control" name="tgl_lhr_pasien" value="<?= $pasien['tgl_lhr_pasien']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Nomor Hp</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" placeholder="Nomor Hp" class="form-control" name="no_hp_pasien" value="<?= $pasien['no_hp_pasien']; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Alamat</label>
                      </div>
                      <div class="col-md-8">
                        <textarea class="form-control" id="basicTextarea" rows="3" placeholder="Alamat" name="alamat_pasien"><?= $pasien['alamat_pasien']; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group row">
                      <div class="col-md-4">
                        <label>Jenis Kelamin</label>
                      </div>
                      <div class="col-md-8">
                        <ul class="list-unstyled mb-0">
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input type="radio" <?= ($pasien['jk_pasien'] == 'l' ? 'checked' : ''); ?> name="jk_pasien" value="l">
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">Laki-laki</span>
                              </div>
                            </fieldset>
                          </li>
                          <li class="d-inline-block mr-2">
                            <fieldset>
                              <div class="vs-radio-con">
                                <input type="radio" name="jk_pasien" <?= ($pasien['jk_pasien'] == 'p' ? 'checked' : ''); ?> value="p">
                                <span class="vs-radio">
                                  <span class="vs-radio--border"></span>
                                  <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">Perempuan</span>
                              </div>
                            </fieldset>
                          </li>
                        </ul>
                      </div>

                    </div>
                  </div>

                  <div class="col-md-8 offset-md-4">
                    <button type="submit" name="save" class="btn btn-primary" >Save</button>
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