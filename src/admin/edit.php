<?php

$title = 'Tambah Petugas';

require '../../public/app.php';

require '../layouts/header.php';

require '../layouts/navAdmin.php';

$id = $_GET["id_petugas"];

$result = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = $id");

if (isset($_POST["submit"])) {

  if (editPetugas($_POST) >= 0) {
    $sukses = true;
  } else {
    echo mysqli_error($conn);
  }
}

?>


<?php if (isset($sukses)) : ?>

  <div class="alert alert-dismissible fade show" style="background-color: #3bb849;" role="alert">
    <h5 class="text-gray-100 mt-2">Akun Petugas Berhasil Diubah!</h5>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true" class="text-light">&times;</span>
    </button>
  </div>

<?php endif; ?>

<?php if (isset($error)) : ?>

  <div class="alert alert-dismissible fade show" style="background-color: #b52d2d;" role="alert">
    <h6 class="text-light mt-2">Maaf akun petugas gagal diubah</h6>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true" class="text-light">&times;</span>
    </button>
  </div>

<?php endif; ?>
<div class="p-5">
  <div class="row">
    <div class="col-6">
      <div class="image">
        <img src="../../assets/img/officer.svg" width="450" alt="">
      </div>
    </div>
    <div class="col-6">
      <form action="" method="POST">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
         <div class="form-group">
    <label for="id_petugas">
    <input type="hidden" id="id_petugas" class="form-control py-4 shadow-sm" value="<?= $row['id_petugas']; ?>" style="border-radius: 25px;" name="id_petugas">
</div>
<div class="form-group">
    <label for="nama_petugas">Nama Petugas:</label>
    <input type="text" id="nama_petugas" class="form-control py-4 shadow-sm" value="<?= $row['nama_petugas']; ?>" style="border-radius: 25px;" name="nama_petugas">
</div>
<div class="form-group">
    <label for="username">Username:</label>
    <input type="text" id="username" class="form-control py-4 shadow-sm" value="<?= $row['username']; ?>" style="border-radius: 25px;" name="username">
</div>
<div class="form-group">
  <label for="password">Password:</label>
  <div class="input-group">
    <input type="password" id="password" class="form-control py-4 shadow-sm" placeholder="••••••••" value="<?= $row['password']; ?>" name="password">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
    </div>
  </div>
</div>
<div class="form-group">
    <label for="telpon">Telpon:</label>
    <input type="number" id="telpon" class="form-control py-4 shadow-sm" value="<?= $row['telpon']; ?>" style="border-radius: 25px;" name="telpon">
</div>
<div class="form-group">
    <label for="level">
    <input type="hidden" id="level" class="form-control py-4 shadow-sm" value="<?= $row['level']; ?>" style="border-radius: 25px;" name="level">
</div>
<div class="button">
    <button class="btn btn-primary shadow-sm py-2 col-12" name="submit" style="border-radius: 25px;">Submit</button>
</div>

          </div>
        <?php endwhile; ?>
      </form>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    
    togglePasswordButton.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      
      // Change icon based on the type
      if (type === 'password') {
        togglePasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
      } else {
        togglePasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
      }
    });
  });
</script>


<?php require '../layouts/footer.php'; ?>