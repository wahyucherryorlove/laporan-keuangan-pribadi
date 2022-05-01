<?php
$page = "Profile";
require "menu.php";

// Edit Data
if (isset($_POST['edit'])) {
    if (editFotoProfile($_POST) > 0) {
        echo "
        <script>
            Swal.fire({
                title: 'Success...',
                text: 'Profile Berhasil Di Edit!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'profile.php'; 
            });
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Oppss...',
                text: 'Profil Gagal Di Edit!',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'profile.php'; 
            });
        </script>
        ";
    }
}

if (isset($_POST['editProfile'])) {
    if (editProfile($_POST) > 0) {
        echo "
        <script>
            Swal.fire({
                title: 'Success...',
                text: 'Profile Berhasil Di Edit!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'profile.php'; 
            });
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Oppss...',
                text: 'Profil Gagal Di Edit!',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'profile.php'; 
            });
        </script>
        ";
    }
}
// Edit Data End
?>

<style>
    .bi-telephone-inbound-fill {
        fill: #0d6efd;
        transition: .3s;
    }

    #contactMe:hover>.bi-telephone-inbound-fill {
        fill: #ffffff;
    }

    table th {
        font-family: sans-serif;
    }

    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }

    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>

<!-- Thumbnail Data -->
<section class="containers">
    <div aria-label="Report Page Profile User">
        <div class="alert bg-primary text-light alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
            </svg>
            <strong>Welcome <?= $result['nama'] ?>!</strong> Silahkan update profile Anda. <strong>Terima kasih!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="title-page mb-4 d-sm-flex justify-content-between align-items-center">
        <div>
            <span>Overview</span>
            <h4 class="d-block" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">Profile User</h4>
        </div>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../logout.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile User</li>
            </ol>
        </nav>
    </div>
</section>
<!-- Thumbnail End -->

<!-- Table Data -->
<section class="containers mb-2" style="margin-top: -20px;">
    <div class="row py-2 justify-content-between">
        <!-- Profile Image -->
        <div class="col-md-4">
            <div class="rounded-3 border shadow-lg mb-lg-0 mb-3">
                <div class="head text-center pt-4 pb-2">
                    <img src="../public/img/<?= $result['profile'] ?>" id="profile" class="rounded-circle border shadow-lg border-light border-3" width="120" height="120" alt="<?= $result['nama'] ?>">
                </div>
                <div class="body mt-2 pb-4">
                    <div class="text-center" aria-label="Nama User && Role">
                        <h5 class="fs-4" style="font-family: Arial;"><?= $result['nama'] ?></h5>
                        <figcaption style="margin-top: -7px; font-family: Verdana, Geneva, Tahoma, sans-serif;" class="fs-6">
                            <?= $result['role'] ?>
                        </figcaption>
                    </div>
                    <div class="text-center" aria-label="Contact User" style="margin-top: 14px;">
                        <!-- Profile Change -->
                        <div class="fileUpload btn btn-outline-primary rounded-pill btn-sm" id="contactMe" data-bs-toggle="modal" data-bs-target="#editFoto<?= $result['id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-telephone-inbound-fill me-1" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                            <span>Edit Profil</span>
                            <!-- <input class="upload" type="file" /> -->
                        </div>
                        <!-- Profile Change End -->

                        <!-- Contact Us -->
                        <a href="#" class="rounded-pill btn btn-sm btn-outline-primary" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;" id="contactMe">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="bi bi-telephone-inbound-fill me-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0z" />
                            </svg>
                            <span class="fs-6">Contact Me</span>
                        </a>
                        <!-- ContactUs End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Image End -->

        <!-- Profile Form -->
        <div class="col-md-8 ps-lg-4 pe-lg-3">
            <div class="rounded-3 shadow-lg border px-3 py-3">
                <div class="head d-flex justify-content-between align-items-center">
                    <h4 class="title fs-4" style="font-family: Arial, Helvetica, sans-serif;">User Details</h4>
                    <button type="button" class="btn btn-sm btn-primary" style="font-family: sans-serif;" data-bs-toggle="modal" data-bs-target="#edit<?= $result['id'] ?>"><img src="../public/icons/edit.svg" alt="Edit Data" class="me-2">Edit</button>
                </div>
                <div class="body overflow-md-auto">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="d-flex align-items-center">
                                <th>
                                    <span>Nama Lengkap</span>
                                </th>
                                <td style="margin-left: 63px;">:</td>
                                <td>
                                    <span><?= $result['nama'] ?></span>
                                </td>
                            </tr>
                            <tr class="d-flex align-items-center">
                                <th>
                                    <span>Tempat, Tanggal Lahir</span>
                                </th>
                                <td class="ms-2">:</td>
                                <td>
                                    <span><?= $result['tempat_lahir'] ?>, <?= date("d-m-Y", strtotime($result['tanggal_lahir'])) ?></span>
                                </td>
                            </tr>
                            <tr class="d-flex align-items-center">
                                <th>
                                    <span>Alamat</span>
                                </th>
                                <td style="margin-left: 125px;">:</td>
                                <td>
                                    <span><?= $result['alamat'] ?></span>
                                </td>
                            </tr>
                            <tr class="d-flex align-items-center">
                                <th>
                                    <span>Email</span>
                                </th>
                                <td style="margin-left: 136px;">:</td>
                                <td>
                                    <a href="mailto:<?=$result['username']?>" target="_blank"><?= $result['username'] ?></a>
                                </td>
                            </tr>
                            <tr class="d-flex align-items-center">
                                <th>
                                    <span>Telepon</span>
                                </th>
                                <td style="margin-left: 120px;">:</td>
                                <td>
                                    <span><?= $result['telepon'] ?></span>
                                </td>
                            </tr>
                            <tr class="d-flex mt-1">
                                <td>
                                    <span class="btn btn-success btn-sm rounded-pill">
                                        <svg class="bi flex-shrink-0" width="17" height="17" role="img" aria-label="Info:">
                                            <use xlink:href="#check-circle-fill" />
                                        </svg>
                                        Active
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Profile Form End -->

    </div>
