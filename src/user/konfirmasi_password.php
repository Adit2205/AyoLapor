<?php

$title = 'Reset Password Confirmation';

require '../../public/app.php';
require '../layouts/header.php';

// Logic backend

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];
    
    // Lakukan proses pengaturan ulang password pengguna di database
    $query = "UPDATE masyarakat SET password = '$new_password' WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $success_message = "Kata sandi Anda berhasil diatur ulang.";
    } else {
        $error_message = "Terjadi kesalahan saat mengatur ulang kata sandi. Silakan coba lagi.";
    }
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow mt-3 border-bottom-primary bg-gray-100" data-aos="fade-down">
                <div class="card-body">
                    <h3 class="text-center text-primary text-uppercase mb-4">Reset Password</h3>
                    <hr class="bg-gradient-primary">
                    <?php if (isset($success_message)) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $success_message ?>
                        </div>
                        <div class="text-center">
                            <a href="login.php" class="btn btn-primary">Kembali ke Halaman Login</a>
                        </div>
                    <?php elseif (isset($error_message)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error_message ?>
                        </div>
                    <?php else : ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukkan password baru">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary shadow-lg">Atur Ulang Password</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php' ?>
