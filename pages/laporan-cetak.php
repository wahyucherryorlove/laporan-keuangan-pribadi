<?php
require "../connect/koneksi.php";

$queryPenjumlahan = $conn->query("SELECT SUM(dana) as danas FROM tbl_pemasukan");
$itemPenjumlahan = $queryPenjumlahan->fetch_assoc();

$queryPengurangan = $conn->query("SELECT SUM(dana) as danas FROM tbl_pengeluaran");
$itemPengurangan = $queryPengurangan->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Tahun <?= date("Y") ?></title>

    <link rel="shortcut icon" href="../public/icons/web-keuangan.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/bootstrap-5.1.3-dist/css/bootstrap.min.css">

    <!-- Style CSS -->
    <link rel="stylesheet" href="../public/bootstrap-5.1.3-dist/css/style.css">

    <!-- Jquery JS -->
    <script src="../public/datatables/jquery-3.5.1.js"></script>

    <style>
        body {
            background:  #aaa;
        }

        #cetak-laporan {
            background-color: #fff;
            margin: auto;
            width: 40%;
            height: 100vh;
            padding: 50px 30px 0px;
        }

        @media (max-width: 992px) {
            #cetak-laporan {
                width: 70%;
            }
        }
        
        @media (max-width: 576px) {
            #cetak-laporan {
                width: 95%;
            }
        }
    </style>
</head>

<body class="overflow-hidden">

    <section id="cetak-laporan">
        <div class="head text-center pb-2 border1 border-bottom border-dark justify-content-center">
            <h3 style="font-family:Arial, Helvetica, sans-serif" class="fs-6">Laporan Keuangan Pribadi Keseluruhan</h3>
            <h4 style="font-family:Arial, Helvetica, sans-serif" class="fs-5 fw-bold">PERIODE TAHUN <?= date("Y") ?></h4>
            <p style="font-family:Arial, Helvetica, sans-serif">Jln. Komp. YPPKG Blok K3 A/39, Kota Makassar, Sul-sel</p>
        </div>
        <div class="periode mt-3 mb-4">
            <p style="font-size: 15px;" class="text-center">Periode Sampai <?= date("F Y") ?></p>
        </div>
        <div class="body overflow-md-auto d-flex justify-content-center">
            <table>
                <tr class="d-block mb-1">
                    <td>Pemasukan</td>
                    <td style="padding-left: 115px; padding-right: 50px">:</td>
                    <td>Rp. <?= $itemPenjumlahan['danas'] ?></td>
                </tr>
                <tr class="d-block mb-1 position-relative">
                    <td>Pengeluaran</td>
                    <td style="padding-left: 107px; padding-right: 50px">:</td>
                    <td>Rp. <?= $itemPengurangan['danas'] ?></td>
                </tr>
                <tr class="d-block pt-3 border-top mt-3">
                    <td class="fw-bold">Total Dana Keseluruhan</td>
                    <td class="fw-bold" style="padding: 0px 20px; padding-right: 50px">:</td>
                    <td class="fw-bold">Rp. <?= ($itemPenjumlahan['danas'] - $itemPengurangan['danas']) ?></td>
                </tr>
            </table>
        </div>
    </section>

    <script>
        this.print();
    </script>
</body>

</html>