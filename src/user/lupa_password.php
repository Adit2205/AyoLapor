<?php

$title = 'Lupa Password';

require '../../public/app.php';
require '../layouts/header.php';

// Logic backend

$error_message = '';

if (isset($_POST['submit'])) {
    // Lakukan verifikasi pengguna berdasarkan username yang diberikan
    $username = $_POST['username'];
    
    // Lakukan pengecekan apakah username ada dalam database
    $check_query = "SELECT * FROM masyarakat WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) === 1) {
        // Lakukan proses untuk mengirimkan email atau pesan teks dengan tautan untuk mengatur ulang kata sandi
        // Setelah pengguna melakukan verifikasi identitas
        
        // Redirect pengguna ke halaman konfirmasi
        header("Location: konfirmasi_password.php");
    } else {
        $error_message = "Username tidak ditemukan. Silakan masukkan username yang benar.";
    }
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h3 class="text-center text-primary text-uppercase mb-4">Lupa Password</h3>
                    <?php if (!empty($error_message)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error_message ?>
                        </div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control shadow-sm" placeholder="Username" name="username">
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary shadow-lg">Kirim</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <a href="login.php" class="text-gray-600" style="text-decoration: none;">Kembali ke halaman Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php' ?>
