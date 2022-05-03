<?php
require "../connect/koneksi.php";
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
            background: #aaa;
        }

        #cetak-laporan {
            background-color: #fff;
            margin: auto;
            width: 60%;
            padding: 50px 30px 0px;
        }

        @media (max-width: 992px) {
            #cetak-laporan {
                width: 85%;
            }
        }

        @media (max-width: 576px) {
            #cetak-laporan {
                width: 95%;
            }
        }
    </style>
</head>

<body>

    <section id="cetak-laporan">
        <div class="head text-center border1 border-bottom border-dark justify-content-center">
            <h3 style="font-family:Arial, Helvetica, sans-serif" class="fs-6">Laporan Pemasukan Keuangan</h3>
            <h4 style="font-family:Arial, Helvetica, sans-serif" class="fs-5 fw-bold">PERIODE TAHUN <?= date("Y") ?></h4>
            <p style="font-family:Arial, Helvetica, sans-serif">Jln. Komp. YPPKG Blok K3 A/39, Kota Makassar, Sul-sel</p>
        </div>
        <div class="periode mt-3 mb-4">
            <p style="font-size: 17px;" class="text-center fw-bold">Periode Sampai <?= date("F Y") ?></p>
        </div>
        <div class="body overflow-md-auto d-flex justify-content-center">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Dana Pemasukan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    $query2 = $conn->query("SELECT * FROM tbl_pemasukan WHERE id = '$_GET[id]'");
                    $itemPemasukan = $query2->fetch_assoc();
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= date("d F Y", strtotime($itemPemasukan['tanggal']))?></td>
                            <td class="text-start" style="width: 200px;">Rp. <?= $itemPemasukan['dana'] ?></td>
                            <td class="text-start" style="width: 300px;"><?= $itemPemasukan['keterangan'] ?></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        this.print();
    </script>
</body>

</html>