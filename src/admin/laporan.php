<?php

$title = 'Laporan Masyarakat';

require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navAdmin.php';


// logic backend

$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status IN ('proses','verify','selesai') ORDER BY id_pengaduan DESC");

?>

<div class="row" data-aos="fade-up">
  <div class="col-6">
    <h3 class="text-gray-800">Daftar Laporan Masyarakat</h3>
  </div>
  <div class="col-6 d-flex justify-content-end">
    <form class="form-inline">
      </button>
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
      <th scope="col">Foto</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <th scope="row"><?= $i; ?>.</th>
        <td><?= $row["tgl_pengaduan"]; ?></td>
        <td><?= $row["telp"]; ?></td>
        <td><?= $row["isi_laporan"]; ?></td>
        <td><a href="#" data-toggle="modal" data-target="#exampleModal<?= $i; ?>"><img src="../../assets/img/<?= $row["foto"]; ?>" width="50"></a></td>
      </tr>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Foto Pengaduan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <img src="../../assets/img/<?= $row["foto"]; ?>" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
      <?php $i++; ?>
    <?php endwhile; ?>
  </tbody>
</table>






<?php require '../layouts/footer.php'; ?>