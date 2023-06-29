<?php
require_once 'app/functions/MY_model.php';

$pasien = get("SELECT * FROM pasiens p
                INNER JOIN categories c ON p.category_id = c.id
                INNER JOIN fakultas f ON p.category_id = f.id
                INNER JOIN users u ON p.user_id = u.id;");

$title = 'pasien';

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
          <h4 class="card-title">Edit Password</h4>
        </div>
        <div class="card-content">
          <div class="card-body">
          <form action="app/profile/proses/update.php" method="post">
              <input type="hidden" name="id" value="<?= $pasien['id']; ?>">
              <div class="form-body">
                <div class="row">

                <div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" action=http://sidik.test/pasien/update/password/3756>
                    <input type="hidden" name="_method" value="PATCH">                    <input type="hidden" name="_token" value="PrSpzJ3JMZVR2y1GUAPf6ifnL86hg94ZwWz67Oii">                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Password:</label>
                                            <input id="password-lama" type="password" name="current_password" class="form-control " autocomplete="current_password" required>
                                        
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-12" id="new-password" >
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Password Baru:</label>
                                            <input id="password-baru" type="password" name="password" class="form-control " required>
                                        
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-12" id="password-confirm" >
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Konfirmasi Password Baru:</label>
                                            <input id="password-baru-confirm" type="password" name="password_confirmation" class="form-control " required>
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="checkbox" class="form-control-input" onclick="showPassword()"> Tampilkan password
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span>
                            <i class="feather icon-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="?page=profil" class="btn btn-secondary btn-sm">
                        <span>
                            <i class="feather icon-x"></i>
                        </span>    
                        <span class="text">Batal</span>
                    </a>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>
<script>
    function showPassword() {
        var x = document.getElementById('password-lama');
        var y = document.getElementById('password-baru');
        var z = document.getElementById('password-baru-confirm');
        if (x.type == "password" || y.type == "password" || z.type == "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
        }
        else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
        }
    }
</script>

            </div>
            <!-- End of Main Content -->
    
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SIDIK 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
  </div>