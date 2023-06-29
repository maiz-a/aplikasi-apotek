<?php
require_once 'app/functions/MY_model.php';
$tb_karyawan = get("SELECT k.* FROM tb_karyawan k ");

$no = 1;

?>

<!-- User Table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Karyawan</h4>
         
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table class="table table-striped dataex-html5-selectors">
                <thead>
                  <tr>
                  <th width="10px">No</th>
                  <th>Nama Karyawan</th>
                  <th>Username</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tb_karyawan as $user) : ?>
                    <tr>
                      <td><?= $user['id']; ?></td>
                      <td><?= $user['nama_karyawan']; ?></td>
                      <td><?= $user['username']; ?></td>
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
<?php $title = 'karyawan'; ?>