<?php
$host = "localhost";
$username = "root";
$pass = "";
$database = "keuangan";

$conn = new mysqli($host, $username, $pass, $database);

function query($query)
{
    global $conn;
    $result = $conn->query("$query");
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

function selectPemasukan()
{
    $selectPemasukan = query("SELECT * FROM tbl_pemasukan");

    return $selectPemasukan;
}

function tambahPemasukan($tambahPemasukan)
{
    global $conn;
    $dana = htmlspecialchars($tambahPemasukan['dana']);
    $keterangan = htmlspecialchars($tambahPemasukan['keterangan']);
    $tanggal = date("Y-m-d");
    $hari = date("D");

    $conn->query("INSERT INTO tbl_pemasukan VALUES ('','$hari','$tanggal','$dana','$keterangan')");

    return mysqli_affected_rows($conn);
}

function editPemasukan($editPemasukan)
{
    global $conn;
    $dana = htmlspecialchars($editPemasukan['dana']);
    $keterangan = htmlspecialchars($editPemasukan['keterangan']);;

    $conn->query("UPDATE tbl_pemasukan SET dana = '$dana', keterangan = '$keterangan' WHERE id = '$_POST[id]'");

    return mysqli_affected_rows($conn);
}


function selectPengeluaran()
{
    $selectPengeluaran = query("SELECT * FROM tbl_pengeluaran");

    return $selectPengeluaran;
}

function tambahPengeluaran($tambahPengeluaran)
{
    global $conn;
    $dana = htmlspecialchars($tambahPengeluaran['dana']);
    $keterangan = htmlspecialchars($tambahPengeluaran['keterangan']);
    $tanggal = date("Y-m-d");
    $hari = date("D");

    $conn->query("INSERT INTO tbl_pengeluaran VALUES ('','$hari','$tanggal','$dana','$keterangan')");

    return mysqli_affected_rows($conn);
}

function editPengeluaran($editPengeluaran)
{
    global $conn;
    $dana = htmlspecialchars($editPengeluaran['dana']);
    $keterangan = htmlspecialchars($editPengeluaran['keterangan']);;

    $conn->query("UPDATE tbl_pengeluaran SET dana = '$dana', keterangan = '$keterangan' WHERE id = '$_POST[id]'");

    return mysqli_affected_rows($conn);
}

function selectManagement()
{
    $selectManagement = query("SELECT * FROM tbl_user");

    return $selectManagement;
}

function tambahManagement($tambahManagement)
{
    global $conn;
    $nama = htmlspecialchars(ucwords($tambahManagement['nama']));
    $username = htmlspecialchars(strtolower($tambahManagement['username']));
    $password = mysqli_escape_string($conn, $tambahManagement['password']);
    $role = htmlspecialchars(ucwords($tambahManagement['role']));

    $password = password_hash($password, PASSWORD_DEFAULT);
    $file = upload();
    if (!$file) {
        return false;
        exit;
    }

    $conn->query("INSERT INTO tbl_user VALUES ('','$nama','$username','$password','$role','$file','0','','','','')");

    return mysqli_affected_rows($conn);
}

function editManagement($editManagement)
{
    global $conn;
    $nama = htmlspecialchars(ucwords($editManagement['nama']));
    $username = htmlspecialchars(strtolower($editManagement['username']));
    $role = htmlspecialchars(ucwords($editManagement['role']));
    $aktif = htmlspecialchars($editManagement['aktif']);

    $conn->query("UPDATE tbl_user SET nama = '$nama', username = '$username', role = '$role', aktif = '$aktif' WHERE id = '$_POST[id]'");

    return mysqli_affected_rows($conn);
}

// Function Edit Profile
function editFotoProfile($editProfile)
{
    global $conn;

    $file = upload();

    $conn->query("UPDATE tbl_user SET profile = '$file' WHERE id = '$editProfile[id]'");

    return mysqli_affected_rows($conn);
}

function editProfile($editProfile)
{
    global $conn;
    $nama = htmlspecialchars(ucwords($editProfile['nama']));
    $username = htmlspecialchars(strtolower($editProfile['username']));
    $tempat = htmlspecialchars(ucwords($editProfile['tempat']));
    $tanggal = htmlspecialchars(ucwords($editProfile['tanggal']));
    $alamat = htmlspecialchars(ucwords($editProfile['alamat']));
    $telepon = htmlspecialchars(ucwords($editProfile['telepon']));

    $conn->query("UPDATE tbl_user SET nama = '$nama', username = '$username', tempat_lahir = '$tempat', tanggal_lahir = '$tanggal', alamat = '$alamat', telepon = '$telepon' WHERE id = '$editProfile[id]'");

    return mysqli_affected_rows($conn);
}

function upload()
{
    $nama = $_FILES['profiles']['name'];
    $size = $_FILES['profiles']['size'];
    $tempat = $_FILES['profiles']['tmp_name'];

    $extension = ['jpg', 'jpeg', 'png', 'svg'];
    $extensionValid = explode(".", $nama);
    $extensionValid = strtolower(end($extensionValid));

    if (!in_array($extensionValid, $extension)) {
        return false;
        exit;
    }

    if ($size > 2000000) {
        return false;
        exit;
    }

    $names = uniqid();
    $names .= ".";
    $names .= $extensionValid;

    move_uploaded_file($tempat, "../public/img/" . $names);
    return $names;
}
