<?php
require_once 'app/functions/MY_model.php';

// Mengecek apakah form pencarian telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])) {
    $startDate = $_POST['start'];
    $endDate = $_POST['end'];

    // Kode untuk mengambil data laporan penjualan berdasarkan rentang tanggal
    $query = "SELECT p.tgl_penjualan, SUM(p.jumlah) AS total_jumlah, SUM(p.total_harga) AS total_pendapatan, o.nama_obat 
              FROM penjualans p
              INNER JOIN obats o ON p.obat_id = o.id
              WHERE p.tgl_penjualan BETWEEN '$startDate' AND '$endDate'
              GROUP BY p.tgl_penjualan
              ORDER BY p.tgl_penjualan DESC";
} else {
    // Kode untuk mengambil 10 data terbaru dari laporan penjualan
    $query = "SELECT p.tgl_penjualan, SUM(p.jumlah) AS total_jumlah, SUM(p.total_harga) AS total_pendapatan, o.nama_obat
              FROM penjualans p
              INNER JOIN obats o ON p.obat_id = o.id
              GROUP BY p.tgl_penjualan
              ORDER BY p.tgl_penjualan DESC
              LIMIT 10";
}

$result = mysqli_query($conn, $query);
?>

<!-- Form Filter -->
<form class="form" method="post" action="">
    <div class="form-body">
        <div class="row">
            <div class="col">
                <label for="start">Start Date</label>
                <fieldset class="form-group">
                    <input type="date" name="start" class="form-control" required>
                </fieldset>
            </div>
            <div class="col">
                <label for="end">End Date</label>
                <fieldset class="form-group">
                    <input type="date" name="end" class="form-control" required>
                </fieldset>
            </div>
            <div class="col rslt-btn">
                <button type="submit" name="filter" class="btn mt-2 btn-outline-primary btn-icon btn-block text-uppercase waves-effect waves-light">Filter</button>
            </div>
        </div>
    </div>
</form>


<!-- Tabel Laporan Penjualan -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal Penjualan</th>
                <th>Nama Obat</th>
                <th>Total Jumlah</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['tgl_penjualan'] . "</td>";
                    echo "<td>" . $row['nama_obat'] . "</td>";
                    echo "<td>" . $row['total_jumlah'] . "</td>";
                    echo "<td>" . $row['total_pendapatan'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data laporan penjualan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
