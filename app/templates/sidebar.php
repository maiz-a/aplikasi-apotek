<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
    <li class="nav-item mr-auto"><a class="navbar-brand" href="html/ltr/vertical-menu-template-semi-dark/index.html">
          <div class="brand-logo"></div>
          <h2 class="brand-text">Apotek</h2>
        </a></li>
      <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
    </ul>
  </div>
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class="<?php echo is_active(''); ?> nav-item">
        <a href="index.php"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
      </li>

      <li class="nav-item"><a href="javascript:;"><i class="feather icon-archive"></i><span class="menu-title">Manajemen Data</span></a>
      
        <ul class="menu-content">
          <li class="<?php echo is_active('obat'); ?>"><a href="?page=obat"><i class="feather icon-circle"></i><span class="menu-item">Data Obat</span></a>
          </li>
        </ul>

        <ul class="menu-content">
          <li class="<?php echo is_active('supplier'); ?>"><a href="?page=distributor"><i class="feather icon-circle"></i><span class="menu-item">Data Distributor</span></a>
          </li>
        </ul>

        <ul class="menu-content">
        <li class="<?php echo is_active('user'); ?>"><a href="?page=user"><i class="feather icon-circle"></i><span class="menu-title" >User</span>
        </a>
      </li>
        </ul>

        <li class="nav-item"><a href="javascript:;"><i class="feather icon-shopping-cart"></i><span class="menu-title">Transaksi</span></a>
        <ul class="menu-content">
          <li class="<?php echo is_active('penjualan'); ?>"><a href="?page=penjualan"><i class="feather icon-circle"></i><span class="menu-item">Penjualan</span></a>
          </li>
        </ul>

        <ul class="menu-content">
          <li class="<?php echo is_active('pembelian'); ?>"><a href="?page=pembelian"><i class="feather icon-circle"></i><span class="menu-item">Pembelian</span></a>
          </li>
        </ul>

        <li class="nav-item"><a href="javascript:;"><i class="feather icon-pie-chart"></i><span class="menu-title"></span>Laporan</a>
        <?php 
                        if (isset($_SESSION['user'])) {
                          $userRole = $_SESSION['user']['hak_akses'];
                          if ($userRole === 'pemilik') : 
                      ?>
        
        <ul class="menu-content">
          <li class="<?php echo is_active('lap-penjualan'); ?>"><a href="?page=laporan-penjualan"><i class="feather icon-circle"></i><span class="menu-item">Laporan Penjualan</span></a>
          </li>
        </ul>
        <?php endif; } ?>

        <ul class="menu-content">
          <li class="<?php echo is_active('expired'); ?>"><a href="?page=data-expired"><i class="feather icon-circle"></i><span class="menu-item">Laporan Expired</span></a>
          </li>
        </ul>

        <ul class="menu-content">
          <li class="<?php echo is_active('stok'); ?>"><a href="?page=data-stok-obat"><i class="feather icon-circle"></i><span class="menu-item">Laporan Stok</span></a>
          </li>
        </ul>
    
  </div>
</div>
<!-- END: Main Menu-->