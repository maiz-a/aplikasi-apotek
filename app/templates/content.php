<?php
if (isset($_GET['page'])) {

	switch ($_GET['page']) {

		case 'dokter':
			require_once 'app/dokter/views/index.php';
			break;
		case 'tambah-dokter':
			require_once 'app/dokter/views/create.php';
			break;
		case 'edit-dokter':
			require_once 'app/dokter/views/edit.php';
			break;
		case 'hapus-dokter':
			require_once 'app/dokter/proses/delete.php';
			break;
		case 'pasien':
			require_once 'app/pasien/views/index.php';
			break;
		case 'tambah-pasien':
			require_once 'app/pasien/views/create.php';
			break;
		case 'edit-pasien':
			require_once 'app/pasien/views/edit.php';
			break;
		case 'hapus-pasien':
			require_once 'app/pasien/proses/delete.php';
			break;
		case 'obat':
			require_once 'app/obat/views/index.php';
			break;
		case 'tambah-obat':
			require_once 'app/obat/views/create.php';
			break;
		case 'edit-obat':
			require_once 'app/obat/views/edit.php';
			break;
		case 'hapus-obat':
			require_once 'app/obat/proses/delete.php';
			break;

		case 'distributor':
			require_once 'app/distributor/views/index.php';
			break;
		case 'tambah-distributor':
			require_once 'app/distributor/views/create.php';
			break;
		case 'edit-distributor':
			require_once 'app/distributor/views/edit.php';
			break;
		case 'hapus-distributor':
			require_once 'app/distributor/proses/delete.php';
			break;

		case 'user':
			require_once 'app/user/views/index.php';
			break;

		case 'penjualan':
			require_once 'app/penjualan/views/index.php';
			break;
		case 'tambah-penjualan':
			require_once 'app/penjualan/views/create.php';
			break;
		case 'edit-penjualan':
			require_once 'app/penjualan/views/edit.php';
			break;
		case 'detail-penjualan':
			require_once 'app/penjualan/views/detail.php';
			break;
		case 'hapus-penjualan':
			require_once 'app/penjualan/proses/delete.php';
			break;

		case 'pembelian':
			require_once 'app/pembelian/views/index.php';
			break;
		case 'tambah-pembelian':
			require_once 'app/pembelian/views/create.php';
			break;
		case 'edit-pembelian':
			require_once 'app/pembelian/views/edit.php';
			break;
		case 'detail-pembelian':
			require_once 'app/pembelian/views/detail.php';
			break;
		case 'hapus-pembelian':
			require_once 'app/pembelian/proses/delete.php';
			break;

		case 'data-expired':
			require_once 'app/laporan/data-expire.php';
			break;
		case 'data-stok-obat':
			require_once 'app/laporan/stok-obat.php';
			break;
		case 'laporan-penjualan':
			require_once 'app/laporan/penjualan.php';
			break;
		

			}
} else {
	require_once 'app/dashboard/views/index.php';
}
