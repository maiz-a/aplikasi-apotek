<?php
require_once 'app/functions/MY_model.php';

$stok = get("SELECT o.*, s.nama_distributor, k.nama_kategori, st.nama_satuan
            FROM obats o 
            INNER JOIN distributors s ON o.distributor_id = s.id
            INNER JOIN kategoris k ON o.kategori_id = k.id 
            INNER JOIN satuans st ON o.satuan_id = st.id");

?> 
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Stok Obat</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive"><br>
            <h4 style="font-size: 24px; font-weight: bold; text-align: center;"><strong>Laporan Stok</strong></h4>
            <?php $date = date('d F Y'); ?>
            <h5 style="font-size: 18px; font-weight: bold; text-align: center;">Periode: <?php echo $date; ?></h5>
            <br>

            <table class="table" id="" width="100%" cellspacing="0" style="font-size: 12px">
                <thead>
                    <tr>
                        <th width="2%">No</th>
                        <th width="9%">Kode</th>
                        <th width="40%">Nama</th>
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
                        echo "<td>" . $row['kode'] . "</td>";
                        echo "<td>" . $row['nama_obat'] . "</td>";
                        echo "<td>" . $row['nama_kategori'] . "</td>";
                        echo "<td>" . $row['nama_satuan'] . "</td>";
                        echo "<td>" . $row['stok'] . "</td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
