<?php
require_once 'app/functions/MY_model.php';

// Mengecek apakah form pencarian telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])) {
    $startDate = $_POST['start'];
    $endDate = $_POST['end'];

    // Kode untuk mengambil data laporan kadaluarsa berdasarkan rentang tanggal
    $query = "SELECT ob.kode_obat, ob.nama_obat, b.no_batch, b.tgl_exp, d.nama_distributor, k.nama_kategori, s.nama_satuan
              FROM tb_obat ob
              INNER JOIN tb_batch b ON ob.id = b.obat_id
              INNER JOIN tb_distributor d ON ob.distributor_id = d.id
              INNER JOIN tb_kategori k ON ob.kategori_id = k.id
              INNER JOIN tb_satuan s ON ob.satuan_id = s.id
              WHERE b.tgl_exp BETWEEN '$startDate' AND '$endDate'
              ORDER BY b.tgl_exp ASC";
} else {
    // Kode untuk mengambil semua data laporan kadaluarsa
    $query = "SELECT ob.kode_obat, ob.nama_obat, b.no_batch, b.tgl_exp, d.nama_distributor, k.nama_kategori, s.nama_satuan
              FROM tb_obat ob
              INNER JOIN tb_batch b ON ob.id = b.obat_id
              INNER JOIN tb_distributor d ON ob.distributor_id = d.id
              INNER JOIN tb_kategori k ON ob.kategori_id = k.id
              INNER JOIN tb_satuan s ON ob.satuan_id = s.id
              ORDER BY b.tgl_exp ASC";
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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Kadaluarsa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <h4 style="font-size: 24px; font-weight: bold; text-align: center;">Laporan Kadaluarsa</h4>
            <?php
            $start_date = date('d F Y', strtotime('-7 days'));
            $end_date = date('d F Y');
            ?>
            <h5 style="font-size: 18px; font-weight: bold; text-align: center;">Periode: <?php echo $start_date . ' - ' . $end_date; ?></h5>
            <br>

            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>No Batch</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Distributor</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $expiryDate = $row['tgl_exp'];
                        $currentDate = date('Y-m-d');
                        $oneMonthAhead = date('Y-m-d', strtotime('+1 month'));
                        $isExpiring = ($expiryDate >= $currentDate && $expiryDate <= $oneMonthAhead);

                        $rowClass = $isExpiring ? 'expiring' : '';
                        $style = $isExpiring ? 'style="background-color: red; color: white;"' : '';

                        echo "<tr class='$rowClass' $style>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['kode_obat'] . "</td>";
                        echo "<td>" . $row['nama_obat'] . "</td>";
                        echo "<td>" . $row['no_batch'] . "</td>";
                        echo "<td>" . $row['tgl_exp'] . "</td>";
                        echo "<td>" . $row['nama_distributor'] . "</td>";
                        echo "<td>" . $row['nama_kategori'] . "</td>";
                        echo "<td>" . $row['nama_satuan'] . "</td>";
                        echo "</tr>";
                    }

                    if (mysqli_num_rows($result) == 0) {
                        echo "<tr><td colspan='8'>Tidak ada obat yang akan kadaluarsa dalam waktu 1 bulan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @keyframes blinkAnimation {
        0% { background-color: white; }
        50% { background-color: red; }
        100% { background-color: white; }
    }

    .expiring {
        animation: blinkAnimation 1s infinite;
    }
</style>

<script>
    setInterval(blinkRows, 1500); // Kedap-kedip setiap 1 detik (1000 ms)
</script>
