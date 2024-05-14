<?php
session_start();

$title = 'Laporan Masyarakat';

require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navPetugas.php';

// Check if user is logged in
if (!isset($_SESSION['id_petugas']) || !isset($_SESSION['nama_petugas'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit;
}

$id_petugas = $_SESSION['id_petugas'];
$nama_petugas = $_SESSION['nama_petugas'];

// Logic backend
$filter_start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$filter_end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$query = "SELECT * FROM pengaduan WHERE status = 'proses' AND petugas = $id_petugas";

// Menambahkan filter tanggal ke dalam query jika nilai filter telah diset
if (!empty($filter_start_date) && !empty($filter_end_date)) {
    $query .= " AND tgl_pengaduan BETWEEN '$filter_start_date' AND '$filter_end_date'";
}

$query .= " ORDER BY id_pengaduan DESC";

$result = mysqli_query($conn, $query);
?>

<div class="row" data-aos="fade-up">
  <div class="col-6">
    <h3 class="text-gray-800">Daftar Laporan Masyarakat</h3>
  </div>
  <div class="col-6 d-flex justify-content-end">
    <form class="form-inline">
      <input type="date" class="form-control mr-2" name="start_date" value="<?= $filter_start_date ?>" placeholder="Start Date">
      <input type="date" class="form-control mr-2" name="end_date" value="<?= $filter_end_date ?>" placeholder="End Date">
      <button type="submit" class="btn btn-primary">Filter</button>
    </form>
  </div>
</div>

<hr>

<table class="table table-bordered shadow-sm text-center" data-aos="fade-up" data-aos-duration="700">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal</th>
      <th scope="col">No Telepon</th>
      <th scope="col">Isi Laporan</th>
      <th scope="col">Lokasi</th> <!-- Kolom Lokasi -->
      <th scope="col">Foto</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?= $row["id_pengaduan"]; ?></td>
        <td><?= $row["tgl_pengaduan"]; ?></td>
        <td><?= $row["telp"]; ?></td>
        <td><?= $row["isi_laporan"]; ?></td>
        <td><?= $row["lokasi"]; ?></td> <!-- Tampilkan Lokasi -->
        <td><img src="../../assets/img/<?= $row["foto"]; ?>" class="img-thumbnail" width="50" data-toggle="modal" data-target="#fotoModal<?= $row["id_pengaduan"]; ?>"></td>
        <td>
          <a href="verify.php?id_pengaduan=<?= $row["id_pengaduan"]; ?>" class="btn btn-success">Verify</a>
        </td>
      </tr>

      <!-- Modal -->
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
