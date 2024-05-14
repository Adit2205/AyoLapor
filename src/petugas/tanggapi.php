<?php
session_start();
$title = 'Tanggapan';
require '../../public/app.php';
require '../layouts/header.php';
require '../layouts/navPetugas.php';

// Logic backend
$id = $_GET["id_pengaduan"];

$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = $id");

// Ambil id petugas dari session
$id_petugas = $_SESSION['id_petugas'];

if (isset($_POST["submit"])) {
    // Mendapatkan tanggal hari ini
    $tgl_tanggapan = date('Y-m-d');
    
    $_POST['tgl_tanggapan'] = $tgl_tanggapan;
    $_POST['id_petugas'] = $id_petugas; // Tambahkan id petugas ke dalam data tanggapan

    if (tanggapan($_POST) > 0) {
        $sukses = true;
    } else {
        $error = true;
    }
}
?>

<div class="d-flex justify-content-center">
    <div class="card w-75 shadow">
        <div class="card-body">
            <?php if (isset($sukses)) : ?>
                <div class="alert alert-dismissible fade show" data-aos="zoom-in" style="background-color: #3bb849;" role="alert">
                    <h6 class="text-gray-100 mt-2">Berhasil menanggapi, Terima kasih sudah menanggapi aduan masyarakat </h6>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (isset($error)) : ?>
                <div class="alert alert-dismissible fade show" data-aos="zoom-in" style="background-color: #b52d2d;" role="alert">
                    <h6 class="text-light mt-2">Maaf Laporan sudah di tanggapi</h6>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-6">
                    <div class="image">
                        <img src="../../assets/img/tanggapan.svg" width="350" alt="">
                    </div>
                </div>
                <div class="col-6">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <form action="" method="POST">
                            <div class="form-row mb-2">
                                <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
                                <div class="col">
                                    <label for="telp">No Telepon</label>
                                    <input type="text" class="form-control" id="telp" name="telp" value="<?= $row['telp']; ?>" readonly>
                                </div>
                                <div class="col">
                                    <label for="tgl_tanggapan">Tanggal Tanggapan</label>
                                    <input type="text" class="form-control" id="tgl_tanggapan" name="tgl_tanggapan" value="<?= date('Y-m-d'); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="isi_laporan">Isi laporan</label>
                                <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="3" readonly><?= $row['isi_laporan']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $row['lokasi']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggapan">Tanggapan</label>
                                <textarea class="form-control" id="tanggapan" name="tanggapan" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="petugas">Petugas</label>
                                <input type="text" class="form-control" id="petugas" name="petugas" value="<?= $_SESSION['nama_petugas']; ?>" readonly>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">OK!</button>
                        </form>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
