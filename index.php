<?php
session_start();
require "connect/koneksi.php";

if ( isset($_COOKIE['login'])) {
    $login = $_COOKIE['login'];

    // Ambil Username
    $query = $conn->query("SELECT * FROM tbl_user");
    $result = $query->fetch_assoc();

    if( $login === uniqid( $result['username'])) {
        $_SESSION['login'];
    }
}

if( isset($_SESSION['login'])) {
    header("location: pages/dashboard.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM tbl_user WHERE username = '$username' AND aktif = '1'");

    if (mysqli_num_rows($query) === 1) {
        $result = $query->fetch_assoc();

        // Cek Password
        if (password_verify($password, $result['password'])) {
            $_SESSION['login'] = true;

            // Cek Remember Me
            if ( isset($_POST['remember'])) {
                // Buat Coockie
                setcookie('login', uniqid($result['username']), time() + 120);
            }

            $_SESSION['kode'] = $result['id'];
            $_SESSION['roles'] = $result['role'];
            header("location: pages/dashboard.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Pribadi</title>

    <link rel="shortcut icon" href="public/icons/web-keuangan.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="public/bootstrap-5.1.3-dist/css/bootstrap.min.css">

    <!-- Jquery JS -->
    <script src="public/datatables/jquery-3.5.1.js"></script>

    <!-- SweatAlert JS -->
    <script src="public/js/sweetalert2@11.js"></script>

    <style>
        .row {
            margin-top: 50px;
        }

        #background {
            background-image: url("public/img/makassar-city.png");
            /* background-size: cover; */
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>

</head>

<body class="overflow-hidden" id="background">
    <section id="form-login" class="mb-5">
        <div class="row mx-3 justify-content-center">
            <div class="col-md-4 py-4 border border-secondary shadow bg-dark rounded-3 text-light">
                <div class="text-center" aria-label="Avatar-img">
                    <img src="public/icons/avatar.svg" alt="Avatar" width="120" height="120">
                    <h3 class="mt-3 fs-2">Selamat Datang</h3>

                    <?php if (isset($error)) : ?>
                        <script>
                            Swal.fire({
                                icon: "error",
                                title: "Opps",
                                text: "Username atau Password Anda Salah",
                                confirmButtonText: "Coba Lagi",
                                confirmButtonColor: "#F12C11",
                                confirmButtonBorder: "#F12C11",
                                showCloseButton: true,
                                timer: "2000"
                            }).then(() => {
                                document.location.href = "index.php";
                            });
                        </script>
                    <?php endif; ?>

                </div>
                <div aria-label="Form" class="mt-3">
                    <form action="" method="post">
                        <div class="mb-2">
                            <label for="" class="form-label"><span class="fs-5 text-danger">*</span> Username :</label>
                            <input type="text" class="form-control py-2" name="username" placeholder="Username..." required>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label"><span class="fs-5 text-danger">*</span> Password :</label>
                            <input type="password" class="form-control py-2" name="password" placeholder="Password..." required>
                        </div>
                        <div class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">Remember me</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success w-100 py-2" name="login" style="border-radius: 20px;">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>