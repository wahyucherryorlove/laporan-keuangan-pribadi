<?php
session_start();
require "../connect/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("location: ../index.php");
    exit;
}

$query = $conn->query("SELECT * FROM tbl_user WHERE id = '$_SESSION[kode]'");
$result = $query->fetch_assoc();
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

    <!-- SweatAlert JS -->
    <script src="../public/js/sweetalert2@11.js"></script>

    <!-- DataTable -->
    <link rel="stylesheet" href="../public/datatables/dataTables.bootstrap5.min.css">
    <script src="../public/datatables/jquery.dataTables.min.js"></script>

    <style>
        .toggle span {
            height: 3px;
        }

        @media(max-width: 768px) {
            .overflow-md-auto {
                overflow: auto !important;
            }
        }
    </style>
</head>

<body class="bg-light">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <header class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top pt-3 pb-3">
        <div class="container-fluid">
            <a class="navbar-brand d-lg-none cursor-pointer" id="open-menu-toggle">
                <div class="d-flex flex-column justify-content-between toggle bg-transparent" style="width: 17px; height: 15px;">
                    <span class="block bg-dark w-100 rounded"></span>
                    <span class="block bg-dark w-100 rounded"></span>
                    <span class="block bg-dark w-100 rounded"></span>
                </div>
            </a>

            <div class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <button class="bg-transparent dropdown-toggle border-0 flex" data-bs-toggle="dropdown">
                        <img src="../public/img/<?= $result['profile'] ?>" alt="" class="rounded-circle bg-danger me-2" height="30" width="30"><span><?= $result['nama'] ?></span>
                    </button>

                    <ul class="dropdown-menu position-absolute">
                        <a href="profile.php" class="dropdown-item <?php if ($page === "Profile") echo 'active'; ?>">Profile</a>
                        <a href="../logout.php" class="dropdown-item">Logout</a>
                    </ul>
                </li>
            </div>
        </div>
    </header>
    <div class="sidebar fixed-top border-end h-100 bg-dark">
        <div class="offcanvas-header text-light">
            <h5 class="offcanvas-title fs-5">Laporan Keuangan</h5>
            <button type="button" class="d-lg-none toggle-close" id="close-menu-toggle">
                <img src="../public/icons/close.svg" alt="Close">
            </button>
        </div>

        <div class="offcanvas-profile ps-3 py-3 mt-3 border-top border-bottom position-relative pb-4 text-light">
            <div class="position-absolute" style="top: 15px;">
                <img src="../public/img/<?= $result['profile'] ?>" alt="<?= "Wahyudi" ?>" width="40" height="40" class="rounded-circle bg-danger me-2">
            </div>
            <span style="margin-left: 50px;"><?= $result['nama'] ?></span>
            <p class="position-absolute d-flex align-items-center" style="left: 27%;top:60%; font-size: 14px"><span style="height: 10px; width:10px;" class="bg-success rounded-circle me-1 mt-n1"></span> Online</p>
        </div>

        <div class="navbar-nav mt-4">
            <li class="nav-item ps-3 position-relative <?php if ($page === "Dashboard") echo 'active'; ?>">
                <a href="dashboard.php" class="py-2 text-light d-flex text-decoration-none navbar-link"><img src="../public/icons/dashboard.svg" class="me-2" alt="Dashboard"> <span>Dashboard</span></a>
                <div class="icon-offcanvas-body"></div>
            </li>
            <li class="nav-item ps-3 position-relative <?php if ($page === "Pemasukan") echo 'active'; ?>">
                <a href="data-pemasukan.php" class="py-2 text-light d-flex text-decoration-none navbar-link"><img src="../public/icons/plus.svg" class="me-2" alt="Pemasukan"> <span>Pemasukan Dana</span></a>
                <div class="icon-offcanvas-body"></div>
            </li>
            <li class="nav-item ps-3 position-relative <?php if ($page === "Pengeluaran") echo 'active'; ?>">
                <a href="data-pengeluaran.php" class="py-2 text-light d-flex text-decoration-none navbar-link"><img src="../public/icons/negatif.svg" class="me-2" alt="Pengeluaran"> <span>Pengeluaran Dana</span></a>
                <div class="icon-offcanvas-body"></div>
            </li>
            <?php if ($_SESSION['roles'] === "Administrasi") : ?>
                <li class="nav-item ps-3 position-relative <?php if ($page === "managementUser") echo 'active'; ?>">
                    <a href="management-user.php" class="py-2 text-light d-flex text-decoration-none navbar-link"><img src="../public/icons/people-fill.svg" class="me-2" alt="Laporan"> <span>User Registration</span></a>
                    <div class="icon-offcanvas-body"></div>
                </li>
            <?php endif; ?>
            <li class="nav-item ps-3 position-relative">
                <a href="../logout.php" class="py-2 text-light d-flex text-decoration-none navbar-link"><img src="../public/icons/logout.svg" class="me-2" alt="Logout"> <span>Logout</span></a>
            </li>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../public/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/datatables/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
    <!-- Main JS -->
    <script src="../public/js/main.js"></script>
</body>

</html>