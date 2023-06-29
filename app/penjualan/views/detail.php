<?php
require_once 'app/functions/MY_model.php';
$id = $_GET['id'];
$tb_penjualan = get_where("SELECT p.*, u.username
                    FROM tb_penjualan p 
                    INNER JOIN tb_karyawan u ON p.username = u.id         
                    WHERE p.id = '$id'");
?>
  <div class="container-fluid">
        <div class="card shadow mb-4"> 
        <div class="card-body"> 
            <div class="about-row row"> 
                <div class=" col-md-12"> 
                  <table class="table table-borderless"> 
                    <tr>  
                        <td class="text-center"> 
                           <h5>APOTEK SYIFA</h5>
                        </td>
                    </tr>
                        </table>
                        <center><h6><u>DATA PENJUALAN</u></h6></center>
                            <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="100px" height="">No. Struk</th>
                                    <th>Tanggal Penjualan </th>
                                    <th>Total Harga</th>
                                    <th>Total Bayar</th>
                                    <th>Kembali</th>
                                    <th style="text-align : center">Karyawan</th>
                                    </tr>
                                </thead>
                                    <tr>
                                    <td><?= $penjualan['no_struk']; ?></td>
                                    <td><?= $penjualan['tgl_penjualan']; ?></td>
                                    <td><?= $penjualan['total_harga']; ?></td>
                                    <td><?= $penjualan['total_bayar']; ?></td>
                                    <td><?= $penjualan['kembali']; ?></td>
                                    <td><?= $penjualan['username']; ?></td>
                                    </tr>