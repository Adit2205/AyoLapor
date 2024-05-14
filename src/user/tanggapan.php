<?php
session_start();

$title = 'Tanggapan';

require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navUser.php';

// Get username from session
$username = $_SESSION['username'];

// logic backend
$filter_tanggal = isset($_POST['filter_tanggal']) ? $_POST['filter_tanggal'] : '';
$filter_telepon = isset($_POST['filter_telepon']) ? $_POST['filter_telepon'] : '';

$query = "SELECT * FROM ((tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan)
          INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas)
          WHERE pengaduan.username = '$username'";

// Buat kondisi WHERE untuk filter tanggal
if (!empty($filter_tanggal)) {
    $query .= " AND pengaduan.tgl_pengaduan = '$filter_tanggal'";
}

// Buat kondisi WHERE untuk filter nomor telepon
if (!empty($filter_telepon)) {
    // Tambahkan kondisi WHERE atau AND jika sudah ada kondisi sebelumnya
    $query .= " AND pengaduan.telp = '$filter_telepon'";
}

$query .= " ORDER BY tanggapan.id_tanggapan DESC";

$result = mysqli_query($conn, $query);

?>

<form action="" method="post" class="mb-3">
  <div class="form-row">
    <div class="col-20">
      <input type="date" class="form-control form-control-sm" id="filter_tanggal" name="filter_tanggal" value="<?= $filter_tanggal ?>" placeholder="Tanggal">
    </div>
    <div class="col-20">
      <input type="text" class="form-control form-control-sm" id="filter_telepon" name="filter_telepon" value="<?= $filter_telepon ?>" placeholder="Telepon">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary btn-sm">Filter</button>
    </div>
  </div>
</form>

<table class="table table-bordered shadow text-center" data-aos="fade-up" data-aos-duration="900">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Telepon</th>
      <th scope="col">Tanggal Laporan</th>
      <th scope="col">Laporan</th>
      <th scope="col">Lokasi</th> <!-- Tambahkan kolom Lokasi -->
      <th scope="col">Tanggal Tanggapan</th>
      <th scope="col">Tanggapan</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama Petugas</th>
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
        <td><?= $row["lokasi"]; ?></td> <!-- Tampilkan lokasi -->
        <td><?= $row["tgl_tanggapan"]; ?></td>
        <td><?= $row["tanggapan"]; ?></td>
        <td><?php 
            $path_foto = $row["foto"]; 
            if (!empty($path_foto)) {
              echo '<img src="../../assets/img/'.$path_foto.'" width="100" alt="Foto Pengaduan" data-toggle="modal" data-target="#fotoModal'.$row["id_pengaduan"].'">';
            } else {
              echo 'Tidak ada foto';
            }
          ?></td>
        <td><?= $row["nama_petugas"]; ?></td>
      </tr>
      <?php $i++; ?>
    <?php endwhile; ?>
  </tbody>
</table>

<?php
mysqli_data_seek($result, 0);
$i = 1;

// Modal for each image
while ($row = mysqli_fetch_assoc($result)) :
?>
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

<?php require '../layouts/footer.php'; ?>
