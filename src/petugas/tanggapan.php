<?php
$title = 'Tanggapan';
require '../../public/app.php';
require '../layouts/header.php';
require '../layouts/navPetugas.php';

// logic backend
$filter_date = '';
$filter_phone = '';
if (isset($_GET['filter_date'])) {
    $filter_date = $_GET['filter_date'];
}
if (isset($_GET['filter_phone'])) {
    $filter_phone = $_GET['filter_phone'];
}

$query = "SELECT * FROM ( ( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
          INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas ) WHERE 1";

// Menambahkan filter berdasarkan tanggal
if (!empty($filter_date)) {
    $query .= " AND pengaduan.tgl_pengaduan = '$filter_date'";
}

// Menambahkan filter berdasarkan nomor telepon
if (!empty($filter_phone)) {
    $query .= " AND pengaduan.telp = '$filter_phone'";
}

$query .= " ORDER BY tanggapan.id_tanggapan DESC";

$result = mysqli_query($conn, $query);

?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h3 class="text-center mb-4">Tanggapan</h3>
            <div class="table-responsive mb-3">
                <form method="GET" class="form-inline justify-content-between">
                    <div class="input-group"> <!-- Tidak menggunakan 'mr-auto' atau 'ml-3' untuk memastikan posisi tepat -->
                        <label for="filter_phone" class="mr-2">Filter No Telepon:</label>
                        <input type="text" class="form-control" id="filter_phone" name="filter_phone" value="<?= $filter_phone ?>">
                    </div>
                    <div class="input-group ml-3"> <!-- Menambahkan 'ml-3' untuk memberikan jarak antara elemen -->
                        <label for="filter_date" class="mr-2">Filter Tanggal Tanggapan:</label>
                        <input type="date" class="form-control" id="filter_date" name="filter_date" value="<?= $filter_date ?>">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Tabel data tanggapan -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <!-- Table head -->
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="min-width: 50px;">No</th>
                            <th scope="col" style="min-width: 150px;">No Telepon</th>
                            <th scope="col" style="min-width: 150px;">Tanggal Laporan</th>
                            <th scope="col">Laporan</th>
                            <th scope="col" style="min-width: 150px;">Tanggal Tanggapan</th>
                            <th scope="col">Tanggapan</th>
                            <th scope="col" style="min-width: 150px;">Nama Petugas</th>
                            <th scope="col" style="min-width: 150px;">Lokasi</th> <!-- Kolom baru untuk menampilkan lokasi -->
                            <th scope="col" style="min-width: 150px;">Foto</th> <!-- Kolom baru untuk menampilkan foto -->
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?>.</th>
                                <td style="min-width: 150px;"><?= $row["telp"]; ?></td>
                                <td><input type="text" class="form-control bg-transparent border-0" style="min-width: 150px;" value="<?= $row["tgl_pengaduan"]; ?>" readonly></td>
                                <td style="white-space: pre-wrap;"><?= $row["isi_laporan"]; ?></td>
                                <td><?= $row["tgl_tanggapan"]; ?></td>
                                <td><?= $row["tanggapan"]; ?></td>
                                <td><?= $row["nama_petugas"]; ?></td>
                                <td><?= $row["lokasi"]; ?></td> <!-- Tampilkan lokasi -->
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
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
