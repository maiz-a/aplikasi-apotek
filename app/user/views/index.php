<?php
require_once 'app/functions/MY_model.php';
$tb_user = get("SELECT u.* FROM tb_user u ");

$no = 1;

?>

<!-- User Table -->
<section id="column-selectors">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data User</h4>
         
        </div>
        <div class="card-content">
          <div class="card-body card-dashboard">
            <div class="table-responsive">
              <table class="table table-striped dataex-html5-selectors">
                <thead>
                  <tr>
                  <th width="10px">No</th>
                  <th>Nama Username</th>
                  <th>Username</th>
                  <th>Hak Akses</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($tb_user as $user) : ?>
                    <tr>
                      <td><?= $user['id']; ?></td>
                      <td><?= $user['nama_user']; ?></td>
                      <td><?= $user['username']; ?></td>
                      <td><?= $user['hak_akses']; ?></td>
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