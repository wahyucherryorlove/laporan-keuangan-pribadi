<?php
$page = "managementUser";
require "menu.php";

// Tambah Data
if (isset($_POST['add'])) {
    if (tambahManagement($_POST) > 0) {
        echo "
        <script>
            Swal.fire({
                title: 'Success...',
                text: 'Data Berhasil Di Tambahkan!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'management-user.php'; 
            });
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Oppss...',
                text: 'Data Gagal Di Tambahkan!',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'management-user.php'; 
            });
        </script>
        ";
    }
}
// Tambah Data End

// Edit Data
if (isset($_POST['edit'])) {
    if (editManagement($_POST) > 0) {
        echo "
        <script>
            Swal.fire({
                title: 'Success...',
                text: 'Data Berhasil Di Edit!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'management-user.php'; 
            });
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Oppss...',
                text: 'Data Gagal Di Edit!',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'management-user.php'; 
            });
        </script>
        ";
    }
}
// Edit Data End

// Delete
if (isset($_GET['delete'])) {
    if ($conn->query("DELETE FROM tbl_user WHERE id = '$_GET[delete]'")) {
        echo "
        <script>
            Swal.fire({
                title: 'Success...',
                text: 'Data Berhasil Di Hapus!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'management-user.php'; 
            });
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Opps...',
                text: 'Data Gagal Di Hapus!',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'management-user.php'; 
            });
        </script>
        ";
    }
}
// Delete End
?>

<!-- Thumbnail Data -->
<section class="containers">
    <div class="title-page mb-4 d-sm-flex justify-content-between align-items-center">
        <h4 class="">Management User</h4>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../logout.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Management User</li>
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
                <div class="card-header d-sm-flex align-items-center justify-content-between">
                    <a class="btn btn-success d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#modal">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="overflow-hidden overflow-md-auto px-2 py-2" id="selectData">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Role Users</th>
                                    <th>Status Aktif</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $query1 = $conn->query("SELECT * FROM tbl_user ORDER BY id DESC");
                                while ($item = $query1->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td class="text-start"><?= $item['nama'] ?></td>
                                        <td><?= $item['username'] ?></td>
                                        <td><?= $item['role'] ?></td>
                                        <td>
                                            <?php
                                            if ($item['aktif'] === "0") { ?>
                                                <span class="btn btn-danger btn-sm rounded-pill disabled">
                                                    <svg class="bi flex-shrink-0" width="17" height="17" role="img" aria-label="Info:">
                                                        <use xlink:href="#exclamation-triangle-fill" />
                                                    </svg>
                                                    Offline
                                                </span>
                                            <?php  } else { ?>
                                                <span class="btn btn-success btn-sm rounded-pill">
                                                    <svg class="bi flex-shrink-0" width="17" height="17" role="img" aria-label="Info:">
                                                        <use xlink:href="#check-circle-fill" />
                                                    </svg>
                                                    Active
                                                </span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#edit<?= $item['id'] ?>" class="btn btn-sm btn-warning">Edit</a> || <a data-href="management-user.php?delete=<?= $item['id']; ?>" id="delete" class="delete btn-sm btn-danger btn">Delete</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Data End -->

<!-- ADD Data -->
<div class="modal fade" id="modal" aria-labelledby="exampleModalLabel" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="" class="form-label">Nama Users</label>
                                <input type="text" name="nama" id="" maxlength="40" class="form-control text-capitalize" placeholder="Nama User..." required>
                                <div class="form-text">Maximal 40 Caracter</div>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Username</label>
                                <input type="text" name="username" id="" maxlength="40" minlength="5" class="form-control" placeholder="Username..." required>
                                <div class="form-text">Maximal 40 Caracter</div>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Password</label>
                                <input type="text" name="password" id="" class="form-control" maxlength="30" placeholder="Password..." required>
                                <div class="form-text">Maximal 30 Caracter</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="" class="form-label">Role User</label>
                                <select name="role" id="" class="form-select" required>
                                    <option value="">Role User</option>
                                    <option value="Administrasi">Administrator</option>
                                    <option value="Petugas">Petugas</option>
                                    <option value="Client">Client</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Profile</label>
                                <input type="file" name="profiles" id="" class="form-control" required>
                                <div class="form-text">File maximal 2 mb</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="add" class="btn btn-primary">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ADD Data End -->


<?php foreach (selectManagement() as $item) : ?>
    <!-- Edit Data -->
    <div class="modal fade" id="edit<?= $item['id'] ?>" aria-labelledby="exampleModalLabel" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Management Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-2">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>" readonly>
                            <label for="" class="form-label">Nama Users</label>
                            <input type="text" name="nama" id="" maxlength="40" class="form-control text-capitalize" placeholder="Nama User..." required value="<?= $item['nama'] ?>">
                            <div class="form-text">Maximal 40 Caracter</div>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" id="" minlength="3" maxlength="40" class="form-control" placeholder="Username..." required value="<?= $item['username'] ?>">
                            <div class="form-text">Maximal 40 Caracter</div>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Role User</label>
                            <select name="role" id="" class="form-select">
                                <option value="<?= $item['role'] ?>"><?= $item['role'] ?></option>
                                <option value="Administrasi">Administrator</option>
                                <option value="Petugas">Petugas</option>
                                <option value="Client">Client</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Status Aktif</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="aktif" id="utama" value="<?= $item['aktif'] ?>" checked>
                                <label class="form-check-label" for="utama">
                                    <?php
                                    if ($item['aktif'] === "0") {
                                        echo "Tidak Aktif";
                                    } else {
                                        echo "Aktif";
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="aktif" id="Tidak Aktif" value="0">
                                <label class="form-check-label" for="Tidak Aktif">
                                    Tidak Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="aktif" id="Aktif" value="1">
                                <label class="form-check-label" for="Aktif">
                                    Aktif
                                </label>
                            </div>
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

<!-- Script Tampil Data -->
<script>
    $(document).ready(function() {
        // Delete Data
        $(".delete").on("click", function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success me-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Apakah kamu yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = $(this).attr("data-href");
                    window.location.href = url;
                }
            })
        });
        // Delete Data End
    });
</script>