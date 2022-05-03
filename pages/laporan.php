<?php
$page = "Laporan";
require "menu.php";

$queryPenjumlahan = $conn->query("SELECT SUM(dana) as danas FROM tbl_pemasukan");
$itemPenjumlahan = $queryPenjumlahan->fetch_assoc();

$queryPengurangan = $conn->query("SELECT SUM(dana) as danas FROM tbl_pengeluaran");
$itemPengurangan = $queryPengurangan->fetch_assoc();
?>

<!-- Thumbnail Data -->
<section class="containers">
    <div class="title-page mb-4 d-sm-flex justify-content-between align-items-center">
        <h4 class="">Laporan Keseluruhan Dana</h4>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../logout.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Dana</li>
            </ol>
        </nav>
    </div>
</section>
<!-- Thumbnail End -->

<!-- Table Data -->
<section class="containers mb-2" style="margin-top: 20px;">
    <div class="row rounded-2 border shadow-lg py-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p>Periode Sampai <span class="fw-bold"><?= date("F Y") ?></span></p>
                    <div class="overflow-hidden overflow-md-auto px-2 py-2" id="selectData">

                        <table style="min-width: 400px;">
                            <tr class="d-block mb-1">
                                <td>Pemasukan</td>
                                <td style="padding-left: 115px; padding-right: 50px">:</td>
                                <td>Rp. <?= $itemPenjumlahan['danas'] ?></td>
                            </tr>
                            <tr class="d-block mb-1 position-relative">
                                <td>Pengeluaran</td>
                                <td style="padding-left: 107px; padding-right: 50px">:</td>
                                <td>Rp. <?= $itemPengurangan['danas'] ?></td>
                                <td class="fs-4 position-absolute end-0" style="top: 15px">-</td>
                            </tr>
                            <tr class="d-block pt-3 border-top mt-3">
                                <td class="fw-bold">Total Dana Keseluruhan</td>
                                <td class="fw-bold" style="padding: 0px 20px; padding-right: 50px">:</td>
                                <td class="fw-bold">Rp. <?= ($itemPenjumlahan['danas'] - $itemPengurangan['danas']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <a href="laporan-cetak.php" class="btn btn-info mt-4 btn-sm">Cetak Data</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Data End -->