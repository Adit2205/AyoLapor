<?php

$title = 'Data Masyarakat';

require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navAdmin.php';


// Logic Backend

$result = mysqli_query($conn, "SELECT * FROM masyarakat ");

?>


<div class="card shadow">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Username</th>
            <th scope="col">Password</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $row['nama']; ?></td>
              <td><?= $row['username']; ?></td>
              <td><?= $row['password']; ?></td>
              <td>
                <a href="edit_masyarakat.php?id_masyarakat=<?= $row['id_masyarakat']; ?>" class="btn btn-sm btn-outline-success">Edit</a>
                <a href="hapus_masyarakat.php?id_masyarakat=<?= $row['id_masyarakat']; ?>" class="btn btn-sm btn-outline-danger">Hapus</a>
              </td>
            </tr>
            <?php $i++; ?>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<?php require '../layouts/footer.php'; ?>