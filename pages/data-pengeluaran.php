<?php
$page = "Pengeluaran";
require "menu.php";

// Tambah Data
if (isset($_POST['add'])) {
    if (tambahPengeluaran($_POST) > 0) {
        echo "
        <script>
            Swal.fire({
                title: 'Success...',
                text: 'Data Berhasil Di Tambahkan!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'data-pengeluaran.php'; 
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
                document.location.href = 'data-pengeluaran.php'; 
            });
        </script>
        ";
    }
}
// Tambah Data End

// Edit Data
if (isset($_POST['edit'])) {
    if (editPengeluaran($_POST) > 0) {
        echo "
        <script>
            Swal.fire({
                title: 'Success...',
                text: 'Data Berhasil Di Edit!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'data-pengeluaran.php'; 
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
                document.location.href = 'data-pengeluaran.php'; 
            });
        </script>
        ";
    }
}
// Edit Data End

// Delete
if (isset($_GET['delete'])) {
    if ($conn->query("DELETE FROM tbl_Pengeluaran WHERE id = '$_GET[delete]'")) {
        echo "
        <script>
            Swal.fire({
                title: 'Success...',
                text: 'Data Berhasil Di Hapus!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Selesai!'
            }).then( ()=> {
                document.location.href = 'data-pengeluaran.php'; 
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
                document.location.href = 'data-pengeluaran.php'; 
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
        <h4 class="">Dana Pengeluaran</h4>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../logout.php" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pengeluaran</li>
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
                <?php if (($_SESSION['roles'] === "Administrasi") || ($_SESSION['roles'] === "Petugas")) : ?>
                    <div class="card-header d-sm-flex align-items-center justify-content-between">
                        <a class="btn btn-success d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#modal">Tambah Data</a>
                        <div id="waktu" class="btn btn-primary px-2 rounded-pill btn-sm"></div>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="overflow-hidden overflow-md-auto px-2 py-2" id="selectData">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hari / Tanggal</th>
                                    <th>Dana Pengeluaran</th>
                                    <th>Keterangan</th>
                                    <?php if (($_SESSION['roles'] === "Administrasi") || ($_SESSION['roles'] === "Petugas")) : ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $query1 = $conn->query("SELECT * FROM tbl_pengeluaran ORDER BY id DESC");
                                while ($item = $query1->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= date("l", strtotime($item['hari'])) ?>, <?= date("d F Y", strtotime($item['tanggal'])) ?></td>
                                        <td class="text-start" style="width: 200px;">Rp. <?= $item['dana'] ?></td>
                                        <td class="text-start" style="width: 300px;"><?= $item['keterangan'] ?></td>
                                        <?php if (($_SESSION['roles'] === "Administrasi") || ($_SESSION['roles'] === "Petugas")) : ?>
                                            <td>
                                                <a href="cetak-per-pengeluaran.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-info">Cetak</a> || <a href="#" data-bs-toggle="modal" data-bs-target="#edit<?= $item['id'] ?>" class="btn btn-sm btn-warning">Edit</a> || <a data-href="data-pengeluaran.php?delete=<?= $item['id']; ?>" id="delete" class="delete btn-sm btn-danger btn">Delete</a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tbody>
                                <?php
                                $query2 = $conn->query("SELECT SUM(dana) as danas FROM tbl_Pengeluaran ORDER BY id DESC");
                                $item1 = $query2->fetch_assoc();
                                ?>
                                <tr class="border-0 border-white">
                                    <td colspan="2">Total Pengeluaran</td>
                                    <td class="text-start">Rp. <?= $item1['danas'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <a href="pengeluaran-cetak.php" class="btn btn-info mt-4 btn-sm">Cetak Data</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table Data End -->

<!-- ADD Data -->
<div class="modal fade" id="modal" aria-labelledby="exampleModalLabel" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dana Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="" class="form-label">Dana Pengeluaran</label>
                        <input type="number" name="dana" id="" class="form-control" placeholder="Dana Pengeluaran..." required>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="" rows="5" class="form-control" placeholder="Keterangan..." required></textarea>
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


<?php foreach (selectPengeluaran() as $item) : ?>
    <!-- Edit Data -->
    <div class="modal fade" id="edit<?= $item['id'] ?>" aria-labelledby="exampleModalLabel" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Dana Pengeluaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="" class="form-label">Hari / Tanggal</label>
                            <input type="hidden" name="id" value="<?= $item['id'] ?>" readonly>
                            <input class="form-control disabled" value="<?= date('l', strtotime($item['hari'])) ?>, <?= date('d F Y', strtotime($item['tanggal'])) ?>" readonly>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Dana Pengeluaran</label>
                            <input type="number" name="dana" id="" class="form-control" placeholder="Dana Pengeluaran..." value="<?= $item['dana'] ?>" required>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="" rows="5" class="form-control" placeholder="Keterangan..." required><?= $item['keterangan'] ?></textarea>
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

<script type="text/javascript">
    var tempat = <?= date_default_timezone_set('Asia/Makassar'); ?>;
    var detik = <?= date('s'); ?>;
    var menit = <?= date('i'); ?>;
    var jam   = <?= date('H'); ?>;
     
    function clock()
    {
        if (detik!=0 && detik%60==0) {
            menit++;
            detik=0;
        }
        second = detik;
         
        if (menit!=0 && menit%60==0) {
            jam++;
            menit=0;
        }
        minute = menit;
         
        if (jam!=0 && jam%24==0) {
            jam=0;
        }
        hour = jam;
         
        if (detik<10){
            second='0'+detik;
        }
        if (menit<10){
            minute='0'+menit;
        }
         
        if (jam<10){
            hour='0'+jam;
        }
        waktu = hour+':'+minute+':'+second;
         
        document.getElementById("waktu").innerHTML = waktu;
        detik++;
    }
 
    setInterval(clock,1000);
</script>