<?php
session_start();
$title = 'Laporan';

require '../../public/app.php';
require '../layouts/header.php';
require '../layouts/navUser.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$filter_start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$filter_end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$user_id = $_SESSION['username']; // Assuming user ID is stored in session

$query = "SELECT * FROM pengaduan WHERE status IN ('proses', 'verify', 'selesai') AND username = '$user_id'";

if (!empty($filter_start_date) && !empty($filter_end_date)) {
    $query .= " AND tgl_pengaduan BETWEEN '$filter_start_date' AND '$filter_end_date'";
}

$query .= " ORDER BY id_pengaduan DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<div class="row" data-aos="fade-up">
    <div class="col-6">
        <h3 class="text-gray-800">Daftar Laporan Masyarakat</h3>
    </div>
    <div class="col-6 d-flex justify-content-end">
        <a href="buatLaporan.php" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Buat Laporan</span>
        </a>
    </div>
</div>

<hr>

<form method="GET" class="form-inline mb-3">
    <div class="form-group">
        <input type="date" class="form-control" name="start_date" value="<?= $filter_start_date ?>" placeholder="Start Date">
        <input type="date" class="form-control" name="end_date" value="<?= $filter_end_date ?>" placeholder="End Date">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>

<table class="table table-bordered shadow-sm text-center" data-aos="fade-up" data-aos-duration="700">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Username</th>
            <th scope="col">Tanggal</th>
            <th scope="col">No Telepon</th>
            <th scope="col">Isi Laporan</th>
            <th scope="col">Foto</th>
            <th scope="col">Lokasi</th> <!-- Menambahkan kolom Lokasi -->
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <th scope="row"><?= $i; ?>.</th>
                <td><?= $row["username"]; ?></td>
                <td><?= $row["tgl_pengaduan"]; ?></td>
                <td><?= $row["telp"]; ?></td>
                <td><?= $row["isi_laporan"]; ?></td>
                <td><img src="../../assets/img/<?= $row["foto"]; ?>" width="50"></td>
                <td><?= $row["lokasi"]; ?></td> <!-- Menampilkan lokasi -->
                <td><?= $row["status"]; ?></td>
                <td>
                    <?php if ($row["status"] == "verify") : ?>
                        <a href="updateStatus.php?id=<?= $row['id_pengaduan']; ?>&status=selesai" class="btn btn-success btn-sm">Selesai</a>
                    <?php endif; ?>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#fotoModal<?= $i; ?>">
                        Lihat
                    </button>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endwhile; ?>
    </tbody>
</table>

<?php require '../layouts/footer.php'; ?>

<!-- Modal -->
<?php
mysqli_data_seek($result, 0); // Reset pointer
$i = 1;
while ($row = mysqli_fetch_assoc($result)) :
?>
    <div class="modal fade" id="fotoModal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel<?= $i; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fotoModalLabel<?= $i; ?>">Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="../../assets/img/<?= $row["foto"]; ?>" class="img-fluid" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $i++;
endwhile; ?>

