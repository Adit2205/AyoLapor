<?php

$title = 'Edit Masyarakat';

require '../../public/app.php';
require '../layouts/header.php';
require '../layouts/navAdmin.php';

// Ambil id masyarakat dari parameter GET
$id = $_GET["id_masyarakat"] ?? '';

// Ambil data masyarakat dari database
$query = "SELECT * FROM masyarakat WHERE id_masyarakat = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (isset($_POST["submit"])) {
    // Ambil data dari form
    $id = $_POST['id_masyarakat'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Lakukan validasi data
    if (!empty($nama) && !empty($username) && !empty($password)) {
        // Update data masyarakat
        $update_query = "UPDATE masyarakat SET nama=?, username=?, password=? WHERE id_masyarakat=?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "sssi", $nama, $username, $password, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            $sukses = true;
        } else {
            $error = true;
            echo mysqli_error($conn);
        }
    } else {
        $error = true;
    }
}

?>

<?php if (isset($sukses)) : ?>
  <div class="alert alert-dismissible fade show" style="background-color: #3bb849;" role="alert">
    <h5 class="text-gray-100 mt-2">Akun Masyarakat Berhasil Diubah!</h5>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true" class="text-light">&times;</span>
    </button>
  </div>
<?php endif; ?>

<?php if (isset($error)) : ?>
  <div class="alert alert-dismissible fade show" style="background-color: #b52d2d;" role="alert">
    <h6 class="text-light mt-2">Maaf, akun masyarakat gagal diubah</h6>
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
          <input type="hidden" id="id_masyarakat" class="form-control py-4 shadow-sm" value="<?= $row['id_masyarakat']; ?>" name="id_masyarakat">
          <div class="form-group">
            <label for="nama">Nama :</label>
            <input type="text" id="nama" class="form-control py-4 shadow-sm" value="<?= $row['nama']; ?>" name="nama">
          </div>
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" class="form-control py-4 shadow-sm" value="<?= $row['username']; ?>" name="username">
          <div class="form-group">
  <label for="password">Password:</label>
  <div class="input-group">
    <input type="password" id="password" class="form-control py-4 shadow-sm" placeholder="••••••••" value="<?= $row['password']; ?>" name="password">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
    </div>
  </div>
</div>

          <div class="button">
            <button class="btn btn-primary shadow-sm py-2 col-12" name="submit">Submit</button>
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
