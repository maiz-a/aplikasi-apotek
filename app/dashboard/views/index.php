<?php
require_once 'app/functions/MY_model.php';

$obat = mysqli_query($conn, "SELECT * FROM tb_obat");
$count_obat = mysqli_num_rows($obat);

$distributor = mysqli_query($conn, "SELECT * FROM tb_distributor");
$count_distributor = mysqli_num_rows($distributor);

$penjualan = mysqli_query($conn, "SELECT * FROM tb_penjualan");
$count_penjualan = mysqli_num_rows($penjualan);

$pembelian = mysqli_query($conn, "SELECT * FROM tb_pembelian");
$count_pembelian = mysqli_num_rows($pembelian);

// $_SESSION['title'] = 'Dashboard';
?>
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex flex-column align-items-start pb-0">
          <div class="avatar bg-rgba-primary p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-users text-primary font-medium-5"></i>
            </div>
          </div>
          <h2 class="text-bold-700 mt-1 mb-25"><?= $count_obat; ?></h2>
          <p class="mb-0">Obat</p>
        </div>
        <div class="card-content">
          <!-- <div id="dokter-chart"></div> -->
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex flex-column align-items-start pb-0">
          <div class="avatar bg-rgba-primary p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-users text-primary font-medium-5"></i>
            </div>
          </div>
          <h2 class="text-bold-700 mt-1 mb-25"><?= $count_distributor; ?></h2>
          <p class="mb-0">Distributor</p>
        </div>
        <div class="card-content">
          <!-- <div id="pasien-chart"></div> -->
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex flex-column align-items-start pb-0">
          <div class="avatar bg-rgba-primary p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-users text-primary font-medium-5"></i>
            </div>
          </div>
          <h2 class="text-bold-700 mt-1 mb-25"><?= $count_penjualan; ?></h2>
          <p class="mb-0">Penjualan</p>
        </div>
        <div class="card-content">
          <!-- <div id="ruang-chart"></div> -->
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-12">
      <div class="card">
        <div class="card-header d-flex flex-column align-items-start pb-0">
          <div class="avatar bg-rgba-warning p-50 m-0">
            <div class="avatar-content">
              <i class="feather icon-package text-warning font-medium-5"></i>
            </div>
          </div>
          <h2 class="text-bold-700 mt-1 mb-25"><?= $count_pembelian; ?></h2>
          <p class="mb-0">Pembelian</p>
        </div>
        <div class="card-content">
          <!-- <div id="obat-chart"></div> -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Dashboard Analytics end -->
<script>
  var count_dokter = '<?php echo $count_dokter; ?>';
</script>
<?php
$addon_script = ['assets/vendors/js/charts/apexcharts.min.js', 'assets/js/pages/dashboard.js'];
$prepend_style = ['assets/css/pages/dashboard.css'];
?>