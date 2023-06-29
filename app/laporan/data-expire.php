<?php
require_once 'app/functions/MY_model.php';

// Query untuk mendapatkan data kadaluarsa
$query = "SELECT o.kode, o.nama_obat, e.no_batch, e.tgl_exp, s.nama_distributor, k.nama_kategori, st.nama_satuan
            FROM obats o 
            INNER JOIN expireds e ON o.id = e.obat_id
            INNER JOIN distributors s ON o.distributor_id = s.id
            INNER JOIN kategoris k ON o.kategori_id = k.id 
            INNER JOIN satuans st ON o.satuan_id = st.id
            WHERE e.tgl_exp < CURDATE()
            ORDER BY e.tgl_exp ASC";

// Eksekusi query
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kadaluarsa</title>
    
</head>
<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Kadaluarsa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive"><br>
                <h4 style="font-size: 24px; font-weight: bold; text-align: center;"><strong>Laporan Kadaluarsa</strong></h4>
                <?php
                $start_date = date('d F Y', strtotime('-7 days'));
                $end_date = date('d F Y');
                ?>
                <h5 style="font-size: 18px; font-weight: bold; text-align: center;">Periode: <?php echo $start_date . ' - ' . $end_date; ?></h5>
                <br>

                <table class="table" id="" width="100%" cellspacing="0" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th width="2%">No</th>
                            <th width="9%">Kode Obat</th>
                            <th width="40%">Nama Obat</th>
                            <th width="12%">No Batch</th>
                            <th width="10%">Tanggal Kadaluarsa</th>
                            <th width="10%">Distributor</th>
                            <th width="10%">Kategori</th>
                            <th width="7%">Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $row['kode'] . "</td>";
                            echo "<td>" . $row['nama_obat'] . "</td>";
                            echo "<td>" . $row['no_batch'] . "</td>";
                            echo "<td>" . $row['tgl_exp'] . "</td>";
                            echo "<td>" . $row['nama_distributor'] . "</td>";
                            echo "<td>" . $row['nama_kategori'] . "</td>";
                            echo "<td>" . $row['nama_satuan'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
