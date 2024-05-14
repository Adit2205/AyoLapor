<?php

$title = 'Data Petugas';

require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navAdmin.php';


// Logic Backend

$result = mysqli_query($conn, "SELECT * FROM petugas WHERE level = 'petugas'");

?>



<table class="table table-bordered table-striped text-center shadow">
  <thead class="thead-dark">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">Telepon</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><b><?= $i; ?></b></td>
        <td><b><?= $row['nama_petugas']; ?><b></td>
        <td><b><?= $row['username']; ?><b></td>
        <td><b>*****<b></td>
        <td><b><?= $row['telpon']; ?><b></td>
        <td>
          <a href="edit.php?id_petugas=<?= $row['id_petugas']; ?>" class="btn btn-sm btn-outline-success">Edit</a>
          <a href="hapus.php?id_petugas=<?= $row['id_petugas']; ?>" class="btn btn-sm btn-outline-danger">Hapus</a>
        </td>
      </tr>
      <?php $i++; ?>
    <?php endwhile; ?>
    <tr>
      <td colspan="5"></td>
      <td>
        <a href="tambah.php" class="btn btn-sm btn-outline-primary">Tambah Petugas</a>
      </td>
    </tr>
  </tbody>
</table>

<?php require '../layouts/footer.php'; ?>
