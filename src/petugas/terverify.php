<?php
$title = 'Laporan Terverifikasi';
require '../../public/app.php';
require '../layouts/header.php';
require '../layouts/navPetugas.php';

// Ambil data pengaduan yang sudah terverifikasi
$query = "SELECT * FROM pengaduan WHERE status = 'verify'";

// Filter berdasarkan tanggal
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

if (!empty($start_date) && !empty($end_date)) {
    $query .= " AND tgl_pengaduan BETWEEN '$start_date' AND '$end_date'";
}

$query .= " ORDER BY id_pengaduan DESC";

$result = mysqli_query($conn, $query);
?>

<div class="row" data-aos="fade-up">
    <div class="col-6">
        <h3 class="text-gray-800">Daftar Laporan Yang sudah terverifikasi</h3>
    </div>
    <div class="col-6 d-flex justify-content-end">
        <form class="form-inline">
            <input type="date" class="form-control mr-2" name="start_date" value="<?= $start_date ?>" placeholder="Start Date">
            <input type="date" class="form-control mr-2" name="end_date" value="<?= $end_date ?>" placeholder="End Date">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>

<hr>

<table class="table table-bordered shadow-sm text-center" data-aos="fade-up" data-aos-duration="700">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">No Telepon</th>
            <th scope="col">Isi Laporan</th>
            <th scope="col">Foto</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $counter = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <th scope="row"><?= $counter++; ?></th>
                <td><?= $row["tgl_pengaduan"]; ?></td>
                <td><?= $row["telp"]; ?></td>
                <td><?= $row["isi_laporan"]; ?></td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#fotoModal<?= $row["id_pengaduan"]; ?>">
                        <img src="../../assets/img/<?= $row["foto"]; ?>" width="50">
                    </a>
                </td>
                <td><?= $row["lokasi"]; ?></td>
                <td><a href="tanggapi.php?id_pengaduan=<?= $row["id_pengaduan"]; ?>" class="btn btn-outline-success">Tanggapi</a></td>
            </tr>
            <!-- Modal untuk foto -->
            <div class="modal fade" id="fotoModal<?= $row["id_pengaduan"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Foto Laporan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="../../assets/img/<?= $row["foto"]; ?>" class="img-fluid">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </tbody>
</table>

<?php require '../layouts/footer.php'; ?>
