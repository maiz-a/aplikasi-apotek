<?php
require_once 'app/functions/MY_model.php';

$stok = get("SELECT b.no_batch, o.nama_obat, k.nama_kategori, s.nama_satuan, st.stok_akhir, st.tanggal_update
            FROM tb_obat o
            INNER JOIN tb_batch b ON o.id = b.obat_id
            INNER JOIN tb_kategori k ON o.kategori_id = k.id 
            INNER JOIN tb_satuan s ON o.satuan_id = s.id
            LEFT JOIN tb_stok st ON o.id = st.obat_id");

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Stok Obat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive"><br>
            <h4 style="font-size: 24px; font-weight: bold; text-align: center;"><strong>Laporan Stok</strong></h4>
            <br>

            <table class="table" id="" width="100%" cellspacing="0" style="font-size: 12px">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th width="9%">Nomor Batch</th>
                        <th width="20%">Nama</th>
                        <th width="12%">Tanggal Update</th>
                        <th width="12%">Kategori</th>
                        <th width="10%">Satuan</th>
                        <th width="10%">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($stok as $row) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['no_batch'] . "</td>";
                        echo "<td>" . $row['nama_obat'] . "</td>";
                        echo "<td>" . $row['tanggal_update'] . "</td>";
                        echo "<td>" . $row['nama_kategori'] . "</td>";
                        echo "<td>" . $row['nama_satuan'] . "</td>";
                        echo "<td>" . $row['stok_akhir'] . "</td>";
                        echo "</tr>";
                    }

                    if (count($stok) == 0) {
                        echo "<tr><td colspan='6'>Tidak ada data stok obat.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
