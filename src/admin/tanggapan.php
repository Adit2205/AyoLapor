<?php

$title = 'Tanggapan';

require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navAdmin.php';

// logic backend
$filter_date = '';
if (isset($_GET['filter_date']) && !empty($_GET['filter_date'])) {
    $filter_date = $_GET['filter_date'];
    // Menyesuaikan kueri SQL dengan filter tanggal yang diberikan
    $query = "SELECT * FROM (( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
              INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas ) WHERE DATE(tanggapan.tgl_tanggapan) = '$filter_date' ORDER BY tanggapan.id_tanggapan DESC";
} else {
    // Kueri SQL tanpa filter tanggal
    $query = "SELECT * FROM (( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
              INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas ) ORDER BY tanggapan.id_tanggapan DESC";
}

$result = mysqli_query($conn, $query);

?>

<!-- Form untuk filter tanggal -->
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <form method="GET" class="form-inline justify-content-end mb-3">
                <div class="form-group">
                    <label for="filter_date" class="mr-2">Filter Tanggal Tanggapan:</label>
                    <input type="date" class="form-control" id="filter_date" name="filter_date" value="<?= $filter_date ?>">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
</div>

<table class="table table-bordered shadow text-center" data-aos="fade-up" data-aos-duration="900">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">No Telepon</th>
            <th scope="col">Tanggal Laporan</th>
            <th scope="col">Laporan</th>
            <th scope="col">Tanggal Tanggapan</th>
            <th scope="col">Tanggapan</th>
            <th scope="col">Nama Petugas</th>
            <th scope="col">Foto</th> <!-- Menambahkan kolom Foto -->
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <th scope="row"><?= $i; ?>.</th>
                <td><?= $row["telp"]; ?></td>
                <td><?= $row["tgl_pengaduan"]; ?></td>
                <td><?= $row["isi_laporan"]; ?></td>
                <td><?= $row["tgl_tanggapan"]; ?></td>
                <td><?= $row["tanggapan"]; ?></td>
                <td><?= $row["nama_petugas"]; ?></td>
                <td>
                    <?php
                    // Ubah path_foto sesuai dengan kolom yang berisi lokasi file foto pada tabel
                    $path_foto = $row["foto"];
                    // Cek apakah path_foto tidak kosong
                    if (!empty($path_foto)) {
                        echo '<img src="../../assets/img/' . $path_foto . '" width="100" alt="Foto Pengaduan" data-toggle="modal" data-target="#fotoModal' . $row["id_pengaduan"] . '">';
                    } else {
                        echo 'Tidak ada foto';
                    }
                    ?>
                </td>
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

            <?php $i++; ?>
        <?php endwhile; ?>
    </tbody>
</table>


<?php require '../layouts/footer.php'; ?>
