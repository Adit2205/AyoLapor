<?php

$title = 'Dashboard';

require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navAdmin.php';


// logic backend


// mengambil angka pengaduan dari database
$pengaduan = mysqli_query($conn, "SELECT * FROM pengaduan ORDER BY id_pengaduan  DESC LIMIT 1");

// mengambil angka tanggapan dari database
$tanggapan = mysqli_query($conn, "SELECT * FROM tanggapan ORDER BY id_tanggapan DESC LIMIT 1");

// mengambil angka akun masyarakat dari database
$masyarakat = mysqli_query($conn, "SELECT * FROM masyarakat ORDER BY id_masyarakat  DESC LIMIT 1");

// query untuk menjalankan looping generate
$query = "SELECT * FROM (( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
                          INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas )";

$result = mysqli_query($conn, $query);

?>


<!-- Card -->
<?php while ($row = mysqli_fetch_assoc($pengaduan)) : ?>
    <div class="row mb-3">
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="300">
        <a href="laporan.php" style="text-decoration: none;">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col ml-3">
                                <div class="h5 mb-0 font-weight-bold text-info"><?= $row['id_pengaduan']; ?> Pengaduan</div>
                            </div>
                            <i class="fas fa-comment fa-2x text-gray-500"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endwhile; ?>


    <?php while ($row = mysqli_fetch_assoc($tanggapan)) : ?>
    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700">
        <a href="tanggapan.php" style="text-decoration: none;">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col ml-3">
                            <div class="h5 mb-0 font-weight-bold text-primary"><?= $row['id_tanggapan']; ?> Tanggapan</div>
                        </div>
                        <i class="fas fa-comments fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php endwhile; ?>


   <?php while ($row = mysqli_fetch_assoc($masyarakat)) : ?>
    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700">
        <a href="masyarakat.php" style="text-decoration: none;">
            <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col ml-3">
                            <div class="h5 mb-0 font-weight-bold text-success"><?= $row['id_masyarakat']; ?> Akun Masyarakat</div>
                        </div>
                        <i class="fas fa-users fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php endwhile; ?>


<?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <div class="col-6">
        <div class="card shadow mb-4" data-aos="fade-up">
            <!-- Card Content - Collapse -->
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h6 class="m-0 font-weight-bold text-primary mt-2">No Telepon : <?= $row['telp']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="collapse show" id="generate">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <h6 class="text-primary font-weight-bold">Foto : <img src="../../assets/img/<?= $row['foto']; ?>" width="50" alt="" data-toggle="modal" data-target="#fotoModal<?= $row['id_pengaduan']; ?>"></h6>
                        </div>
                        <div class="col-8">
                            <h6> <span class="text-primary font-weight-bold">Tanggal Pengaduan :</span> <?= $row['tgl_pengaduan']; ?></h6>
                            <h6> <span class="text-primary font-weight-bold">Tanggal Tanggapan :</span> <?= $row['tgl_tanggapan']; ?></h6>
                        </div>
                    </div>
                    <hr class="bg-primary">
                    <h6><span class="text-primary font-weight-bold">Laporan :</span> <?= $row['isi_laporan']; ?></h6>
                    <h6><span class="text-primary font-weight-bold">Tanggapan :</span> <?= $row['tanggapan']; ?></h6>
                    <hr class="bg-primary">
                    <div class="row">
                        <div class="col-8 mt-2">
                            <h5> <span class="text-primary font-weight-bold">Ditanggapi oleh :</span> <?= $row['nama_petugas']; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
