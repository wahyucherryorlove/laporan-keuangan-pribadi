<?php
$page = "Dashboard";
require "menu.php";
?>

<!-- Total Data -->
<section class="containers">
    <div class="title-page mb-4 d-sm-flex justify-content-between align-items-center">
        <h4 class="">Dashboard</h4>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../logout.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>
    <?php if (($_SESSION['roles'] === "Administrasi") || ($_SESSION['roles'] === "Petugas")) : ?>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 my-1">
                <div class="bg-primary px-2 rounded pt-3 py-2 pb-5 position-relative">
                    <div class="title">
                        <h3 class="fw-bold fs-5 text-light">
                            <?php
                            $queryPemasukan = $conn->query("SELECT SUM(dana) as danas FROM tbl_pemasukan");
                            $resultPemasukan = $queryPemasukan->fetch_assoc();

                            echo "Rp. $resultPemasukan[danas]";
                            ?>
                        </h3>
                    </div>
                    <div class="teks">
                        <p class="fw-bold text-light" style="font-size: 15px;">Dana Pemasukan</p>
                    </div>
                    <div class="icons position-absolute opacity-50" style="right: 20px; top: 25px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#3A3A3A" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                            <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 my-1">
                <div class="bg-danger px-2 rounded pt-3 py-2 pb-5 position-relative">
                    <div class="title">
                        <h3 class="fw-bold fs-5 text-light">
                            <?php
                            $queryPengeluaran = $conn->query("SELECT SUM(dana) as danas FROM tbl_pengeluaran");
                            $resultPengeluaran = $queryPengeluaran->fetch_assoc();

                            echo "Rp. $resultPengeluaran[danas]";
                            ?>
                        </h3>
                    </div>
                    <div class="teks">
                        <p class="fw-bold text-light" style="font-size: 15px;">Dana Pengeluaran</p>
                    </div>
                    <div class="icons position-absolute opacity-50" style="right: 20px; top: 25px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#3A3A3A" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                            <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1ZM6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1Z" />
                        </svg>
                    </div>
                </div>
            </div>
            <!-- Bagian Management User -->
            <?php if ($_SESSION['roles'] === "Administrasi") : ?>
                <div class="col-lg-3 col-md-4 my-1">
                    <div class="bg-success px-2 rounded pt-3 py-2 pb-5 position-relative">
                        <div class="title">
                            <h3 class="fw-bold fs-5 text-light">
                                <?php
                                $queryUser = $conn->query("SELECT COUNT(id) as ids FROM tbl_user");
                                $resultUser = $queryUser->fetch_assoc();

                                echo "$resultUser[ids] Orang";
                                ?>
                            </h3>
                        </div>
                        <div class="teks">
                            <p class="fw-bold text-light" style="font-size: 15px;">Management Users</p>
                        </div>
                        <div class="icons position-absolute opacity-50" style="right: 20px; top: 25px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#3A3A3A" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Bagian Management User End-->
        </div>
    <?php endif; ?>
</section>
<!-- Total Data End -->

<!-- Welcome -->
<section class="containers mb-2" style="margin-top: 40px;">
    <div class="row rounded-2 border shadow-lg py-5">
        <div class="col">
            <h2>Selamat Datang, <?= $result['nama'] ?> ( <?= $result['role'] ?> )</h2>
            <p class="lead">Aplikasi Laporan Keuangan Pribadi</p>
        </div>
    </div>
</section>
<!-- Welcome End -->