</section>
<!-- Table Data End -->

<?php foreach (selectManagement() as $item) : ?>
    <!-- Edit Data -->
    <div class="modal fade" id="editFoto<?= $result['id'] ?>" aria-labelledby="exampleModalLabel" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Foto Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-2">
                            <input type="hidden" name="id" value="<?= $result['id'] ?>" readonly>
                            <div class="text-center mb-3">
                                <img src="../public/img/<?= $result['profile'] ?>" alt="" width="130" height="130" class="">
                            </div>
                            <input type="file" name="profiles" id="" class="form-control text-capitalize" placeholder="Nama User..">
                            <div class="form-text">Ukuran maximal 2 mb</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button name="edit" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Data End -->
<?php endforeach; ?>

<?php foreach (selectManagement() as $item) : ?>
    <!-- Edit Data -->
    <div class="modal fade" id="edit<?= $result['id'] ?>" aria-labelledby="exampleModalLabel" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <input type="hidden" name="id" value="<?= $result['id'] ?>" readonly>
                                    <label for="" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" value="<?= $result['nama'] ?>" class="form-control text-capitalize" required maxlength="30">
                                    <div class="form-text">Maximal 30 caracter</div>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" name="username" value="<?= $result['username'] ?>" class="form-control" required maxlength="80">
                                    <div class="form-text">Maximal 80 caracter</div>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tempat" value="<?= $result['tempat_lahir'] ?>" class="form-control text-capitalize" required>
                                    <div class="form-text">Sesuaikan dengan KTP atau KK Anda</div>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal" value="<?= $result['tanggal_lahir'] ?>" class="form-control" required>
                                    <div class="form-text">Sesuaikan dengan KTP atau KK Anda</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Alamat Sekarang</label>
                                    <textarea type="text" name="alamat" value="<?= $result['alamat'] ?>" rows="7" class="form-control" required><?= $result['alamat'] ?></textarea>
                                    <div class="form-text">Alamat yang anda tempati sekarang</div>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Telepon</label>
                                    <input type="number" name="telepon" value="<?= $result['telepon'] ?>" class="form-control" required maxlength="13">
                                    <div class="form-text">Nomor yang bisa dihubungi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button name="editProfile" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Data End -->
<?php endforeach; ?>